<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;

// use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Symfony\Component\HttpFoundation\Response;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Role $role)
    {
        //
        $role = Role::withCount('permissions')->get();
        return response()->view('cms.spatie.role.index', compact('role'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        return view('cms.spatie.role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3|max:40',
            'guard_name' => 'required|string|in:admin,publisher'
        ]);

        if (! $validator->fails()) {
            $role = new Role();
            $role->name = $request->get('name');
            $role->guard_name = $request->get('guard_name');
            $isSaved = $role->save();

            return response()->json([
                'message' => $isSaved ? 'Created successfully' : 'Failed to create'
            ], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        $permissions = Permission::where('guard_name', '=', 'admin')->get();
        $rolePermissions = $role->permissions;

        foreach ($permissions as $permission) {
            $permission->setAttribute('assigned', false);
            foreach ($rolePermissions as $rolePermission) {
                if ($rolePermission->id == $permission->id) {
                    $permission->setAttribute('assigned', true);
                }
            }
        }
        return response()->view('cms.spatie.role.role-permission', compact('role', 'permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        //
        $deleted = $role->delete();

        return response()->json([
            'message' => $deleted ? 'Deleted Successfully' :
                'Delete Failed'
        ], $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
