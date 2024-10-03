<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected $redirectTo = RouteServiceProvider::DASHBOARD;

    // Override the sendResetLinkEmail method to use custom notification class
    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        // Generate password reset token and send reset link
        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );

        // Check the response and return appropriate response
        return $response == Password::RESET_LINK_SENT
                    ? $this->sendResetLinkResponse($request, $response)
                    : $this->sendResetLinkFailedResponse($request, $response);
    }

    // Override the broker method to use the correct broker instance
    public function broker()
    {
        return Password::broker('users'); // Change 'users' to match your password broker name
    }
}
