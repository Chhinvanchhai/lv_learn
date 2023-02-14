<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\ResetPasswordFormRequest;
use App\Mail\EmailDemo;
use App\Mail\EmailSuccess;
use App\Mail\Welcome;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Contracts\Validation\Validator;
// use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function __construct(private AuthService $authService)
    {
    }

    public function login(LoginFormRequest $request)
    {
        return $this->authService->login($request->all());
    }

    public function user()
    {
        // return $this->authService->user();
        $u = User::with(['resources'])->get();
        // $query = (new User())->newQuery();

        // $query->leftJoin('resources', 'resources.user_id', 'users.id');
        // $query->select('users.*', 'url');

        // $u = $query->get();
        return response()->json($u);
    }

    public function logout()
    {
        return $this->authService->logout();
    }

    public function handleForgotPassword(Request $request) {
        $user = User::where('email', '=', $request->email)->get();
            if (count($user) < 1) {
                return response()->json(['email' => trans('User does not exist')]);
            }
            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => Str::random(60),
                'created_at' => Carbon::now()
            ]);
            $tokenData = DB::table('password_resets')
                ->where('email', $request->email)->first();
            if ($this->sendResetEmail($request->email, $tokenData->token)) {
                return  response()->json(['A reset link has been sent to your email address.']);
            } else {
                return  response()->json(['A Network Error occurred. Please try again.']);
            }
    }

    public function sendResetEmail($email, $token)
    {
        $user = DB::table('users')->where('email', $email)->select('name', 'email')->first();
        $link = env('APP_URL') . 'api/password/reset/' . $token . '?email=' . urlencode($user->email);
        try {
            $mailData = [
                'title' => 'Demo Email',
                'url' =>   $link
            ];
            Mail::to($user->email)->send(new EmailDemo($mailData));
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function sendSuccessEmail($email)
    {
        $user = DB::table('users')->where('email', $email)->select('name', 'email')->first();
        try {
            Mail::to($user->email)->send(new EmailSuccess());
            return  response()->json(['email send']);
            return true;
        } catch (\Exception $e) {
            return  response()->json('catch');
            return false;
        }
    }

    public function resetPassword(ResetPasswordFormRequest $request)
    {
        $password = $request->password;
        $tokenData = DB::table('password_resets')
        ->where('token', $request->token)->first();
        if (!$tokenData)  return response()->json(['token is invalid']);
        $user = User::where('email', $tokenData->email)->first();
        if (!$user) return response()->json(['Email not found']);
        $user->password = $password;
        $user->update(); //or $user->save();
        DB::table('password_resets')->where('email', $user->email)
        ->delete();
        if ($this->sendSuccessEmail($tokenData->email)) {
            return response()->json(['Reset Successfully']);
        } else {
            return response()->json(['A Network Error occurred. Please try again.']);
        }
    }
}
