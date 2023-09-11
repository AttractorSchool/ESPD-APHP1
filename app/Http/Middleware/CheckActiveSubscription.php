<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckActiveSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        if ($user && !$user->hasActiveSubscription()) {
            if (!$request->session()->has('subscription_checked')) {
                $request->session()->put('subscription_checked', true);
                return redirect()->route('subscriptions');
            }
        }
        if ($user) {
            $subs = $user->subscription;
            foreach ($subs as &$sub) {
                if ($sub->end_date <= now()) {
                    $sub->delete();
                    $request->session()->forget('subscription_checked');
                }
            }
        }

        return $next($request);
    }
}
