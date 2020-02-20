<?php

namespace App\Http\Controllers\api;

use App\Driver;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

if (!defined('BASE_URL')) define('BASE_URL', URL::to('/') . '/images/profile_images/');

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            array(
                'name' => 'required',
                'email' => 'required|email|max:255|unique:users',
//                'password' => 'required',
                'phone'=>'nullable|unique:users',
                'address' => 'nullable',
                'uni_card_number'=>'required|unique:users',
                'image' => 'nullable|image|mimes:jpeg,png,jpg',
                'type' => 'nullable|in:user,admin',
            ));

        if ($validator->fails()) {
            $error_messages = implode(',', $validator->messages()->all());
            $response_array = array('status' => false, 'error_code' => 101, 'message' => $error_messages);
        } else {
//            $request['password'] = bcrypt($request->password);
            DB::beginTransaction();
            try {
                $user = User::create($request->all());
//                if ($user->type === 'driver') {
//                    Driver::create($request->all());
                $image = $request->image;
//                $front_photo = $request->front_photo;
//                $back_photo = $request->back_photo;
                $destination = 'images/profile_images';
                if ($request->hasFile('image')) {
                    $filename = strtolower(
                        pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)
                        . '-'
                        . uniqid()
                        . '.'
                        . $image->getClientOriginalExtension()
                    );
                    $image->move($destination, $filename);
                    str_replace(" ", "-", $filename);
                    $user->image = $filename;
                    $user->save();
                }
//                if ($request->hasFile('front_photo')) {
//                    $file = strtolower(
//                        pathinfo($front_photo->getClientOriginalName(), PATHINFO_FILENAME)
//                        . '-'
//                        . uniqid()
//                        . '.'
//                        . $front_photo->getClientOriginalExtension()
//                    );
//                    $front_photo->move($destination, $file);
//                    str_replace(" ", "-", $file);
//                    $user->front_photo = $file;
//                    $user->save();
//                }
//                if ($request->hasFile('back_photo')) {
//                    $name = strtolower(
//                        pathinfo($back_photo->getClientOriginalName(), PATHINFO_FILENAME)
//                        . '-'
//                        . uniqid()
//                        . '.'
//                        . $back_photo->getClientOriginalExtension()
//                    );
//                    $back_photo->move($destination, $name);
//                    str_replace(" ", "-", $name);
//                    $user->back_photo = $name;
//                    $user->save();
//                }

//                $user = auth()->user();
                $request['user_id'] = $user->id;
                $request['name'] = $user->name;
                $request['email'] = $user->email;
                $request['phone'] = $user->phone;
                $request->image = BASE_URL.$user->image;
                $data = 'Bearer' . ' ' . $user->createToken('MyApp')->accessToken;
                DB::commit();
            } catch (\Exception $exception) {
                DB::rollBack();
                return response()->json([
                    'message' => $exception->getMessage()
                ], 403);
            }
//            dd(BASE_URL.$user->image);
            $response_array = array('status' => true, 'status_code' => 200, 'user_id' => $request->user_id,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,'image' => $request->image,
               'data' => $data);
        }
        $response = response()->json($response_array, 200);
        return $response;
    }
    public function login(Request $request)
    {
        $validator = Validator::make(
            $request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            $error_messages = implode(',', $validator->messages()->$request->all());
            $response_array = array('status' => false, 'error_code' => 101, 'message' => $error_messages);
        } else {
            $user = User::where(function ($query) use ($request) {
                $query->where('email', $request->email)->first();
            })->first();
            if (!$user)
                return response()->json([
                    'message' => 'incorrect email',
                    'status' => false
                ], 403);

            if (!auth()->loginUsingId((password_verify($request->password, $user->password)) ? $user->id : 0))
                return response()->json([
                    'message' => 'incorrect password',
                    'status' => false
                ], 403);
            $user = auth()->user();
            $request['user_id'] = $user->id;
            $request['name'] = $user->name;
            $request['email'] = $user->email;
            $request['phone'] = $user->phone;
            $request['image'] = BASE_URL . $user->image;
            $request['front_photo'] = BASE_URL . $user->front_photo;
            $request['back_photo'] = BASE_URL . $user->back_photo;
            $data = 'Bearer' . ' ' . $user->createToken('MyApp')->accessToken;
            $response_array = array('user_id' => $request->user_id,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'image' => $request->image,
                'front_photo' => $request->front_photo,
                'back_photo' => $request->back_photo,
                'status' => true, 'status_code' => 200, 'message' => 'Logged in successfully',
                'data' => $data);
        }
        $response = response()->json($response_array, 200);
        return $response;
    }
    public function check_user(Request $request)
    {
        $validator = Validator::make(
            $request->all(), [
            'firebase_id' => 'required'
        ]);
        if ($validator->fails())
            return response()->json([
                'message' => 'validation error',
                'status'=>false
            ], 422);
        $user = User::where(function ($query) use ( $request) {
            $query->where('firebase_id', $request->firebase_id)->first();
        })->first();
        if ($user) {
            $data = 'Bearer' . ' ' . $user->createToken('MyApp')->accessToken;
            $user->image=BASE_URL.$user->image;
            return response()->json([
                'status' => true,
                'user' => $user,
                'data' => $data
            ]);
        }
        if (!$user)
            return response()->json([
                'status'=>false,
            ]);

//        if (User::find($request->firebase_id) === null) {
//            return response()->json([
//                'status' => false
//            ]);
//        } else {
//            $user = User::find($request->firebase_id);
//            return response()->json([
//                'status' => true,
//                'user' => $user
//            ]);
//        }
//            return response()->json([
//                'status'=>$status
//            ], 403);
    }
}
