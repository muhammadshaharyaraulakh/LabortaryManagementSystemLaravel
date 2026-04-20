<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Validation\Rule;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::withCount('tests', 'users')->get();

        if ($departments->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Departments not found',
                'data' => []
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Departments retrieved successfully',
            'data' => $departments
        ], 200);
    }


    public function addDepartment(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|' . Rule::unique('departments', 'name'),
            'type' => 'required',
            'is_active' => 'required|boolean',
        ],
            [
                'name.unique' => 'This Department name already exists in the active inventory or the trash. Please restore it or choose a different name.'
            ]);

        $department = Department::create([
            'name' => $request->name,
            'type' => $request->type,
            'is_active' => $request->is_active,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Department added successfully',
            'data' => $department
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $department = Department::find($id);

        if (!$department) {
            return response()->json([
                'status' => 'error',
                'message' => 'Department not found',
            ], 404);
        }

        $request->validate([
            'name' => 'required|string|max:255|' . Rule::unique('departments', 'name')->ignore($department->id),
            'type' => 'required',
            'is_active' => 'required|boolean',
        ],[
            'name.unique' => 'This Department name already exists in the active inventory or the trash. Please restore it or choose a different name.'
        ]);

        $department->update([
            'name' => $request->name,
            'type' => $request->type,
            'is_active' => $request->is_active,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Department updated successfully',
            'data' => $department
        ], 200);
    }

    public function show($id)
    {
        $department = Department::find($id);

        if (!$department) {
            return response()->json([
                'status' => 'error',
                'message' => 'Department not found',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Department fetched successfully',
            'data' => $department,
        ], 200);
    }


    public function delete($id)
    {
        $department = Department::find($id);

        if (!$department) {
            return response()->json([
                'status' => 'error',
                'message' => 'Department not found',
            ], 404);
        }

        $department->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Department deleted successfully',
        ], 200);
    }
    public function trashed()
    {
        $departments = Department::onlyTrashed()->get();
        if ($departments->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No Trashed Departments'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $departments
        ], 200);
    }

    public function restore($id)
    {
        if (empty($id)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Id is Empty'
            ], 400);
        }
        $department = Department::withTrashed()->findOrFail($id);

        $department->restore();

        return response()->json([
            'status' => 'success',
            'message' => 'Department restored Successfully',
            'data' => $department
        ], 200);
    }

}
