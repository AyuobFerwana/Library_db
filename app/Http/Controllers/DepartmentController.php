<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use Symfony\Component\HttpFoundation\Response;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::all();
        return view('cms.department.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cms.department.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $validator = Validator($request->all(), [
            'name' => 'required|string|max:50',
            'image_type' => 'required|image|mimes:jpeg,png,jpg,svg|max:3000'
        ]);

        if (! $validator->fails()) {
            $depart = new Department();
            $depart->name = $request->input('name');
            if ($request->hasFile('image_type')) {
                $image = $request->file('image_type');
                //DATE_TIME_name.png jpg jpeg
                $imageName = Carbon::now()->format('Y_m_d_H_i_') . 'type_' . $depart->name . '.' . $image->getClientOriginalExtension();
                // dd($imageName);
                // $image->move('images/types', $imageName);
                $image->storeAs('images/types', $imageName, ['disk' => 'public']);
                $depart->image_type = 'images/types/' . $imageName;
            }
            $isSave = $depart->save();
            return response()->json(
                [
                    'message' => $isSave ? 'Created Successfully' : 'Create Failed'
                ],
                $isSave ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST
            );
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        return view('cms.department.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'image_type' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:3000'
        ]);

        if (! $validator->fails()) {
            $department->name = $request->input('name');
            if ($request->hasFile('image_type')) {
                $image = $request->file('image_type');
                $oldImage = $department->image_type;
                Storage::delete($oldImage);
                $newImageName = Carbon::now()->format('Y_m_d_H_i_') . '_department' . $department->name . '.' . $image->getClientOriginalExtension();
                $image->storeAs('images/types', $newImageName, ['disk' => 'public']);
                $department->image_type = 'images/types/' . $newImageName;
                $isUpdated = $department->save();
                return response()->json(
                    [
                        'message' => $isUpdated ? 'Updated Successfully' : 'Update Failed'
                    ],
                    $isUpdated ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
                );
            }
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {

        $deleted = $department->delete();
        $departmentImage = $department->image_type;

        if ($deleted) {
            $Imagedeleted = Storage::disk('public')->delete($departmentImage);
            return response()->json([
                'message' => $Imagedeleted ? 'Deleted Successfully' :
                    'Delete Failed'
            ], $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        }
    }
}
