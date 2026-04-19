<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::all();

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
            'name' => 'required|string|max:255|unique:departments,name',
            'type' => 'required',
            'is_active' => 'required|boolean',
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
            'name' => 'required|string|max:255|unique:departments,name,' . $id,
            'type' => 'required',
            'is_active' => 'required|boolean',
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
   
}
