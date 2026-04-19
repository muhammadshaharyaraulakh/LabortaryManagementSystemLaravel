<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
class ProfileController extends Controller
{
    public function allusers()
    {
        $users = User::with('department')
            ->where('role', '!=', 'Admin')
            ->whereNotNull('role')
            ->get();

        if ($users->isNotEmpty()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Users retrieved successfully',
                'users' => $users
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Users not found',
            'users' => []
        ], 404);
    }

    public function adduser(Request $request)
    {
        $validations = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:12',
            'role' => 'required|string|in:Receptionist,Technician,SampleCollector,Pathologist,SpecialistDoctor',
            'department_id' => 'nullable|exists:departments,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $validations['password'] = Hash::make($request->password);
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . uniqid() . '.' . $request->image->extension();
            $request->image->move(public_path('ProfileImages'), $imageName);
            $validations['image'] = 'ProfileImages/' . $imageName;
        }

        $user = User::create($validations);

        return response()->json([
            'status' => 'success',
            'message' => 'User added successfully',
        ], 201);
    }

    public function show($id)
    {
        $user = User::with('department')->findOrFail($id);

        return response()->json([
            'status' => 'success',
            'message' => 'User fetched successfully',
            'user' => $user
        ], 200);
    }

    public function edit(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validations = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:12',
            'role' => 'required|string|in:Receptionist,Technician,SampleCollector,Pathologist,SpecialistDoctor',
            'department_id' => 'nullable|exists:departments,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $validations['password'] = Hash::make($request->password);
        if (empty($validations['password'])) {
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
            'status' => 'success',
            'message' => 'User updated successfully'
        ], 200);
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        if ($user->image && file_exists(public_path($user->image))) {
            unlink(public_path($user->image));
        }

        $user->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'User deleted successfully'
        ], 200);
    }
    public function updatePassword(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'password' => 'required',
            'newPassword' => 'required|string|min:8'
        ]);

        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 400,
                'message' => 'Current password does not match'
            ]);
        }

        $user->update([
            'password' => Hash::make($request->newPassword)
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Password updated successfully'
        ]);
    }

    public function addSignature(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => 404,
                'message' => 'User not found'
            ]);
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
            'status' => 200,
            'message' => 'Signature updated successfully'
        ]);
    }
    public function getSignature(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'status' => 404,
                'message' => 'User not found'
            ]);
        }
        return response()->json([
            'status' => 200,
            'message' => 'Signature fetched successfully',
            'signature' => $user->signature
        ]);
    }
    public function updateGamil(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $validation = $request->validate([
            'gmail' => 'required|gmail|unique:User,gmail'
        ]);
        $user->update($validation);
        return response()->json([
            'status' => 200,
            'message' => 'Gmail updated successfully'
        ]);
    }
    public function updateEmail(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $validation = $request->validate([
            'email' => 'required|email|unique:users,email,' . $id
        ]);
        $user->update($validation);
        return response()->json([
            'status' => 200,
            'message' => 'Email updated successfully'
        ]);
    }
    public function deleteSignature($id)
    {
        $user = User::findOrFail($id);
        if ($user->signature && file_exists(public_path($user->signature))) {
            unlink(public_path($user->signature));
        }
        $user->update(['signature' => null]);
        return response()->json(['status' => 200, 'message' => 'Deleted']);
    }
}