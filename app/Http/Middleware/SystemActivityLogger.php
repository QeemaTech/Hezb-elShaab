<?php

namespace App\Http\Middleware;

use App\Models\LogSystem;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SystemActivityLogger
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (! $request->is('admin/*')) {
            return $response;
        }

        $payload = $this->sanitizePayload($request->all());

        try {
            $routeName = $request->route()?->getName();
            LogSystem::create([
                'user_id' => $request->user()?->id,
                'action' => $this->resolvePageAction($routeName),
                'category' => 'dashboard',
                'description' => 'Dashboard action executed',
                'method' => $request->method(),
                'url' => $request->fullUrl(),
                'route_name' => $routeName,
                'status_code' => $response->getStatusCode(),
                'ip_address' => $request->ip(),
                'user_agent' => (string) $request->userAgent(),
                'payload' => $payload ?: null,
                'created_at' => now(),
            ]);
        } catch (\Throwable $e) {
            // prevent audit logger failures from breaking dashboard requests
        }

        return $response;
    }

    private function sanitizePayload(array $payload): array
    {
        $blocked = [
            'password',
            'password_confirmation',
            'token',
            '_token',
            'current_password',
            'new_password',
        ];

        foreach ($blocked as $key) {
            if (array_key_exists($key, $payload)) {
                $payload[$key] = '***';
            }
        }

        return $payload;
    }

    private function resolvePageAction(?string $routeName): ?string
    {
        if (! $routeName) {
            return null;
        }

        $parts = explode('.', $routeName);

        // admin.users.index => users
        if (count($parts) >= 2 && $parts[0] === 'admin') {
            return $parts[1];
        }

        return $parts[0] ?? $routeName;
    }
}
