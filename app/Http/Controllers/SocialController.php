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
                return redirect()->route('login')
                    ->with('error', 'Email Not Found');
            }
            Auth::login($user);
            $role = strtolower($user->role);

            $routeMap = [
                'admin' => 'admin.adminstrator',
                'receptionist' => 'receptionist.dashboard',
                'pathologist' => 'pathologist.dashboard',
                'samplecollector' => 'samplecollector.dashboard',
            ];
            return redirect()->route($routeMap[$role] ?? 'login');

        } catch (\Exception $e) {

            return redirect()->route('login')
                ->with('error', 'Login Failed');

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
                return redirect()->route('login')
                    ->with('error', 'Email Not Found');
            }

            Auth::login($user);

            $role = strtolower(trim($user->role));

            $routeMap = [
                'admin' => 'admin.adminstrator',
                'receptionist' => 'receptionist.dashboard',
                'pathologist' => 'pathologist.dashboard',
                'samplecollector' => 'samplecollector.dashboard',
            ];

            return redirect()->route($routeMap[$role] ?? 'login');

        } catch (\Exception $e) {

            return redirect()->route('login')
                ->with('error', 'Login Failed');

        }
    }

}
