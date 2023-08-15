<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserApiController extends Controller
{
    public function show(Request $request)
    {
        $user = $request->user();

        $ret = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ];

        return $this->success($ret);
    }

    // Not add to route yet, need amend
    public function update(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255'],
        ]);

        $user = $request->user();

        $user->update($data);

        return $this->success();
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => ['required', Rules\Password::defaults()],
        ]);

        $user = $request->user();

        $user->update(['password' => Hash::make($request->password)]);

        return $this->success();
    }
}
