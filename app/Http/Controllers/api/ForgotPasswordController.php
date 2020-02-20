<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Mail\ForgotPasswordMail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
    public function forgot_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:191'
        ]);

        if ($validator->fails())
            return response()->json([
                'message' => 'Validation Error',
                'data' => $validator->errors()
            ], 422);

        $user = User::where('email', $request->email)->first();
        if (!$user)
            return response()->json([
                'message' => 'Email not Found',
                'status' => false
            ], 403);

        $request['token'] = mt_rand(100000, 999999);
        DB::beginTransaction();
        try {
            if (DB::table('password_resets')->where('user_id', $user->id)->first()) {
                DB::table('password_resets')->where('user_id', $user->id)->update([
                    'token' => $request->token
                ]);
                Mail::send(new ForgotPasswordMail());
                DB::commit();
            } else {
                DB::table('password_resets')->where('user_id', $user->id)->insert([
                    'user_id' => $user->id,
                    'token' => $request->token
                ]);
                Mail::send(new ForgotPasswordMail());
                DB::commit();
            }
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], 403);
        }
        return response()->json([
            'message' => 'Verification Code Sent',
            'status' => true,
            'code' => (string)$request->token
        ]);
    }
    public function confirm_code(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:191',
            'token' => 'required|string|max:191'
        ]);

        if ($validator->fails())
            return response()->json([
                'message' => 'Validation Error',
                'data' => $validator->errors()
            ], 422);

        $user = User::where('email', $request->email)->first();
        if (!$user)
            return response()->json([
                'message' => 'Email not Found',
                'status'=>false
            ], 403);

        if (!DB::table('password_resets')->where('user_id', $user->id)->where('token', $request->token)->first())
            return response()->json([
                'message' => 'Invalid Code or Expired Code',
                'status'=>false
            ], 403);

        return response()->json([
            'message' => 'Valid Code',
            'status'=>true
        ]);
    }
    public function update_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:191',
            'token' => 'required|string|max:191',
            'password' => 'required|string|min:6|max:191'
        ]);

        if ($validator->fails())
            return response()->json([
                'message' => 'Validation Error',
                'data' => $validator->errors()
            ], 422);

        $user = User::where('email', $request->email)->first();
        if (!$user)
            return response()->json([
                'message' => 'Email not Found',
                'status'=>false
            ], 403);

        if (!DB::table('password_resets')->where('user_id', $user->id)->where('token', $request->token)->first()) {
            return response()->json([
                'message' => 'Invalid Code or Expired Code',
                'status'=>false
            ], 403);
        }

        DB::beginTransaction();
        try {
            $user->update(['password' => bcrypt($request->password)]);
            DB::table('password_resets')->where('user_id', $user->id)->where('token', $request->token)->delete();
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json([
                'message' => $exception->getMessage()
            ], 403);
        }

        return response()->json([
            'message' => 'Password Updated',
            'status'=>true
        ]);
    }
}
