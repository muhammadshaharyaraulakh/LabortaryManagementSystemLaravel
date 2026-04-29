<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class ProfileController extends Controller
{
    // =========================
    // SHOW ALL USERS
    // =========================
    public function allusers()
    {
        $users = User::whereHas('department', function ($query) {
            $query->where('is_active', true);
        })
            ->where('role', '!=', 'Admin')
            ->whereNotNull('role')
            ->get();

        if ($users->isEmpty()) {
            return response()->json([
                'success' => true,
                'message' => 'No users found',
                'data' => []
            ], Response::HTTP_OK);
        }

        return response()->json([
            'success' => true,
            'message' => 'Users retrieved successfully',
            'data' => $users
        ], Response::HTTP_OK);
    }

    // =========================
    // GET USERS BY ROLE
    // =========================
    public function users($role)
    {
        $users = User::with('department')
            ->where('role', $role)
            ->get();

        if ($users->isEmpty()) {
            return response()->json([
                'success' => true,
                'message' => 'No users found',
                'data' => []
            ], Response::HTTP_OK);
        }

        return response()->json([
            'success' => true,
            'message' => 'Users retrieved successfully',
            'data' => $users
        ], Response::HTTP_OK);
    }

    // =========================
    // GET DELETED USERS
    // =========================
    public function deletedUsers()
    {
        $users = User::onlyTrashed()
            ->whereHas('department', function ($query) {
                $query->where('is_active', true);
            })
            ->where('role', '!=', 'Admin')
            ->whereNotNull('role')
            ->get();

        if ($users->isNotEmpty()) {
            return response()->json([
                'success' => true,
                'message' => 'Deleted users retrieved successfully',
                'data' => $users
            ], Response::HTTP_OK);
        }

        return response()->json([
            'success' => true,
            'message' => 'No deleted users found',
            'data' => []
        ], Response::HTTP_OK);
    }
    // =========================
    // ADD USER
    // =========================
    public function adduser(Request $request)
    {
        $validations = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'string', 'min:12'],
            'role' => ['required', 'string', 'in:Receptionist,Technician,SampleCollector,Pathologist,SpecialistDoctor'],
            'department_id' => ['nullable', 'exists:departments,id'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048']
        ], [
            'email.unique' => 'Email already exists',
        ]);

        $validations['password'] = Hash::make($request->password);

        if ($request->hasFile('image')) {
            $imageName = time() . '_' . uniqid() . '.' . $request->image->extension();
            $request->image->move(public_path('ProfileImages'), $imageName);
            $validations['image'] = 'ProfileImages/' . $imageName;
        }

        try {
            $user = User::create($validations);

            return response()->json([
                'success' => true,
                'message' => 'User added successfully',
                'data' => $user
            ], Response::HTTP_CREATED);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to add user',
                'data' => null,
                'error' => app()->environment('local') ? $e->getMessage() : null
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    // =========================
    // SHOW USER
    // =========================
    public function show($id)
    {
        $user = User::with('department')->find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
                'data' => null
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'success' => true,
            'message' => 'User fetched successfully',
            'data' => $user
        ], Response::HTTP_OK);
    }
    // =========================
    // EDIT USER
    // =========================
    public function edit(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
                'data' => null
            ], Response::HTTP_NOT_FOUND);
        }

        $validations = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($id)],
            'password' => ['nullable', 'string', 'min:12'],
            'role' => ['required', 'string', 'in:Receptionist,Technician,SampleCollector,Pathologist,SpecialistDoctor'],
            'department_id' => ['nullable', 'exists:departments,id'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048']
        ], [
            'email.unique' => 'Email already exists',
        ]);

        if (!empty($request->password)) {
            $validations['password'] = Hash::make($request->password);
        } else {
            unset($validations['password']);
        }

        if ($request->hasFile('image')) {
            if ($user->image && file_exists(public_path($user->image))) {
                unlink(public_path($user->image));
            }
            $imageName = time() . '_' . uniqid() . '.' . $request->image->extension();
            $request->image->move(public_path('ProfileImages'), $imageName);
            $validations['image'] = 'ProfileImages/' . $imageName;
        }

        $user->update($validations);

        return response()->json([
            'success' => true,
            'message' => 'User updated successfully',
            'data' => $user
        ], Response::HTTP_OK);
    }
    // =========================
    // DELETE USER
    // =========================
    public function delete($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
                'data' => null
            ], Response::HTTP_NOT_FOUND);
        }

        if ($user->image && file_exists(public_path($user->image))) {
            unlink(public_path($user->image));
        }

        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully',
            'data' => null
        ], Response::HTTP_OK);
    }
    // =========================
    // RESTORE USER
    // =========================
    public function restoreUser($id)
    {
        $user = User::withTrashed()->find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
                'data' => null
            ], Response::HTTP_NOT_FOUND);
        }

        $user->restore();

        return response()->json([
            'success' => true,
            'message' => 'User restored successfully',
            'data' => $user
        ], Response::HTTP_OK);
    }
    // =========================
    // FORCE DELETE USER
    // =========================
    public function forceDelete($id)
    {
        $user = User::withTrashed()->find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
                'data' => null
            ], Response::HTTP_NOT_FOUND);
        }

        if ($user->image && file_exists(public_path($user->image))) {
            unlink(public_path($user->image));
        }
        if ($user->signature && file_exists(public_path($user->signature))) {
            unlink(public_path($user->signature));
        }

        $user->forceDelete();

        return response()->json([
            'success' => true,
            'message' => 'User permanently removed',
            'data' => null
        ], Response::HTTP_OK);
    }
    // =========================
    // UPDATE PASSWORD
    // =========================
    public function updatePassword(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
                'data' => null
            ], Response::HTTP_NOT_FOUND);
        }

        $request->validate([
            'password' => 'required',
            'newPassword' => 'required|string|min:8'
        ]);

        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Current password does not match',
                'data' => null
            ], Response::HTTP_BAD_REQUEST);
        }

        $user->update([
            'password' => Hash::make($request->newPassword)
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Password updated successfully',
            'data' => $user
        ], Response::HTTP_OK);
    }
    // =========================
    // ADD SIGNATURE
    // =========================
    public function addSignature(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
                'data' => null
            ], Response::HTTP_NOT_FOUND);
        }

        $request->validate([
            'signature' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('signature')) {
            if (!empty($user->signature) && file_exists(public_path($user->signature))) {
                unlink(public_path($user->signature));
            }

            $file = $request->file('signature');
            $signatureName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('Signatures'), $signatureName);

            $user->signature = 'Signatures/' . $signatureName;
            $user->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Signature updated successfully',
            'data' => $user
        ], Response::HTTP_OK);
    }
    // =========================
    // GET SIGNATURE
    // =========================
    public function getSignature(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
                'data' => null
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'success' => true,
            'message' => 'Signature fetched successfully',
            'data' => ['signature' => $user->signature]
        ], Response::HTTP_OK);
    }
    // =========================
    // UPDATE EMAIL
    // =========================
    public function updateEmail(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
                'data' => null
            ], Response::HTTP_NOT_FOUND);
        }

        $validation = $request->validate([
            'email' => 'required|email|unique:users,email,' . $id
        ]);

        $user->update($validation);

        return response()->json([
            'success' => true,
            'message' => 'Email updated successfully',
            'data' => $user
        ], Response::HTTP_OK);
    }
    // =========================
    // DELETE SIGNATURE
    // =========================
    public function deleteSignature($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
                'data' => null
            ], Response::HTTP_NOT_FOUND);
        }

        if ($user->signature && file_exists(public_path($user->signature))) {
            unlink(public_path($user->signature));
        }

        $user->update(['signature' => null]);

        return response()->json([
            'success' => true,
            'message' => 'Signature deleted successfully',
            'data' => $user
        ], Response::HTTP_OK);
    }
}