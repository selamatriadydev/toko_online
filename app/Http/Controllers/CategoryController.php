<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->get('name');
        $list_category = Category::paginate(10);
        if($keyword){
            $list_category = Category::where('name', 'LIKE', "%$keyword%")->paginate(10);
        }
        return view('categories.index', ['list_category' => $list_category]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $create_category = new Category;
        $name = $request->get('name');
        $create_category->name = $name;
        if($request->file('image')){//handle upload
            $image_path = $request->file('image')->store('category_image', 'public');
            $create_category->image = $image_path;
        }
        $create_category->created_by = \Auth::user()->id;//mengambil id user yang sedang login
        $create_category->slug = str_slug($name, '-');// contoh sepatu olaraga hasilnya sepatu-olaraga
        $create_category->save();

        return redirect('/categories')->with('status', 'Category succsesfully Created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $show_category = Category::findOrFail($id);

        return view('categories.show', ['category' => $show_category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit_category = Category::findOrFail($id);
        return view('categories.edit', ['category'=>$edit_category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $update_category = Category::findOrFail($id);
        $name = $request->get('name');
        $update_category->name = $name;
        $update_category->slug = $request->get('slug');
        if($request->file('image')){//handle upload
            if($update_category->image && file_exists(storage_path('app/public/'. $update_category->image))){
                \Storage::delete('public/' . $update_category->image );
            }
            $new_image = $request->file('image')->store('category_images', 'public');

            $update_category = $new_image;
        }
        $update_category->updated_by = \Auth::user()->id;
        $update_category->slug = str_slug($name);
        $update_category->save();

        return redirect('/categories')->with('status', 'Category succsesfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete_category = Category::findOrFail($id);

        $delete_category->delete();
        $delete_category->deleted_by = \Auth::user()->id;
        $delete_category->save();
        return redirect('/categories')->with('status', 'Category succsesfully Deleted');
    }

    public function trash(){
        // menampilkan data softdelete
        $trash_category = Category::onlyTrashed()->paginate(10);
        return view('categories.trash', ['trash_category' => $trash_category]);
    }

    public function restore($id){
        // mengembalikan data yang sudah status softdelete ke active/publish
        $restore_category = Category::withTrashed()->findOrFail($id);
        if($restore_category->trashed() ){
            $restore_category->restore();
        }else{
            return redirect('/categories')->with('status', 'Category is not in trash');
        }
        return redirect('/categories')->with('status', 'Category succsesfully Restore');
    }

    public function deletePermanent($id){
        // menghapus data permanen / selamanya
        $delete_category = Category::withTrashed()->findOrFail($id);
        if(!$delete_category->trashed() ){
            return redirect()->route('categories.index')->with('status', 'Cannot delete permanent active category');
        }else{
            $delete_category->forceDelete();
            return redirect()->route('categories.index')->with('status', 'Category permanently delete');
        }
    }

    public function ajaxSearch(Request $request){
        $keyword = $request->get('q');
        $categories = Category::where('name', 'LIKE', "%$keyword%")->get();
        return $categories;
    }
}
