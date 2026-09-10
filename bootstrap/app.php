<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\CheckRole;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        channels: __DIR__.'/../routes/channels.php',
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->trustProxies(at: '*');
        $middleware->alias([
            'check.role' => CheckRole::class,
        ]);
        $middleware->redirectTo(
            guests: '/login',
            users: function () {
                $user = auth()->user();
                if (!$user) {
                    return '/';
                }
                $role = strtolower(trim($user->role));
                if ($role === 'technician') {
                    if ($user->department && $user->department->type === 'human_based') {
                        return route('HumanTechnicianDashboard');
                    }
                    return route('SampleBasedTechnician');
                }
                if ($role === 'pathologist' || $role === 'specialistdoctor') {
                    return route('pathologist.dashboard');
                }
                $routeMap = [
                    'admin' => 'admin.adminstrator',
                    'receptionist' => 'receptionist',
                    'samplecollector' => 'samplecollector.dashboard',
                ];
                return isset($routeMap[$role]) ? route($routeMap[$role]) : url('/');
            }
        );
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
