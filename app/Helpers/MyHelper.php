<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

if (!function_exists('getUserFromCookie')) {
    function getUserFromCookie($cookie)
    {
        try{
            $tokenPayload = JWT::decode($cookie, new Key(env('jwt_key'), 'HS256'));

            return $tokenPayload;
        }catch(\Throwable $t){
            return '';
        }

    }
}
