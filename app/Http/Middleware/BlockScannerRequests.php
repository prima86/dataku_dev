<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BlockScannerRequests
{
    /**
     * Handle incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $uri = ltrim($request->getPathInfo(), '/');

        /*
        |--------------------------------------------------------------------------
        | 1. Cek PREFIX (sangat cepat)
        |--------------------------------------------------------------------------
        */

        foreach (config('scanner.prefixes', []) as $prefix) {

            if (str_starts_with($uri, $prefix)) {

                return $this->block($request, 'PREFIX', $prefix);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | 2. Cek REGEX
        |--------------------------------------------------------------------------
        */

        foreach (config('scanner.patterns', []) as $pattern) {

            if (preg_match($pattern, $uri)) {

                return $this->block($request, 'REGEX', $pattern);
            }
        }

        return $next($request);
    }

    /**
     * Blokir request scanner.
     */
    protected function block(Request $request, string $type, string $rule)
    {
        Log::channel('scanner')->warning('BLOCKED_SCANNER', [

            'datetime'   => now()->toDateTimeString(),

            'ip'         => $request->ip(),

            'method'     => $request->method(),

            'uri'        => $request->getRequestUri(),

            'url'        => $request->fullUrl(),

            'user_agent' => $request->userAgent(),

            'referer'    => $request->headers->get('referer'),

            'rule_type'  => $type,

            'rule'       => $rule,

        ]);

        /*
         * Jangan gunakan abort(404)
         * karena akan dilempar ke Exception Handler.
         */

        return response('', 404);
    }
}
