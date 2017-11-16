<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Http\Requests\UserRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request)
    {
        $user = new User;

        $user->name = $request->name;
        $user->username = str_slug($request->username, '');
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = $request->role;

        $avatar = $request->file('avatar');
        $extension = $avatar->getClientOriginalExtension();
        $filename = time() . '_' . str_random(9) . '.' . $extension;
        $location = public_path('storage/users/' . $filename);
        \Image::make($avatar)->resize(100, 100)->save($location);
        $user->avatar = $filename;

        $user->save();

        return back()->with('success', 'Added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Http\Requests\UserRequest  $request
     * @param  string  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, $id)
    {
        $user = User::find($id);

        $user->name = $request->name;
        $user->username = str_slug($request->username, '');
        $user->email = $request->email;
        $user->role = $request->role;

        if ($request->password) {
            $this->validate($request, [
                'password' => 'min:6',
                'confirm_password' => 'same:password'
            ]);
            $user->password = bcrypt($request->password);
        }

        if ($request->hasFile('avatar')) {
            if (file_exists($user->pathImage())) {
                unlink($user->pathImage());
            }
            $avatar = $request->file('avatar');
            $extension = $avatar->getClientOriginalExtension();
            $filename = time() . '_' . str_random(9) . '.' . $extension;
            $location = public_path('storage/users/' . $filename);
            \Image::make($avatar)->resize(100, 100)->save($location);
            $user->avatar = $filename;
        }

        $user->save();

        return back()->with('success', 'Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if (file_exists($user->pathImage())) {
            unlink($user->pathImage());
        }
        $user->delete($id);
        
        return back()->with('success', 'Deleted successfully.');
    }
}
