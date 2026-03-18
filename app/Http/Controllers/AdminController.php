<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $admins = Admin::where('id', '!=', auth('admin')->id())->get();
        return response()->view('cms.admin.index', ['admins' => $admins]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $roles = Role::where('guard_name', 'admin')->get();
        return response()->view('cms.admin.create', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3|max:40',
            'email' => 'required|email',
            'role' => 'required|string|exists:roles,id'
        ]);

        if (! $validator->fails()) {
            $role = Role::findById($request->input('role'), 'admin');

            $admin = new Admin();
            $admin->name = $request->get('name');
            $admin->email = $request->get('email');
            $admin->password = Hash::make(102030);
            $isSaved = $admin->save();

            if ($isSaved) {
                $admin->assignRole($role);
            }

            return response()->json([
                'message' => $isSaved ? 'Created Admin successfully' : 'Failed to create admin'
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
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
