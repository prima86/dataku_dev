<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


class PerformanceLogger
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $start = microtime(true);

        $queryCount = 0;
        $queryTime = 0;

        DB::listen(function ($query) use (&$queryCount, &$queryTime) {
            $queryCount++;
            $queryTime += $query->time;
        });


        // DB::listen(function ($query) use (&$queryCount, &$queryTime) {
        //     $queryCount++;
        //     $queryTime += $query->time;

        //     if ($query->time >= 1000) {

        //         Log::channel('performance')->warning('SLOW QUERY', [

        //             'sql' => $query->sql,

        //             'bindings' => $query->bindings,

        //             'time_ms' => $query->time,

        //             'url' => request()->fullUrl()

        //         ]);
        //     }
        // });

        $response = $next($request);

        $duration = round((microtime(true) - $start) * 1000, 2);

        /*
         * Simpan hanya request yang:
         * - lebih dari 500 ms
         * - error (>=500)
         */

        if ($duration >= 500 || $response->status() >= 500) {

            Log::channel('performance')->warning('PERFORMANCE', [

                'datetime'      => now()->toDateTimeString(),

                'ip'            => $request->ip(),

                'method'        => $request->method(),

                'url'           => $request->fullUrl(),

                'route'         => optional($request->route())->getName(),

                'controller'    => optional($request->route())->getActionName(),

                'status'        => $response->status(),

                'duration_ms'   => $duration,

                'memory_mb'     => round(memory_get_peak_usage(true)/1048576,2),

                'query_count'   => $queryCount,

                'query_time_ms' => round($queryTime,2),

                'user_id'       => optional(Auth::user())->id,

                'user_agent'    => $request->userAgent()

            ]);
        }

        return $response;
        // return $next($request);
    }
}
