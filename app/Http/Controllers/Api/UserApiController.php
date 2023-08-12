<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class UserApiController extends Controller
{
    /**
     * Register
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        $token = $user->createToken($user)->plainTextToken;

        return $this->success($token);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        // Find the user exist
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = User::where('email', $request->email)->first();

            if ($user->type == "admin") {
                return $this->fail('Invalid Credentials');
            }

            $name = $request->userAgent();

            $token = $user->createToken($name)->plainTextToken;

            $ret = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'token' => $token,
            ];

            return $this->success($ret);
        } else {
            return $this->fail('Invalid Credentials');
        }
    }

    // logout
    public function destroy(Request $request)
    {
        $user = $request->user();

        $user->currentAccessToken()->delete();

        return $this->success();
    }
}
