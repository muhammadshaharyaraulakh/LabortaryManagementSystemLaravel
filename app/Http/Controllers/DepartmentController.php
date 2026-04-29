<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class DepartmentController extends Controller
{
    // =========================
    // GET ALL DEPARTMENTS
    // =========================
    public function index()
    {
        $departments = Department::withCount(['tests', 'users'])->get();

        if ($departments->isEmpty()) {
            return response()->json([
                'success' => true,
                'message' => 'No departments found',
                'data' => []
            ], Response::HTTP_OK);
        }

        return response()->json([
            'success' => true,
            'message' => 'Departments retrieved successfully',
            'data' => $departments
        ], Response::HTTP_OK);
    }

    // =========================
    // ADD DEPARTMENT
    // =========================
    public function addDepartment(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('departments', 'name')
            ],
            'type' => ['required', 'string'],
            'is_active' => ['required', 'boolean'],
        ], [
            'name.unique' => 'This Department name already exists. Please restore it or choose a different name.'
        ]);

        try {
            $department = Department::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Department added successfully',
                'data' => $department
            ], Response::HTTP_CREATED);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Failed to add department',
                'data' => null,
                'error' => config('app.debug') ? $e->getMessage() : null
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    // =========================
    // SHOW SINGLE DEPARTMENT
    // =========================
    public function show($id)
    {
        $department = Department::find($id);

        if (!$department) {
            return response()->json([
                'success' => false,
                'message' => 'Department not found',
                'data' => null
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'success' => true,
            'message' => 'Department fetched successfully',
            'data' => $department
        ], Response::HTTP_OK);
    }

    // =========================
    // UPDATE DEPARTMENT
    // =========================
    public function update(Request $request, $id)
    {
        $department = Department::find($id);

        if (!$department) {
            return response()->json([
                'success' => false,
                'message' => 'Department not found',
                'data' => null
            ], Response::HTTP_NOT_FOUND);
        }

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('departments', 'name')->ignore($department->id)
            ],
            'type' => ['required', 'string'],
            'is_active' => ['required', 'boolean'],
        ]);

        $department->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Department updated successfully',
            'data' => $department
        ], Response::HTTP_OK);
    }

    // =========================
    // DELETE (SOFT DELETE)
    // =========================
    public function delete($id)
    {
        $department = Department::find($id);

        if (!$department) {
            return response()->json([
                'success' => false,
                'message' => 'Department not found',
                'data' => null
            ], Response::HTTP_NOT_FOUND);
        }

        $department->delete();

        return response()->json([
            'success' => true,
            'message' => 'Department deleted successfully',
            'data' => null
        ], Response::HTTP_OK);
    }

    // =========================
    // TRASHED DEPARTMENTS
    // =========================
    public function trashed()
    {
        $departments = Department::onlyTrashed()->get();

        return response()->json([
            'success' => true,
            'message' => $departments->isEmpty()
                ? 'No trashed departments found'
                : 'Trashed departments retrieved successfully',
            'data' => $departments
        ], Response::HTTP_OK);
    }

    // =========================
    // RESTORE DEPARTMENT
    // =========================
    public function restore($id)
    {
        if (!$id) {
            return response()->json([
                'success' => false,
                'message' => 'ID is required',
                'data' => null
            ], Response::HTTP_BAD_REQUEST);
        }

        $department = Department::withTrashed()->find($id);

        if (!$department) {
            return response()->json([
                'success' => false,
                'message' => 'Department not found',
                'data' => null
            ], Response::HTTP_NOT_FOUND);
        }

        $department->restore();

        return response()->json([
            'success' => true,
            'message' => 'Department restored successfully',
            'data' => $department
        ], Response::HTTP_OK);
    }
}
