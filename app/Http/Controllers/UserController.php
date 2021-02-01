<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list_user = User::paginate(10);
        $filter_keyword = $request->get('keyword');
        $keyword_status = $request->get('status');

        if($filter_keyword){
            if($keyword_status){
                $list_user = User::where('email', 'LIKE', "%$filter_keyword%")->where('status', $keyword_status)->paginate(10);
            }else{
                $list_user = User::where('email', 'LIKE', "%$filter_keyword%")->paginate(10);
            }
        }
        return view('users.index', ['list_user'=> $list_user, 'keyword'=> $filter_keyword, 'keyword_status'=> $keyword_status ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new_user = new User;
        $new_user->name = $request->get('name');
        $new_user->username = $request->get('username');
        $new_user->roles = json_encode( $request->get('roles') );
        $new_user->address = $request->get('address');
        $new_user->phone = $request->get('phone');
        $new_user->email = $request->get('email');
        $new_user->password = \Hash::make( $request->get('password') );
        if($request->file('avatar')){//handle upload
            $file = $request->file('avatar')->store('avatars', 'public');//avatars adalah nama folder
            // dd($file);
            $new_user->avatar = $file;
        }
        $new_user->save();

        return redirect('users')->with('status', 'user Succesfully Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lihat_user = User::findOrFail($id);//cari user dengan id, jika ada lanjut jika tidak tampilkan error
        return view('users.show', ['user' => $lihat_user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit_user = User::findOrFail($id);
        return view('users.edit', ['user' => $edit_user]);
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
        $ubah_user = User::findOrFail($id);

        $ubah_user->name = $request->get('name');
        $ubah_user->username = $request->get('username');
        $ubah_user->roles = json_encode( $request->get('roles') );
        $ubah_user->address = $request->get('address');
        $ubah_user->phone = $request->get('phone');
        $ubah_user->email = $request->get('email');
        $ubah_user->status = $request->get('status');
        if($request->file('avatar')){//handle upload
            if($ubah_user->avatar && file_exists(storage_path('app/public'. $ubah_user->avatar)) ){//cek jika user memiliki file avatar diserver kita, jika ada maka hapus
                \Storage::delete('public/'.$ubah_user->avatar );
            }
            $file = $request->file('avatar')->store('avatars', 'public');//avatars adalah nama folder
            $ubah_user->avatar = $file;
        }
        $ubah_user->save();
        return redirect('users')->with('status', 'user Succesfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $hapus_user = User::findOrFail($id);
        $hapus_user->delete();
        return redirect('users')->with('status', 'user Succesfully Deleted');
    }
}
