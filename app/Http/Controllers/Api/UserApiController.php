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
            'name' => $user->name,
            'email' => $user->email,
            'address' => $user->address,
            'gender' => $user->gender,
            'contact_number' => $user->contact_number,
            'image' => $user->image,
            'birth_date' => $user->birth_date
        ];

        return $this->success($ret);
    }

    // Upddate profile
    public function update(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'gender' => ['nullable', 'string', 'max:255'],
            'contact_number' => ['nullable', 'numeric'],
            'image' => ['nullable', 'string', 'max:255'],
            'birth_date' => ['nullable', 'date', 'before:today'],
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
