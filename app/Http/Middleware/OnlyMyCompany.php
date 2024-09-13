<?php

namespace App\Http\Middleware;

use App\Models\Empresa;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OnlyMyCompany
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
        $exists = Empresa::where([
            'user_id' => Auth::id(),
            'serial' => $request->route("serial") ?? request('empresa_serial'),
        ])->exists();

        if (!$exists) {
            return response()->json(['error' => 'No se encontró la empresa'], 404);
        }
        
        return $next($request);
    }
}
