<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Mail\VerificationEmail;
use App\Models\User;

class loginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (!Auth::validate($credentials)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid email or password.'
            ], 401);
        }

        $user = User::where('email', $request->email)->first();
        $verificationCode = rand(10000000, 99999999);

        Mail::to($user->email)->send(new VerificationEmail($user, $verificationCode));

        Session::put([
            'LoginVerificationCode' => $verificationCode,
            'LoginPendingUserId' => $user->id
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Verification Code has been sent to your email',
            'redirect_url' => '/VerifyCode',
        ], 200);
    }

    public function verifyCode(Request $request)
    {
        $request->validate([
            'VerificationCode' => 'required|digits:8|numeric'
        ]);

        if (Session::has('LoginPendingUserId') && Session::has('LoginVerificationCode')) {
            if ($request->VerificationCode != Session::get('LoginVerificationCode')) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid or expired login verification code.'
                ], 401);
            }

            $user = User::find(Session::get('LoginPendingUserId'));
            Auth::login($user);

            Session::forget(['LoginVerificationCode', 'LoginPendingUserId']);

            $role = trim($user->role);
            $routeMap = [
                'admin' => 'admin.adminstrator',
                'receptionist' => '/receptionist',
                'pathologist' => 'pathologist.dashboard',
                'SampleCollector' => 'samplecollector.dashboard',
            ];

            $redirectUrl = array_key_exists($role, $routeMap) ? route($routeMap[$role]) : url('/');

            return response()->json([
                'status' => 'success',
                'message' => 'Login successful',
                'redirect_url' => $redirectUrl,
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                ]
            ], 200);
        }

        if (Session::has('ResetPendingUserId') && Session::has('ResetVerificationCode')) {
            if ($request->VerificationCode != Session::get('ResetVerificationCode')) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid or expired password reset code.'
                ], 401);
            }

            Session::forget('ResetVerificationCode');
            Session::put('CanResetPassword', true);

            return response()->json([
                'status' => 'success',
                'message' => 'Code verified. Please set a new password.',
                'redirect_url' => '/resetPassword',
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Session expired or invalid request. Please try again.'
        ], 401);
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'If this email exists, a code will be sent.'
            ], 401);
        }

        $verificationCode = rand(10000000, 99999999);
        Mail::to($user->email)->send(new VerificationEmail($user, $verificationCode));

        Session::put([
            'ResetVerificationCode' => $verificationCode,
            'ResetPendingUserId' => $user->id
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Verification Code has been sent to your email',
            'redirect_url' => '/VerifyCode',
        ], 200);
    }

    public function resetPassword(Request $request)
    {
        if (!Session::get('CanResetPassword') || !Session::get('ResetPendingUserId')) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized request.'
            ], 403);
        }

        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::find(Session::get('ResetPendingUserId'));
        $user->password = bcrypt($request->password);
        $user->save();

        Session::forget(['ResetPendingUserId', 'CanResetPassword']);

        return response()->json([
            'status' => 'success',
            'message' => 'Password reset successful',
            'redirect_url' => '/login',
        ], 200);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}