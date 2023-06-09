<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the users
     *
     * @param  \App\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        return view('users.index', ['users' => $model->orderBy('name','ASC')->paginate(20)]);
    }

    /**
     * Show the form for creating a new user
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $roles = Role::all(['id','name']);
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request, User $user)
    {
        //$user  = $user->create($request->only('email', 'name', 'password')); 

        $user = $user->create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        $roles = $request['roles']; //Retrieving the roles field

        if (isset($roles))
        {
            foreach ($roles as $role)
            {
                $role_r = Role::where('id', '=', $role)->firstOrFail();
                // $role_r is the object, pass it as it is needed by polymorph table model_has_roles
                $user->assignRole($role_r); //Assigning role to user
            }
        }

        return redirect()->route('user.index')->withStatus(__('User successfully created.'));
    }

    /**
     * Show the form for editing the specified user
     *
     * @param  \App\User  $user
     * @return \Illuminate\View\View
     */
    public function edit(User $user) {

        $roles = Role::all(['id','name']);

        if ( $user->hasRole('super-admin') ){
            if ( auth()->user()->hasRole('super-admin') ){
                return view('users.edit', compact('user','roles'));
            }
            else {
                return redirect()->route('user.index')->with('error', 'You are not allowed to do that');
            }
        }
        else {
            return view('users.edit', compact('user','roles'));
        }
    }

    /**
     * Update the specified user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, User  $user)
    {
        /*$user->update(
            $request->merge(['password' => $request->get('password')])
                ->except([$request->get('password') ? '' : 'password','roles']
        ));*/
        $user = User::findOrFail($user->id);

        $new_password = $request->input('password');
        if(empty($new_password)) {
            $user->update($request->except(['password','roles']));
        }
        else {
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->update();
        }

        foreach($user->getRoleNames() as $role){
            $user->removeRole($role);
        }

        $roles = $request['roles']; //Retrieving the roles field

        if (isset($roles)){
            foreach ($roles as $role){
                $role_r = Role::where('id', '=', $role)->firstOrFail();
                // $role_r is the object, pass it as it is needed by polymorph table model_has_roles
                // better this way, but you can also use the name itself
                $user->assignRole($role_r); //Assigning role to user
            }
        }

        return redirect()->route('user.index')->withStatus(__('User successfully updated.'));
    }

    /**
     * Remove the specified user from storage
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User  $user)
    {
        if ( $user->hasRole('super-admin') ){
            if (auth()->user()->hasRole('super-admin')) {
                $user->delete();
            }
            else {
                return redirect()->route('user.index')->with('error', 'You are not allowed to do that');
            }
        }
        else {
            $user->delete();
        }

        return redirect()->route('user.index')->withStatus(__('User successfully deleted.'));
    }
}
