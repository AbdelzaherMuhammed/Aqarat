<?php

namespace App\Http\Controllers\Front;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function editUserProfile()
    {
        $user = auth()->user();
        return view('website.profile.edit', compact('user'));
    }

    public function UpdateUserProfile(Request $request)
    {
        $rules = [
            'name' => '|string|max:255',
            'email' =>  'string|email|max:255|unique:users,email,' . auth()->user()->id,
        ];

        $this->validate($request , $rules);

        $user = auth()->user();
        $user->update($request->all());
        return back()->withFlashMessage('تم التعديل بنجاح');
    }

    public function changePassword(Request $request)
    {
        $rules = [
            'old_password' => 'min:8',
            'new_password' => 'min:8|confirmed'
        ];
        $this->validate($request, $rules);

        $user = auth()->user();

        if (Hash::check($request->input('old_password') , $user->password))
        {
            $user->password = bcrypt($request->input('new_password'));
            $user->save();
            flash()->success('تم تغيير كلمة المرور بنجاح');
            return back();

        } else {
            flash()->error('كلمة المرور ليست صحيحه');
            return back();
        }
    }
}
