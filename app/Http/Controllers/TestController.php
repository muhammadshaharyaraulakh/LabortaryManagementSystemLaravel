<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;
use App\Models\Department;
use App\Models\User;
use App\Models\TestParameter;
use App\Models\TestRequirement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function deprtmentTests($department)
    {
        $tests = Test::where('departmentId', $department)->get();

        if ($tests->isNotEmpty()) {
            return response()->json([
                'status' => 200,
                'message' => 'Tests found',
                'data' => $tests
            ]);
        }

        return response()->json([
            'status' => 404,
            'message' => 'Tests not found',
            'data' => []
        ]);
    }

    public function index()
    {
        $tests = Test::has('department')->with('department')->get();

        if ($tests->isNotEmpty()) {
            return response()->json([
                'status' => 200,
                'message' => 'Tests found',
                'data' => $tests
            ]);
        }
        return response()->json([
            'status' => 404,
            'message' => 'Tests not found',
            'data' => []
        ]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:tests,code',
            'price' => 'required|numeric|min:0',
            'type' => 'required|string|max:255',
            'time' => 'required|string|max:255',
            'instructions' => 'nullable|string',
            'parameter_name' => 'required|array|min:1',
            'parameter_name.*' => 'required|string',
            'parameter_unit' => 'required|array',
            'parameter_unit.*' => 'nullable|string',
            'parameter_range' => 'required|array',
            'parameter_range.*' => 'nullable|string',
            'inventory_item' => 'required|array',
            'inventory_item.*' => 'required|integer|exists:inventories,id',
            'inventory_quantity' => 'required|array',
            'inventory_quantity.*' => 'required|integer|min:1',
        ]);

        try {
            DB::transaction(function () use ($request) {
                $test = Test::create([
                    'name' => $request->name,
                    'code' => $request->code,
                    'price' => $request->price,
                    'sampleType' => $request->type,
                    'resultHours' => $request->time,
                    'instructions' => $request->instructions,
                    'departmentId' => Auth::user()->department_id,
                    'userId' => Auth::id(),
                    'isActive' => $request->has('is_active') ? true : false,
                ]);

                foreach ($request->parameter_name as $key => $value) {
                    if (!empty($value)) {
                        TestParameter::create([
                            'testId' => $test->id,
                            'parameterName' => $value,
                            'unit' => $request->parameter_unit[$key] ?? null,
                            'normalRange' => $request->parameter_range[$key] ?? null,
                        ]);
                    }
                }
                if (!empty($request->inventory_item)) {
                    foreach ($request->inventory_item as $key => $value) {
                        TestRequirement::create([
                            'testId' => $test->id,
                            'inventoryId' => $value,
                            'quantityUsed' => $request->inventory_quantity[$key] ?? 1,
                        ]);
                    }
                }
            });

            return response()->json([
                'status' => 200,
                'message' => 'Test configuration added successfully',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:tests,code,' . $id,
            'price' => 'required|numeric|min:0',
            'type' => 'nullable|string|max:255',
            'time' => 'nullable|string|max:255',
            'instructions' => 'nullable|string',
            'parameter_name' => 'required|array|min:1',
            'parameter_name.*' => 'required|string',
            'parameter_unit' => 'nullable|array',
            'parameter_unit.*' => 'nullable|string',
            'parameter_range' => 'nullable|array',
            'parameter_range.*' => 'nullable|string',
            'inventory_item' => 'nullable|array',
            'inventory_item.*' => 'required|integer|exists:inventories,id',
            'inventory_quantity' => 'nullable|array',
            'inventory_quantity.*' => 'nullable|integer|min:1',
        ]);

        try {
            DB::transaction(function () use ($request, $id) {
                $test = Test::findOrFail($id);
                $test->update([
                    'name' => $request->name,
                    'code' => $request->code,
                    'price' => $request->price,
                    'sampleType' => $request->type,
                    'resultHours' => $request->time,
                    'instructions' => $request->instructions,
                    'departmentId' => Auth::user()->department_id,
                    'isActive' => $request->has('is_active') ? true : false,
                ]);

                $test->parameters()->delete();
                $test->requirements()->delete();

                foreach ($request->parameter_name ?? [] as $key => $value) {
                    if (!empty($value)) {
                        TestParameter::create([
                            'testId' => $test->id,
                            'parameterName' => $value,
                            'unit' => $request->parameter_unit[$key] ?? null,
                            'normalRange' => $request->parameter_range[$key] ?? null,
                        ]);
                    }
                }

                foreach ($request->inventory_item ?? [] as $key => $value) {
                    if (!empty($value)) {
                        TestRequirement::create([
                            'testId' => $test->id,
                            'inventoryId' => $value,
                            'quantityUsed' => $request->inventory_quantity[$key] ?? 1,
                        ]);
                    }
                }
            });

            return response()->json([
                'status' => 200,
                'message' => 'Test updated successfully',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        $test = Test::find($id);

        if (!$test) {
            return response()->json([
                'status' => 404,
                'message' => 'Test not found',
            ]);
        }

        try {
            DB::transaction(function () use ($test) {
                $test->parameters()->delete();
                $test->requirements()->delete();
                $test->delete();
            });

            return response()->json([
                'status' => 200,
                'message' => 'Test deleted successfully',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        $test = Test::with(['parameters', 'requirements', 'department'])->find($id);

        if (!$test) {
            return response()->json([
                'status' => 404,
                'message' => 'Test not found',
                'data' => []
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Test retrieved successfully',
            'data' => $test
        ]);
    }
}