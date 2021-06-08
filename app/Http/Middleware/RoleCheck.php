<?php
	
	namespace App\Http\Middleware;
	
	use Closure;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Route;
	
	class RoleCheck
	{
		/**
		 * Handle an incoming request.
		 *
		 * @param \Illuminate\Http\Request $request
		 * @param \Closure $next
		 * @return mixed
		 */
		public function handle(Request $request, Closure $next)
		{
			if (Route::currentRouteName() == 'home') {
				if (auth()->user()->role_id == 4) {
					return redirect()->route('stock');
				} else {
					return $next($request);
				}
			}
			
			if (Route::currentRouteName() == 'purchases') {
				if (auth()->user()->role_id == 3 or auth()->user()->role_id == 4) {
					return redirect()->back()->withErrors('Acesso restrito');
				} else {
					return $next($request);
				}
			}
			
			if (Route::currentRouteName() == 'documents') {
				if (auth()->user()->role_id == 3) {
					return redirect()->back()->withErrors('Acesso restrito');
				} else {
					return $next($request);
				}
			}
			if (Route::currentRouteName() == 'employees') {
				if (auth()->user()->role_id == 4) {
					return redirect()->back()->withErrors('Acesso restrito');
				} else {
					return $next($request);
				}
			}
			
			if (Route::currentRouteName() == 'blueprints') {
				if (auth()->user()->role_id == 4) {
					return redirect()->back()->withErrors('Acesso restrito');
				} else {
					return $next($request);
				}
			}
			
			if (Route::currentRouteName() == 'projects') {
				if (auth()->user()->role_id == 4) {
					return redirect()->back()->withErrors('Acesso restrito');
				} else {
					return $next($request);
				}
			}
			
			if (Route::currentRouteName() == 'stock') {
				if (auth()->user()->role_id == 3) {
					return redirect()->back()->withErrors('Acesso restrito');
				} else {
					return $next($request);
				}
			}
		}
	}
