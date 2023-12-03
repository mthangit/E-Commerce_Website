<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CustomAuth
{
	public function handle($request, Closure $next, $role)
	{
		if (!Auth::check() || Auth::user()->role != $role) {
            return redirect('login')->withErrors(['message' => 'Incorrect password or account']);
		}
		return $next($request);
	}
}
?>