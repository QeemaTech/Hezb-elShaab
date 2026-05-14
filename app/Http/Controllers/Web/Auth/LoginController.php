<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.auth.login');
    }
    public function login(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();

        if ($user->status == 0) {
            Auth::logout();
            return redirect()->back()->withErrors(['message' => __('auth.account_inactive')]);
        }

        // Admin or other login
        return redirect(RouteServiceProvider::HOME)->with('success', __('auth.login_success'));
    }
    public function logout(Request $request)
    {

        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(RouteServiceProvider::FRONTEND)->with('success', __('auth.logout_success'));
    }
    public function profile()
    {
        return view('admin.profile.profile');
    }
    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        // Validation rules
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'phone' => ['nullable', 'string', 'max:20'],
            'image' => ['nullable', 'image', 'max:2048'],
        ];

        // If user is trying to change password
        if ($request->filled('old_password') || $request->filled('password')) {
            $rules['old_password'] = ['required'];
            $rules['password'] = ['required', 'confirmed', 'min:6'];
        }

        $validated = $request->validate($rules);

        // If changing password, check old password
        if ($request->filled('old_password')) {
            if (!Hash::check($request->old_password, $user->password)) {
                return back()->withErrors(['old_password' => __('messages.old_password_incorrect')])->withInput();
            }
            $user->password = Hash::make($request->password);
        }

        // Update basic fields
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->phone = $validated['phone'] ?? null;

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($user->image && Storage::exists($user->image)) {
                Storage::delete($user->image);
            }

            $path = $request->file('image')->store('uploads/users', 'public');
            $user->image = 'storage/' . $path;
        }

        $user->save();

        return redirect()->back()->with('success', __('messages.profile_updated_successfully'));
    }
}
