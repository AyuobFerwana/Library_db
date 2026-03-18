<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAge
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $age): Response
    {

        /**
         * Before
         * * */

        // if ($age >= 18) {
        //     return $next($request);
        // }
        // abort(403, 'Age is Lowe Than 18');


        /**
         * After
         *
         **/
        $response = $next($request);
        if ($age >= 18) {
            return $response;
        }
        return $response;

        // abort(403, 'Age is Lowe Than 18');
    }
}
