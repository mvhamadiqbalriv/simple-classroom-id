<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = \App\User::latest()->paginate(5);
        $filterKeyword = $request->get('keyword');
        if ($filterKeyword) {
            $users = \App\User::where('name', 'LIKE', "%$filterKeyword%")->latest()->paginate(5);
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
        $request->validate([
            'name' => 'required|regex:/^[\pL\s\-]+$/u|max:50',
            'username' => 'required|alpha_dash|unique:App\User,username|max:50|min:3',
            'email' => 'required|unique:App\User,email',
            'roles' => 'required',
            'address' => 'max:255',
            'phone' => 'unique:App\User,phone,',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|min:8|same:password',
            'avatar' => 'file|image|mimes:jpeg,png,gif,webp,jpg|max:2048'
        ]);

        $user = new \App\User;
        $user->name = $request->get('name');
        $user->username = $request->get('username');
        $user->email = $request->get('email');
        $user->roles = $request->get('roles');
        $user->address = $request->get('address');
        $user->phone = $request->get('phone');
        $user->password = Hash::make($request->get('password'));

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
        $user = \App\User::where('username', '=', $id)->first();

        return view('back-ui.users.edit', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = \App\User::where('username', '=', $id)->first();

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

        if ($request->has('updateInformation')) {
            $request->validate([
                'name' => 'required|regex:/^[\pL\s\-]+$/u|max:50',
                'email' => 'required|unique:App\User,email,'.$id,
                'roles' => 'required',
                'phone' => ['regex:/\+?([-]?\d+)+|\(\d+\)([-]\d+)/'],
                'address' => 'max:255'
            ]);
    
            $user->name = $request->get('name');
            $user->email = $request->get('email');
            $user->roles = $request->get('roles');
            $user->phone = $request->get('phone');
            $user->address = $request->get('address');
    
            $user->save();
            return redirect()->route('users.edit', $user->username)->with('success', 'Data berhasil diubah');
        }elseif ($request->has('updatePassword')) { 
            
            if (!Hash::check($request->get('old_password'), $user->password)) {
                return redirect()->route('users.edit', $user->username)->with('notMatch', 'Password doesnt match with
                current/old password ');
                die;
            }
            
            $request->validate([
                'new_password' => 'required|min:8',
                'conf_password' => 'same:new_password|min:8'
            ]);

            $user->update(['password'=> Hash::make($request->new_password)]);
            return redirect()->route('users.edit', $user->username)->with('successChangePassword', 'Password berhasil
            diubah');
        }elseif ($request->has('avatar')) {
            $request->validate([
                'avatar' => 'mimes:jpeg,png,gif,webp,jpg|max:2048'
            ]);

            if ($user->avatar && file_exists(storage_path('app/public/' . $user->avatar))) {
                \Storage::delete('public/' . $user->avatar);
                $file = $request->file('avatar')->store('avatars', 'public');
                $user->avatar = $file;
            }
            $user->save();
            return redirect()->route('users.edit', $user->username)->with('successChangeAvatar', 'Avatar berhasil
            diubah');
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
        $user = \App\User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Data berhasil dihapus');
    }
}