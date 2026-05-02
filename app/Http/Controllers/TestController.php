<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;
use App\Models\Department;
use App\Models\User;
use App\Models\Inventory;
use App\Models\TestParameter;
use App\Models\TestRequirement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class TestController extends Controller
{
    public function deprtmentTests()
    {
        $department = Auth::user()->department_id;
        if (empty($department)) {
            return response()->json([
                'status' => false,
                'message' => 'Department not found',
                'data' => []
            ], Response::HTTP_BAD_REQUEST);
        }
        $tests = Test::where('departmentId', $department)->latest()->get();


        if ($tests->isNotEmpty()) {
            return response()->json([
                'status' => true,
                'message' => 'Tests found',
                'data' => $tests
            ], Response::HTTP_OK);
        }

        return response()->json([
            'status' => true,
            'message' => 'Tests not found',
            'data' => []
        ], Response::HTTP_OK);
    }

    public function index()
    {
        $tests = Test::whereHas('department', function ($query) {
            $query->where('is_active', true);
        })->with('department')->get();

        if ($tests->isNotEmpty()) {
            return response()->json([
                'status' => true,
                'message' => 'Tests found',
                'data' => $tests
            ], Response::HTTP_OK);
        }
        return response()->json([
            'status' => true,
            'message' => 'Tests not found',
            'data' => []
        ], Response::HTTP_OK);
    }
    public function inventoryItems()
    {
        $stock = Inventory::get();

        if ($stock->isEmpty()) {
            return response()->json([
                'success' => true,
                'message' => 'No Item Exists in Inventory',
                'data' => []
            ], Response::HTTP_OK);
        }

        return response()->json([
            'success' => true,
            'message' => 'Inventory Details Fetched Successfully',
            'data' => $stock
        ], Response::HTTP_OK);
    }
    public function add(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:tests,name'],
            'code' => ['required', 'string', 'max:255', 'unique:tests,code'],
            'price' => ['required', 'numeric', 'min:0'],
            'type' => ['required', 'string', 'max:255'],
            'time' => ['required', 'string', 'max:255'],
            'instructions' => ['required', 'string'],
            'parameter_name' => ['required', 'array', 'min:1'],
            'parameter_name.*' => ['required', 'string', 'distinct'],
            'parameter_type' => ['required', 'array'],
            'parameter_type.*' => ['required', 'string'],
            'parameter_unit' => ['nullable', 'array'],
            'parameter_unit.*' => ['nullable', 'string'],
            'parameter_range' => ['nullable', 'array'],
            'parameter_range.*' => ['nullable', 'string'],
            'parameter_options' => ['nullable', 'array'],
            'parameter_options.*' => ['nullable', 'string'],
            'inventory_item' => ['required', 'array'],
            'inventory_item.*' => ['required', 'integer'],
            'inventory_quantity' => ['required', 'array'],
            'inventory_quantity.*' => ['required', 'integer', 'min:1'],
        ]);

        try {
            DB::beginTransaction();

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
                if (empty($value)) {
                    continue;
                }

                $paramType = $request->parameter_type[$key] ?? null;
                $unit = $request->parameter_unit[$key] ?? null;
                $range = $request->parameter_range[$key] ?? null;
                $optionsStr = $request->parameter_options[$key] ?? null;

                if ($paramType === 'Quantitative') {
                    if (empty($unit) || empty($range)) {
                        DB::rollBack();

                        $errors = [];
                        if (empty($unit)) {
                            $errors["parameter_unit.{$key}"] = ["Unit is required for this test."];
                        }
                        if (empty($range)) {
                            $errors["parameter_range.{$key}"] = ["Normal Range is required for this test."];
                        }

                        return response()->json([
                            'message' => 'Please fill all required parameter fields.',
                            'errors' => $errors
                        ], Response::HTTP_UNPROCESSABLE_ENTITY);
                    }
                } elseif ($paramType === 'Qualitative') {
                    if (empty($optionsStr)) {
                        DB::rollBack();

                        return response()->json([
                            'message' => 'Please fill all required parameter fields.',
                            'errors' => [
                                "parameter_options.{$key}" => ["Options with Comma Seperation are required for this test."]
                            ]
                        ], Response::HTTP_UNPROCESSABLE_ENTITY);
                    }
                }

                $formattedOptions = null;
                if ($paramType === 'Qualitative' && !empty($optionsStr)) {
                    $formattedOptions = array_map('trim', explode(',', $optionsStr));
                }

                TestParameter::create([
                    'testId' => $test->id,
                    'parameterName' => $value,
                    'inputType' => $paramType,
                    'unit' => $unit,
                    'normalRange' => $range,
                    'options' => $formattedOptions,
                ]);
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

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Test configuration added successfully',
            ], Response::HTTP_CREATED);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong!',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:tests,name,' . $id],
            'code' => ['required', 'string', 'max:255', 'unique:tests,code,' . $id],
            'price' => ['required', 'numeric', 'min:0'],
            'type' => ['required', 'string', 'max:255'],
            'time' => ['required', 'string', 'max:255'],
            'instructions' => ['required', 'string'],
            'parameter_name' => ['required', 'array', 'min:1'],
            'parameter_name.*' => ['required', 'string', 'distinct'],
            'parameter_type' => ['required', 'array'],
            'parameter_type.*' => ['required', 'string'],
            'parameter_unit' => ['nullable', 'array'],
            'parameter_unit.*' => ['nullable', 'string'],
            'parameter_range' => ['nullable', 'array'],
            'parameter_range.*' => ['nullable', 'string'],
            'parameter_options' => ['nullable', 'array'],
            'parameter_options.*' => ['nullable', 'string'],
            'inventory_item' => ['required', 'array'],
            'inventory_item.*' => ['required', 'integer'],
            'inventory_quantity' => ['required', 'array'],
            'inventory_quantity.*' => ['required', 'integer', 'min:1'],
        ]);

        try {
            DB::beginTransaction();

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

            foreach ($request->parameter_name as $key => $value) {
                if (empty($value)) {
                    continue;
                }

                $paramType = $request->parameter_type[$key] ?? null;
                $unit = $request->parameter_unit[$key] ?? null;
                $range = $request->parameter_range[$key] ?? null;
                $optionsStr = $request->parameter_options[$key] ?? null;

                if ($paramType === 'Quantitative') {
                    if (empty($unit) || empty($range)) {
                        DB::rollBack();

                        $errors = [];
                        if (empty($unit)) {
                            $errors["parameter_unit.{$key}"] = ["Unit is required for this test."];
                        }
                        if (empty($range)) {
                            $errors["parameter_range.{$key}"] = ["Normal Range is required for this test."];
                        }

                        return response()->json([
                            'message' => 'Please fill all required parameter fields.',
                            'errors' => $errors
                        ], Response::HTTP_UNPROCESSABLE_ENTITY);
                    }
                } elseif ($paramType === 'Qualitative') {
                    if (empty($optionsStr)) {
                        DB::rollBack();

                        return response()->json([
                            'message' => 'Please fill all required parameter fields.',
                            'errors' => [
                                "parameter_options.{$key}" => ["Options with Comma Seperation are required for this test."]
                            ]
                        ], Response::HTTP_UNPROCESSABLE_ENTITY);
                    }
                }

                $formattedOptions = null;
                if ($paramType === 'Qualitative' && !empty($optionsStr)) {
                    $formattedOptions = array_map('trim', explode(',', $optionsStr));
                }

                TestParameter::create([
                    'testId' => $test->id,
                    'parameterName' => $value,
                    'inputType' => $paramType,
                    'unit' => $unit,
                    'normalRange' => $range,
                    'options' => $formattedOptions,
                ]);
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

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Test updated successfully',
            ], Response::HTTP_OK);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong!',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($id)
    {
        $test = Test::findOrFail($id);

        try {
            DB::beginTransaction();
            $test->parameters()->delete();
            $test->requirements()->delete();
            $test->delete();
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Test deleted successfully',
            ], Response::HTTP_OK);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong!',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        $test = Test::with(['parameters', 'requirements', 'department'])->findOrFail($id);

        return response()->json([
            'status' => true,
            'message' => 'Test retrieved successfully',
            'data' => $test
        ], Response::HTTP_OK);
    }
}