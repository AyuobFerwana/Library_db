<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    //

    public function showLogin($guard)
    {
        return view('cms.auth.login', compact('guard'));
    }

    public function login(Request $request)
    {

        $table = $request->input('guard') === 'admin' ? 'admins' : 'publishers';

        $validator = Validator($request->all(), [
            'guard' => 'required|in:admin,publisher',
            'email' => "required|email|exists:$table,email",
            'password' => 'required|string|min:6',
            'remember' => 'boolean',
        ], [
            'guard.in' => 'Check login URL'
        ]);
        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];
        if (! $validator->fails()) {
            if (Auth::guard($request->input('guard'))->attempt(
                $credentials,
                $request->input('remember')
            )) {
                return response()->json(['message' => 'Login
                successfuly'], Response::HTTP_OK);
            } else {
                return response()->json(['message' => 'Login    failed ! , Check your credentials'], Response::HTTP_BAD_REQUEST);
            }
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    public function logout(Request $request)
    {

        $guard = Auth::guard('admin')->check() ? 'admin' : 'publisher';

        Auth::guard($guard)->logout();
        $request->session()->invalidate();

        return redirect()->route('auth.login', $guard);
    }

    public function changePassword()
    {
        return view('cms.auth.changePassword');
    }

    public function updatePassword(Request $request)
    {

        $guard = Auth::guard('admin')->check() ? 'admin' : 'publisher';
        $validator = Validator($request->all(), [
            'old_password' => "required|string|min:6|current_password:$guard",
            'new_password' => 'required|string|min:6|confirmed',
            'new_password_confirmation' => 'required|string|min:6',
        ]);

        if (! $validator->fails()) {
            $user = auth($guard)->user();
            $user->password = Hash::make($request->input('new_password'));
            $isSaved = $user->save();

            return response()->json(['message' => $isSaved ? 'Password Updated Successfully' : 'Password Update Failed'], $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    public function editProfile()
    {
        $guard = Auth::guard('admin')->check() ? 'admin' : 'publisher';

        return view('cms.auth.editProfile', ['user' => auth($guard)->user()]);
    }

    public function updateProfile(Request $request)
    {
        $guard = Auth::guard('admin')->check() ? 'admin' : 'publisher';
        $table = $guard == 'admin' ? 'admins' : 'publishers';
        $validator = Validator($request->all(), [
            'email' => "required|string|email|unique:$table,email," . Auth::guard($guard)->id(),
            'name' => 'required|string|min:3|max:40'
        ]);


        if (! $validator->fails()) {
            $user = auth($guard)->user();
            $user->email = $request->input('email');
            $user->name = $request->input('name');
            $isSaved = $user->save();
            return response()->json(['message' => $isSaved ? 'Profile Updated Successfully' : 'Profile Update Failed'], $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }
}
