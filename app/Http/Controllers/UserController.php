<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = \App\User::paginate(10);
        $filterKeyword = $request->get('keyword');
        if ($filterKeyword) {
            $users = \App\User::where('name', 'LIKE', "%$filterKeyword%")->paginate(10);
        }

        return view('back-ui.users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back-ui.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new \App\User;
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->roles = $request->get('roles');
        $user->address = $request->get('address');
        $user->phone = $request->get('phone');
        $user->password = bcrypt($request->get('password'));

        if ($request->file('avatar')) {
            $file = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $file;
        }

        $user->save();
        return redirect()->route('users.create')->with('status', 'User berhasil ditambahkan');
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
        $user = \App\User::findOrFail($id);

        return view('back-ui.users.edit', ['user' => $user]);
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
        $user = \App\User::findOrFail($id);

        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->roles = $request->get('roles');
        $user->phone = $request->get('phone');
        $user->address = $request->get('address');

        $user->save();
        return redirect()->route('users.edit', $id)->with('success', 'Data berhasil diubah');
    }

    public function change_password(Request $request, $id){
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = \App\User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Data berhasil dihapus');
    }
}
