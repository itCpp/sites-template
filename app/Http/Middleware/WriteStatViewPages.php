<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use App\Models\StatView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WriteStatViewPages
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
        try {

            $data = [
                'ip' => $request->ip(),
                'page' => $request->server('REQUEST_URI') ? mb_substr($request->server('REQUEST_URI'), 0, 500) : null,
                'method' => $request->server('REQUEST_METHOD'),
                'referer' => $request->server('HTTP_REFERER') ? mb_substr($request->server('HTTP_REFERER'), 0, 500) : null,
                'request_data' => [
                    'cookie' => $_COOKIE,
                    'request' => \App\Http\Controllers\Controller::encrypt($request->all()),
                    'headers' => $request->header(),
                    'query_string' => $request->getQueryString(),
                    'session' => $request->session()->all(),
                ],
                'user_agent' => $request->userAgent() ? mb_substr($request->userAgent(), 0, 500) : null,
                'created_at' => now(),
            ];

            StatView::create($data);
        } catch (Exception $e) {
            Log::channel('failed_write_stat')->info($e->getMessage(), $data);
        }

        return $next($request);
    }
}
