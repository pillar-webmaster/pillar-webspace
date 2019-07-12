<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $roles = Role::all(['id','name']);
        return view('profile.edit', compact('roles'));
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request)
    {
        //auth()->user()->update($request->all());
        auth()->user()->update(
            $request->except(['roles'])
        );

        //dd(auth()->user()->getRoleNames());
        foreach(auth()->user()->getRoleNames() as $role){
            auth()->user()->removeRole($role);
        }

        $roles = $request['roles']; //Retrieving the roles field

        if (isset($roles)){
            foreach ($roles as $role){
                $role_r = Role::where('id', '=', $role)->firstOrFail();
                // $role_r is the object, pass it as it is needed by polymorph table model_has_roles
                // better this way, but you can also use the name itself
                auth()->user()->assignRole($role_r); //Assigning role to user
            }
        }

        return back()->withStatus(__('Profile successfully updated.'));
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        auth()->user()->update(['password' => bcrypt($request->get('password'))]);

        return back()->withStatusPassword(__('Password successfully updated.'));
    }
}
