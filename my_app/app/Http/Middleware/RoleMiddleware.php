<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
// use 

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = $request->user();
        if(!$user || !in_array($user->role, $roles)){

            return response()->json([
                'error'=>true,
                'message'=>'Unauthorized request!',
                'data'=>null
            ],403);
        }

        return $next($request);
    }
}

// CMD to handle role based authentication::
// php artisan make:middleware RoleMiddleware
// php artisan make:model -a --api

//USAGE::
// Route::post('/post', [PostController::class, 'store'])->middleware('role: USER,ADMIN');
 
// in Bootstrap/appphp::
// $middleware->alias('role' =>RoleMiddleware::class);

/*
if(!in_array($request->user(), $role)){
    return [
        "error": True,
        "message": "Access denied, an-authorized request!",
        "data": null
    ]
}

return ====;

$middleware->add(App\Http\Middleware\RoleMiddleware::class, 'role');

Route::middleware->groups( function (){
    Route::post('/post', [AuthController::class, 'post'])->middleware('role: USER,ADMIN');
    Route::get('/user', [AuthUserController:;class, 'getUser'])->middleware('role: ADMIN');
})

$table->this('role', ['ADMIN','USER','MEMBER']);
*/