<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


class RecoveryController extends Controller
{
    public function index($email, $token)
    {
        return view('forgotpassword.recovery', ['email' => $email, 'token' => $token]);
    }

    public function recover(Request $request)
    {
        //Validate input
        $validator = Validator::make($request->all(), [
                'email' => 'required|email|exists:users,email',
                'password' => 'required|confirmed',
                'token' => 'required']
        );

        $password = $request->password;
        // Validate the token
        $tokenData = DB::table('password_resets')
            ->where('token', $request->token)->first();
        // Redirect the user back to the password reset request form if the token is invalid
        if (!$tokenData) return redirect('forgotpassword')->withErrors(['error' => 'Token inválido, tente novamente']);

        $user = User::where('email', $tokenData->email)->first();
        // Redirect the user back if the email is invalid
        if (!$user) return redirect()->back()->withErrors(['email' => 'Email não encontrado']);
        //Hash and update the new password
        $user->password = bcrypt($password);
        $user->update(); //or $user->save();

        //login the user immediately they change password successfully
        Auth::login($user);

        //Delete the token
        DB::table('password_resets')->where('email', $user->email)
            ->delete();

        //Send Email Reset Success Email
        if ($this->sendSuccessEmail($tokenData->email)) {
            return redirect('home');
        } else {
            return redirect()->back()->withErrors(['email' => trans('A Network Error occurred. Please try again.')]);
        }
    }

    private function sendSuccessEmail($email)
    {
        //Retrieve the user from the database
        $user = DB::table('users')->where('email', $email)->select('firstname', 'email')->first();
        //Generate, the password reset link. The token generated is embedded in the link

        try {
            Mail::raw('Sua senha foi alterada com sucesso. Caso não tenha sido você, altere-a imediatamente.', function ($message) use ($user) {
                $message->from('noreply@reica.com');
                $message->subject('Password successfully reset');
                $message->to($user->email);
            });
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }


}
