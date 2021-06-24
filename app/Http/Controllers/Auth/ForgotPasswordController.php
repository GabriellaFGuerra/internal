<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
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

        $user = User::where('email', $request->email)->first();

        if ($user->email != $request->email) {
            return redirect()->back()->withErrors(['email' => 'Email não encontrado']);
        }

        //Create Password Reset Token
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => Str::random(16),
            'created_at' => Carbon::now()
        ]);
        //Get the token just created above
        $tokenData = DB::table('password_resets')
            ->where('email', $request->email)->first();

        try {
            $this->sendResetEmail($request->email, $tokenData->token);
            return redirect()->back()->with('status', 'Um link para recuperação de senha foi enviado ao seu email.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    private function sendResetEmail($email, $token)
    {
        //Retrieve the user from the database
        $user = DB::table('users')->where('email', $email)->select('firstname', 'email')->first();
        //Generate, the password reset link. The token generated is embedded in the link

        try {
            Mail::send('forgotpassword.mail', ['email' => $user->email, 'token' => $token], function ($message) use ($user) {
                $message->from('noreply@gruporeica.com.br');
                $message->subject('Recuperação de senha');
                $message->to($user->email);
            });
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
