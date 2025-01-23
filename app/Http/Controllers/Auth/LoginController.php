<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/home';
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    //custom function added for captcha 21-10-2024
    public function refreshCaptcha()
    {
        return response()->json(['captcha' => captcha_src()]);
    }

    public function showLoginForm()
    {
        return view('siteLogin');
    }

    public function applicantLogin(Request $request)
    {
        $request->validate([
            'hrmsId' => 'required|regex:/^\d{10}$/',
        ], [
            'hrmsId.required' => 'Please enter your HRMS ID',
            'hrmsId.regex' => 'Please enter a valid HRMS ID',
        ]);

        $userInfo = getHRMSUserData($request->hrmsId);

        if (empty($userInfo)) {
            return redirect()
                ->back()
                ->withErrors(['user_not_found' => 'User not found. Please enter a valid HRMS ID']);
        } else {
            $data = [
                'name' => trim($userInfo['hrmsId']),
                'email' => $userInfo['email'] ?? trim($userInfo['hrmsId']) . '@gmail.com',
                'password' => Hash::make($userInfo['hrmsId']),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            User::updateOrCreate(['name' => $request->hrmsId], $data)
                ->assignRole('applicant');

            // Login starts ------
            $email = $data['email'];
            $password = $userInfo['hrmsId'];
            $user = User::where('email', $email)->first();

            if ($user && Hash::check($password, $user->password)) {
                Auth::login($user);
                return redirect()->route('dashboard');
            } else {
                return redirect()
                    ->back()
                    ->withErrors(['user_not_found' => 'User not found. Please enter a valid HRMS ID']);
            }
            // Login ends ------
        }
    }
}
