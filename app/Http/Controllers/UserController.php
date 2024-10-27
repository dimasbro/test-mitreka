<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = User::select('users.id', 'users.name', 'users.email', 'roles.role_name')
        ->leftjoin('roles', 'roles.role_id', '=', 'users.role_id')
        ->orderBy('users.created_at', 'DESC')
        ->get();

        return view('user.index', compact('data'));
    }

    public function create()
    {
        $roles = Role::all();

        return view('user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|min:3',
                'email' => 'required||email|unique:users,email',
                'password' => 'required|min:8',
                'role' => 'required'
            ]);

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => $request->role,
            ]);

            return redirect(route('user.index'))->with('success', 'Save successfully');
        } catch (\RuntimeException $e) {
            return redirect(route('user.create'))->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $data = User::find($id);
        $roles = Role::all();

        return view('user.edit', compact('data', 'roles'));
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|min:3',
                'email' => 'required||email|unique:users,email,'.$id.',id',
                'password' => 'nullable|min:8',
                'role' => 'required'
            ]);

            $input = [
                'name' => $request->name,
                'email' => $request->email,
                'role_id' => $request->role,
            ];

            if ($request->password) {
                $input = array_merge($input, ['password' => Hash::make($request->password)]);
            }

            User::find($id)->update($input);

            return redirect(route('user.index'))->with('success', 'Update successfully');
        } catch (\RuntimeException $e) {
            return redirect(route('user.edit', $id))->with('error', $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            User::find($id)->delete();

            return redirect(route('user.index'))->with('success', 'Delete successfully');
        } catch (\RuntimeException $e) {
            return redirect(route('user.edit', $id))->with('error', $e->getMessage());
        }
    }
}
