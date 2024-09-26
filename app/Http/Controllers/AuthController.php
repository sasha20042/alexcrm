<?php
  
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth/register');
    }
  
    public function registerSave(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed'
        ])->validate();
  
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => 'Admin'
        ]);
  
        return redirect()->route('login');
    }
  
    public function login()
    {
        return view('auth/login');
    }
  
    public function loginAction(Request $request)
    {
        Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ])->validate();
  
        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed')
            ]);
        }
  
        $request->session()->regenerate();
  
        return redirect()->route('dashboard');
    }
  
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        return redirect('/');
    }
 
    public function profile()
    {
        return view('profile');
    }

    public function updateProfile(Request $request)
    {
        // Validate incoming data
        Validator::make($request->all(), [
            'name' => 'required',
            'personal_phone' => 'nullable|string',
            'work_phone_1' => 'nullable|string',
            'work_phone_2' => 'nullable|string',
            'address' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'social_media' => 'nullable|array',
            'social_media.*.platform' => 'required|string|in:Facebook,Instagram',
            'social_media.*.login' => 'required|string',
            'social_media.*.password' => 'required|string',
            'social_media.*.link' => 'required|url',
        ])->validate();
    
        // Update user data
        $user = Auth::user();
        $user->name = $request->name;
        $user->personal_phone = $request->personal_phone;
        $user->work_phone_1 = $request->work_phone_1;
        $user->work_phone_2 = $request->work_phone_2;
        $user->address = $request->address;
    
        // Handle photo upload
        if ($request->hasFile('photo')) {
            if ($user->photo) {
                Storage::delete('public/' . $user->photo);
            }
            $filePath = $request->file('photo')->store('photos', 'public');
            $user->photo = $filePath;
        }
    
        // Handle social media data
        if ($request->filled('social_media')) {
            $user->social_media = json_encode($request->social_media);
        } else {
            // Clear social media if not provided
            $user->social_media = null;
        }
    
        // Save user data
        $user->save();
    
        return redirect()->back()->with('success', 'Профіль оновлено успішно!');
    }
    
}
