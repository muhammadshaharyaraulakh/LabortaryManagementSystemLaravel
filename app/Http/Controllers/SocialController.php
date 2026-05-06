<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class SocialController extends Controller
{
    public function googleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                return redirect()->route('login')->with('error', 'Email Not Found');
            }

            Auth::login($user);
            return $this->redirectUser($user);
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Login Failed');
        }
    }

    public function githubRedirect()
    {
        return Socialite::driver('github')->redirect();
    }

    public function githubCallback()
    {
        try {
            $githubUser = Socialite::driver('github')->user();
            $user = User::where('email', $githubUser->getEmail())->first();

            if (!$user) {
                return redirect()->route('login')->with('error', 'Email Not Found');
            }

            Auth::login($user);
            return $this->redirectUser($user);
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Login Failed');
        }
    }

    private function redirectUser($user)
    {
        $role = strtolower(trim($user->role));

        if ($role === 'technician') {
            if ($user->department && $user->department->type === 'human_based') {
                return redirect()->route('HumanTechnicianDashboard');
            }
            return redirect()->route('SampleBasedTechnician');
        }

        if ($role === 'pathologist' || $role === 'specialistdoctor') {
            return redirect()->route('pathologist.dashboard');
        }

        $routeMap = [
            'admin' => 'admin.adminstrator',
            'receptionist' => 'receptionist',
            'samplecollector' => 'samplecollector.dashboard',
        ];

        return redirect()->route($routeMap[$role] ?? 'login');
    }

}
