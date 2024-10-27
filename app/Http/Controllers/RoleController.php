<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuItem;
use App\Models\Role;
use App\Models\RolePermission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RoleController extends Controller
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
        $data = Role::select('roles.role_id', 'roles.role_name')
        ->orderBy('roles.created_at', 'DESC')
        ->get();

        return view('role.index', compact('data'));
    }

    public function create()
    {
        return view('role.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'role_name' => 'required|min:3|unique:roles',
                'permission' => 'nullable|array'
            ]);

            $data = Role::create([
                'role_name' => $request->role_name,
            ]);

            if (! empty($request->permission)) {
                foreach ($request->permission as $per) {
                    RolePermission::create([
                        'role_id' => $data->role_id,
                        'menu_item_id' => $per
                    ]);
                }
            }

            return redirect(route('role.index'))->with('success', 'Save successfully');
        } catch (\RuntimeException $e) {
            return redirect(route('role.create'))->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $data = Role::find($id);

        $permissions = [];
        if (! empty($data->permissions)) {
            foreach ($data->permissions as $per) {
                $permissions[] = $per->menu_item_id;
            }
        }

        return view('role.edit', compact('data', 'permissions'));
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'role_name' => 'required|min:3|unique:roles,role_name,'.$id.',role_id',
                'permission' => 'nullable|array'
            ]);

            $data = Role::find($id);
            $data->update(['role_name' => $request->role_name]);

            RolePermission::where('role_id', $data->role_id)->delete();
            if (! empty($request->permission)) {
                foreach ($request->permission as $per) {
                    RolePermission::create([
                        'role_id' => $data->role_id,
                        'menu_item_id' => $per
                    ]);
                }
            }

            return redirect(route('role.index'))->with('success', 'Update successfully');
        } catch (\RuntimeException $e) {
            return redirect(route('role.edit', $id))->with('error', $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            Role::find($id)->delete();

            return redirect(route('role.index'))->with('success', 'Delete successfully');
        } catch (\RuntimeException $e) {
            return redirect(route('role.edit', $id))->with('error', $e->getMessage());
        }
    }
}
