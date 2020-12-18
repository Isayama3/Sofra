<?php

namespace App\Http\Middleware;

use Closure;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use function PHPUnit\Framework\isEmpty;

class CheckPermission
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
        $routeName = $request->route()->getName();
        $permission = Permission::whereRaw("FIND_IN_SET('$routeName',routes)")->first();
        $roles = Role::all();
        if($permission)
        {
            if (!$request->user('web')->can($permission->name))
            {
                if ($roles->isEmpty()){
                    return $next($request);
                }
                flash()->error('Sorry u dont have permission to do that');
                return back();
            }
        }
        return $next($request);
    }
}
