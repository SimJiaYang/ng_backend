<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\File;

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
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'gender' => ['nullable', 'string', 'max:255'],
            'contact_number' => ['nullable', 'numeric'],
            'image' => ['nullable', 'image', 'mimes:jpeg,bmp,png,jpg,svg'],
            'birth_date' => ['nullable', 'date', 'before:today'],
        ]);

        $user = $request->user();

        //Handle Photo
        if ($request->hasFile('image')) {
            $old_path = public_path('user_image/' . $user->image);
            if (File::exists($old_path)) {
                File::delete($old_path);
            }
            $imageName = time() . '.' . $request->file('image')->extension();
            $request->image->move(public_path('/user_image'), $imageName);
        } else {
            $imageName = $user->image;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->gender = $request->gender;
        $user->contact_number = $request->contact_number;
        $user->image = $imageName;
        $user->birth_date = $request->birth_date;
        $user->save();

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
