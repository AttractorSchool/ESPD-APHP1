<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class AgentMiddleware
{
    protected $agent;

    public function __construct(Agent $agent)
    {
        $this->agent = $agent;
    }

    public function handle(Request $request, Closure $next)
    {
        $agentData = ['agent' => $this->agent->getUserAgent()];
        $request->merge($agentData);

        return $next($request);
    }
}
