<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class AuthApiController extends Controller
{
    /**
     * Register a new user
     * @method POST api/v1/register
     *
     * POST
     * @param name string
     * @param email string
     * @param password string
     *
     * User Information
     * @return $name
     * @return $email
     * @return $token
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', Rules\Password::defaults()],
        ]);

        // Validate email exist
        if (User::where('email', $request->email)->exists()) {
            return $this->fail('Email already exist');
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        $token = $user->createToken("auth_token")->plainTextToken;

        $ret = [
            'name' => $user->name,
            'email' => $user->email,
            'token' => $token,
        ];

        return $this->success($ret);
    }

    /**
     * Login user
     * @method POST api/v1/login
     *
     * POST
     * @param email string
     * @param password string
     *
     * User Information
     * @return $name
     * @return $email
     * @return $token
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        // Find the user exist
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = User::where('email', $request->email)->first();

            if ($user->type == "admin" || $user->type == "sadmin") {
                return $this->fail('Invalid Credentials');
            }

            $token = $user->createToken("auth_token")->plainTextToken;

            $ret = [
                'name' => $user->name,
                'email' => $user->email,
                'token' => $token,
            ];

            return $this->success($ret);
        } else {
            return $this->fail('Invalid Credentials');
        }
    }

    /**
     * Logout user
     * @method GET api/v1/logout
     *
     * User Information
     * @return $message
     */
    public function destroy(Request $request)
    {
        $user = $request->user();

        $user->currentAccessToken()->delete();

        return $this->success();
    }
}
