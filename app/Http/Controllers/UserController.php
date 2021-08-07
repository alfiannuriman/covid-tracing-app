<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserProfileRequest;
use App\Models\UserProfile;

class UserController extends Controller
{
    public function dashboard()
    {
        return view('user.dashboard');
    }

    public function profile()
    {
        $user = auth()->user();
        $profile = UserProfile::getUserProfile();

        return view('user.profile.show', [
            'user' => $user,
            'profile' => $profile,
            'form_options' => [
                'genders' => \App\Models\Gender::all()
            ]
        ]);
    }

    public function storeProfile(UpdateUserProfileRequest $request)
    {
        try {
            $profile = UserProfile::getUserProfile();

            if (!is_null($profile)) {
                $profile->saveModel($request->all());
            } else {
                (new UserProfile)->saveModel($request->all());
            }

            return redirect('user/profile');
        } catch (\Exception $e) {
            abort(500);
        }
    }
}
