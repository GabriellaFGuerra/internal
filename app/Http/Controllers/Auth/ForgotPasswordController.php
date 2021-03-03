<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;


class ForgotPasswordController extends Controller
{
    public function index()
    {
        return view('forgotpassword.index');
    }

    public function getemail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users'
        ]);

        //Create Password Reset Token
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => Str::random(16),
            'created_at' => Carbon::now()
        ]);
//Get the token just created above
        $tokenData = DB::table('password_resets')
            ->where('email', $request->email)->first();

        if ($this->sendResetEmail($request->email, $tokenData->token)) {
            return redirect()->back()->with('status', 'Um link para recuperação de senha foi enviado ao seu email.');
        } else {
            return redirect()->back()->withErrors(['error' => 'Ocorreu um erro, tente novamente.']);
        }
    }

    private function sendResetEmail($email, $token)
    {
        //Retrieve the user from the database
        $user = DB::table('users')->where('email', $email)->select('firstname', 'email')->first();
        //Generate, the password reset link. The token generated is embedded in the link

        try {
            Mail::send('forgotpassword.mail', ['email' => $user->email, 'token' => $token], function ($message) use ($user) {
                $message->from('noreply@reica.com');
                $message->subject('Password reset');
                $message->to($user->email);
            });
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
