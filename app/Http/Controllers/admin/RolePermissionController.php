<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{
    public function roles()
    {
        $roles = Role::all();
        return view('admin.roles', compact('roles'));
    }

    public function createRole(Request $request)
    {
        $permissions = Permission::all();
        return view('admin.roles-create-edit', compact('permissions'));
    }

    public function storeRole(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:roles,name'
        ]);

        DB::beginTransaction();

        try {
            $role = Role::create(['name' => $request->name]);

            if ($request->has('permissions')) {
                $role->syncPermissions($request->permissions);
            }

            DB::commit();
            return redirect()->route('admin.roles.index')->with('success', 'Role created successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            \Log::error('ERROR_CREATING_ROLE: ' . $th->getMessage());
            return redirect()->route('admin.roles.index')->with('error', 'Failed to create role');
        }
    }

    public function editRole(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.roles-create-edit', compact('permissions', 'role'));
    }

    public function updateRole(Request $request, $id)
    {
        $role = Role::findById($id);
        $request->validate([
            'name' => "required|string|max:100|unique:roles,name,$id"
        ]);

        DB::beginTransaction();

        try {
            $role->update(['name' => $request->name]);
            if ($request->has('permissions')) {
                $role->syncPermissions($request->permissions);
            }

            DB::commit();
            return redirect()->route('admin.roles.index')->with('success', 'Role updated successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            \Log::error('ERROR_UPDATING_ROLE: ' . $th->getMessage());
            return redirect()->route('admin.roles.index')->with('error', 'Failed to update role');
        }
    }

    public function deleteRole($id)
    {
        try {
            $permission = Role::findById($id);
            $permission->delete();
            return redirect()->route('admin.roles.index')->with('success', 'Role deleted successfully');
        } catch (\Throwable $th) {
            \Log::error('ERROR_DELETING_ROLE: ' . $th->getMessage());
            return redirect()->route('admin.permissions.index')->with('error', 'Something went wrong');
        }
    }

    public function permissions()
    {
        $permissions = Permission::all();
        return view('admin.permissions', compact('permissions'));
    }

    public function createPermission(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:permissions,name'
        ]);
        Permission::create(['name' => $request->name]);
        return redirect()->back()->with('success', 'Permission created successfully');
    }

    public function updatePermission(Request $request, $id)
    {
        $request->validate([
            'name' => "required|string|max:100|unique:permissions,name,$id"
        ]);

        try {
            $permission = Permission::findById($id);
            $permission->update(['name' => $request->name]);
            return redirect()->route('admin.permissions.index')->with('success', 'Permission updated successfully');
        } catch (\Throwable $th) {
            \Log::error('ERROR_UPDATING_PERMISSION: ' . $th->getMessage());
            return redirect()->route('admin.permissions.index')->with('error', 'Something went wrong');
        }
    }

    public function deletePermission($id)
    {
        try {
            $permission = Permission::findById($id);
            $permission->delete();
            return redirect()->route('admin.permissions.index')->with('success', 'Permission deleted successfully');
        } catch (\Throwable $th) {
            \Log::error('ERROR_DELETING_PERMISSION: ' . $th->getMessage());
            return redirect()->route('admin.permissions.index')->with('error', 'Something went wrong');
        }
    }
}
