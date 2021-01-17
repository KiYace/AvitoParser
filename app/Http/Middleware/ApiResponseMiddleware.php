<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class ApiResponseMiddleware
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next)
  {
    $message = sprintf('%s %s request', $request->method(), $request->path());
    Log::channel('api')->info($message, $request->all());
    $response = $next($request);
    $context = $response->getOriginalContent();
    $message = sprintf('%s %s response', $request->method(), $request->path());
    if (is_array($context)) {
      if ($response->status() == 200) {
        Log::channel('api')->info($message, $context);
      } else {
        Log::channel('api')->error($message, $context, $request->headers_sent);
      }
    }
    $response->header('Content-Type', 'application/json');
    return $response;
  }
}
