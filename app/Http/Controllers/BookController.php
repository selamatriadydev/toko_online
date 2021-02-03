<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Category;
class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $status = $request->get('status');
        if($status){
            $list_books = Book::with('categories')->where('status', strtoupper($status))->paginate(10);
        }else{
            $list_books = Book::with('categories')->paginate(10);
        }
        return view('books.index', ['list_books'=>$list_books]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new_book = new Book;
        $new_book->title = $request->get('title');
        $new_book->description = $request->get('description');
        $new_book->author = $request->get('author');
        $new_book->publisher = $request->get('publisher');
        $new_book->price = $request->get('price');
        $new_book->stock = $request->get('stock');
        $new_book->status = $request->get('save_action');
        $cover = $request->file('cover');
        if($cover){//handle upload
            $cover_path = $cover->store('book-covers', 'public');
            $new_book->cover = $cover_path;
        }
        $new_book->slug = str_slug($request->get('title'));
        $new_book->created_by = \Auth::user()->id;

        $new_book->save();
        $new_book->categories()->attach($request->get('categories'));

        $save_action = $request->get('save_action');
        if($save_action =="PUBLISH"){
            return redirect()->route('books.index')->with('status', 'Book succesfully save and published');
        }else{
            return redirect()->route('books.index')->with('status', 'Book succesfully save as Draft');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book_edit = Book::findOrFail($id);
        return view('books.edit', ['book'=> $book_edit]);
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
        $update_book = Book::findOrFail($id);
        $update_book->title = $request->get('title');
        $update_book->slug = $request->get('slug');
        $update_book->description = $request->get('description');
        $update_book->author = $request->get('author');
        $update_book->publisher = $request->get('publisher');
        $update_book->price = $request->get('price');
        $update_book->stock = $request->get('stock');
        $update_book->status = $request->get('save_action');
        $new_cover = $request->file('cover');
        if($new_cover){//handle upload
            if($update_book->cover && file_exists(storage_patch('app/public/'. $update_book->cover))){
                \Storage::delete('public/'. $update_book->cover);
            }
            $new_cover_path = $new_cover->store('book-covers', 'public');
            $update_book->cover = $new_cover_path;
        }
        $update_book->slug = str_slug($request->get('title'));
        $update_book->updated_by = \Auth::user()->id;

        $update_book->save();
        $update_book->categories()->sync($request->get('categories'));

        $save_action = $request->get('save_action');
        if($save_action =="PUBLISH"){
            return redirect()->route('books.index')->with('status', 'Book succesfully update and published');
        }else{
            return redirect()->route('books.index')->with('status', 'Book succesfully update as Draft');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $trash = Book::findOrFail($id);
        $trash->delete();
        return redirect()->route('books.index')->with('status', 'Book Move to Trash');
    }

    public function trash()
    {
        $list_trash = Book::onlyTrashed()->paginate(10);
        return view('books.trash', ['book_trash' => $list_trash]);
    }

    public function restore($id)
    {
        $restore_book = Book::withTrashed()->findOrFail($id);
        // dd($restore_book);
        if($restore_book->trashed()){//handle
            $restore_book->restore();
            return redirect()->route('books.index')->with('status', 'Book successfully restore');
        }else{
            return redirect()->route('books.index')->with('status', 'Book is not in trash');
        }
    }

    public function deletePermanent($id)
    {
        $deletePermanent = Book::withTrashed()->findOrFail($id);
        if(!$deletePermanent->trashed()){
            return redirect()->route('books.index')->with('status', 'Book is not in trash');
        }else{
            $deletePermanent->categories()->detach();//hapus relationship buku yang akan dihapus dengan kategory jika ada
            $deletePermanent->forceDelete();
            return redirect()->route('books.index')->with('status', 'Book Permanently Delete');
        }
    }

}
