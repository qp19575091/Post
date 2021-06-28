<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Response;

/**
 * @group Auth endpoints
 */
class UserController extends Controller
{
    /**
     * Handle a registration request for the application.
     * 
     * @bodyParam name string required The name of the user. Example: Demo
     * @bodyParam email email required The email of the user. Example: demo@demo.com
     * @bodyParam password password required The password of the user. Example: password
     * @bodyParam password_confirmation password required The password confirmation of the user. Example: password
     *
     * @response status=200 {
     *     "message": "Account has been created"
     * }
     *
     * @response status=422 scenario="Validation error" {
     *    "message": "The given data was invalid.",
     *    "errors": {
     *        "name": [
     *            "The name has already been taken."
     *     ],
     *        "email": [
     *            "The email has already been taken."
     *     ]
     *    }
     * }
     * @response status=422 scenario="Validation error" {
     *    "message": "The given data was invalid.",
     *    "errors": {
     *        "name": [
     *            "The name field is required."
     *     ],
     *        "email": [
     *            "The email field is required."
     *     ],
     *        "password": [
     *            "The password field is required."
     *     ]
     *    }
     * }
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(UserRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        
        return response()->json([
            'message' => 'Account has been created',
        ], 200);
    }

    /**
     * Handle a login request to the application.
     *
     * @bodyParam email email required The email of the user. Example: demo@demo.com
     * @bodyParam password password required The password of the user. Example: password
     *
     * @response status=200 {
     *    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjc
     *              uMC4wLjE6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTYyMzg5MzAyNCwiZXhwIjo
     *              xNjIzODk2NjI0LCJuYmYiOjE2MjM4OTMwMjQsImp0aSI6IndkTllaU3NoejlBZmt
     *              PRzgiLCJzdWIiOjExLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA
     *              4NzJkYjdhNTk3NmY3In0.eEMJuRcY5OgSD2l4jLhbcBKBA5QvCvkrPBn8ZzKyP38"
     * }
     * 
     * @response status=422 scenario="Validation error" {
     *    "message": "The given data was invalid.",
     *    "errors": {
     *        "name": [
     *            "The name field is required."
     *     ],
     *        "password": [
     *            "The password field is required."
     *     ]
     * }
     * @response status=422 scenario="Validation error" {
     *    "message": "The given data was invalid.",
     *    "errors":  "The name or password field is wrong."
     * }
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */

    public function login(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
            'password' => 'required|min:8|max:20'
        ]);
        $token = Auth::attempt([
            'name' => $request->name,
            'password' => $request->password
        ]);
        if ($token) {
            return response()->json(['message' => 'success', 'token' => $token]);
        }
        return response()->json([
            'message' => 'The given data was invalid.',
            'error' => 'The name or password field is wrong.'
        ], 422);
    }


    /**
     * Log the user out of the application.
     *
     * @authenticated
     * @response status=204 scenario={
     *     "message": "Success."
     * }
     * @response status=401 scenario="Unauthenticated" {
     *     "message": "Unauthenticated."
     * }
     * @response status=500 scenario="Unauthenticated" {
     *     "message": "Server error."
     * }
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'Success.'], 204);

        // try {
        //     if (!$user = JWTAuth::parseToken()->authenticate()) {
        //         return response()->json(['user_not_found'], 404);
        //     }
        // } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
        //     return response()->json(['message' => 'Unauthenticated.'], 401);
        // } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
        //     return response()->json(['message' => 'Not find.'], 404);
        // } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
        //     return response()->json(['message' => 'Server error.'], 500);
        // }
        // return response()->json(['message' => 'Success.'], 204);
    }


    /**
     * Shows authenticated user information
     * 
     * @authenticated
     * 
     * @response 200 {
     *     "id": 2,
     *     "name": "Demo",
     *     "email": "demo@demo.com",
     *     "email_verified_at": null,
     *     "created_at": "2020-05-25T06:21:47.000000Z",
     *     "updated_at": "2020-05-25T06:21:47.000000Z"
     * }
     * 
     * @response status=401 scenario="Unauthenticated" {
     *     "message": "Unauthenticated."
     * }
     */
    public function index()
    {
        return response()->json(auth()->user(), 200);
    }
}
