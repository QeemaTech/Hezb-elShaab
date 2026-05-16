<?php

use App\Http\Middleware\SystemActivityLogger;
use App\Models\LogSystem;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
        ]);
        $middleware->appendToGroup('web', SystemActivityLogger::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (\Spatie\Permission\Exceptions\UnauthorizedException $e, $request) {
            try {
                LogSystem::create([
                    'user_id' => $request->user()?->id,
                    'action' => 'authz.denied',
                    'category' => 'security',
                    'description' => 'Access denied by role/permission middleware',
                    'method' => $request->method(),
                    'url' => $request->fullUrl(),
                    'route_name' => $request->route()?->getName(),
                    'status_code' => 403,
                    'ip_address' => $request->ip(),
                    'user_agent' => (string) $request->userAgent(),
                    'payload' => null,
                    'created_at' => now(),
                ]);
            } catch (\Throwable $ignored) {
            }

            $previous = url()->previous();
            return redirect($previous ?: route('admin.dashboard'))
                ->with('error', __('messages.does_not_has_permissions'));
        });

        $exceptions->render(function (AuthorizationException $e, $request) {
            try {
                LogSystem::create([
                    'user_id' => $request->user()?->id,
                    'action' => 'authz.denied',
                    'category' => 'security',
                    'description' => 'Access denied by authorization gate/policy',
                    'method' => $request->method(),
                    'url' => $request->fullUrl(),
                    'route_name' => $request->route()?->getName(),
                    'status_code' => 403,
                    'ip_address' => $request->ip(),
                    'user_agent' => (string) $request->userAgent(),
                    'payload' => null,
                    'created_at' => now(),
                ]);
            } catch (\Throwable $ignored) {
            }

            $previous = url()->previous();
            return redirect($previous ?: route('admin.dashboard'))
                ->with('error', __('messages.does_not_has_permissions'));
        });
    })->create();
