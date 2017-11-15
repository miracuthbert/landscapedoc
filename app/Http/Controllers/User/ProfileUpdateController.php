<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileUpdateController extends Controller
{
    /**
     * ProfileUpdateController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Update user in storage.
     *
     * @param Request $request
     * @param $id
     * @return
     */
    public function __invoke(Request $request, $id)
    {
        $this->validate($request, [
            'first_name' => 'required|string|max:30',
            'last_name' => 'required|string|max:30',
            'username' => [
                'required',
                'string',
                'max:30',
                Rule::unique('users')->ignore($id)
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($id),
            ],
        ]);

        if (!Hash::check($request->input('password'), Auth::user()->password)) {
            return redirect()->back()
                ->withError('Invalid credentials! Profile update failed.');
        }

        //find user
        $user = $request->user();
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->username = $request->input('username');
        $user->email = $request->input('email');

        if ($user->update()) {
            return redirect()->back()
                ->withSuccess('Profile updated successfully.');
        } else {
            return redirect()->back()
                ->withError('Profile update failed.');
        }
    }
}
