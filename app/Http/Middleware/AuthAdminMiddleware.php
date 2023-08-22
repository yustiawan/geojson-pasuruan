<?php

namespace App\Http\Middleware;
use Closure;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class AuthAdminMiddleware {
    public function handle($request, Closure $next) {
            try{
                $token = @$request->cookie('appkemisan');
                if($token==''||$token==null){
                   return redirect(url('login'));
                }
                $tokenPayload = JWT::decode($token, new Key(env('jwt_key'), 'HS256'));
                return $next($request);
            } catch(\Exception $th){
                //echo json_encode($th);
                abort(403, 'Access denied');
            }

    }
}
