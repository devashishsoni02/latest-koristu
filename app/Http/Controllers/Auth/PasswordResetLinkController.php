<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     *
     * @return \Illuminate\View\View
     */
    public function create($lang = '')
    {
        if($lang == '')
        {
            $lang = getActiveLanguage();
        }
        \App::setLocale($lang);

        if(module_is_active('GoogleCaptcha') && admin_setting('google_recaptcha_is_on') == 'on' )
        {
            config(['captcha.secret' => admin_setting('google_recaptcha_secret')]);
            config(['captcha.sitekey' => admin_setting('google_recaptcha_key')]);
        }

        return view('auth.forgot-password',compact('lang'));
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        if(module_is_active('GoogleCaptcha') && admin_setting('google_recaptcha_is_on') == 'on' )
        {
            $request->validate([
                'g-recaptcha-response' => 'required|captcha',
            ]);
        }

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.

        try {

            $admin_user = User::where('type','super admin')->first();
            SetConfigEmail(!empty($admin_user->id) ? $admin_user->id : null);

            $status = Password::sendResetLink(
                $request->only('email')
            );

            return $status == Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withInput($request->only('email'))
                    ->withErrors(['email' => __($status)]);
            //code...
        } catch (\Exception $e) {
            //throw $th;
            return redirect()->back()->withErrors(['email' => $e->getMessage()]);
        }

    }
}
