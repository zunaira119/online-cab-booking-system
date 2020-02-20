<?php

namespace App\Http\Controllers\api;

use App\Booking;
use App\Driver;
use App\Http\Controllers\Controller;
use App\Route;
use App\User;
use App\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;

if (!defined('BASE_URL_DRIVER')) define('BASE_URL_DRIVER', URL::to('/') . '/images/driver_images/');

class DriverController extends Controller
{
    public function driver_register(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            array(
                'name' => 'required',
                'email' => 'required|email|max:255|unique:drivers',
                'password' => 'required',
                'phone' => 'nullable|unique:drivers',
                'address' => 'nullable',
                'make' => 'required',
                'model' => 'required',
                'number' => 'required',
                'color' => 'required',
                'no_of_seats' => 'required',
                'available_seats' => 'nullable',
                'reserved_seats' => 'nullable',
                'image' => 'nullable|image|mimes:jpeg,png,jpg',
                'front_photo' => 'required|image|mimes:jpeg,png,jpg',
                'back_photo' => 'required|image|mimes:jpeg,png,jpg',
            ));

        if ($validator->fails()) {
            $error_messages = implode(',', $validator->messages()->all());
            $response_array = array('status' => false, 'error_code' => 101, 'message' => $error_messages);
        } else {
            $request['password'] = bcrypt($request->password);
            DB::beginTransaction();
            try {
                $driver = Driver::create($request->all());
                $driver->vehicle()->create($request->all());
                $image = $request->image;
                $front_photo = $request->front_photo;
                $back_photo = $request->back_photo;
                $destination = 'images/driver_images';
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
                    $driver->image = $filename;
                    $driver->save();
                }
                if ($request->hasFile('front_photo')) {
                    $file = strtolower(
                        pathinfo($front_photo->getClientOriginalName(), PATHINFO_FILENAME)
                        . '-'
                        . uniqid()
                        . '.'
                        . $front_photo->getClientOriginalExtension()
                    );
                    $front_photo->move($destination, $file);
                    str_replace(" ", "-", $file);
                    $driver->front_photo = $file;
                    $driver->save();
                }
                if ($request->hasFile('back_photo')) {
                    $name = strtolower(
                        pathinfo($back_photo->getClientOriginalName(), PATHINFO_FILENAME)
                        . '-'
                        . uniqid()
                        . '.'
                        . $back_photo->getClientOriginalExtension()
                    );
                    $back_photo->move($destination, $name);
                    str_replace(" ", "-", $name);
                    $driver->back_photo = $name;
                    $driver->save();
                }

////                $user = auth()->user();
//                $request['user_id'] = $driver->id;
//                $request['name'] = $user->name;
//                $request['email'] = $user->email;
//                $request['phone'] = $user->phone;
//                $request['image'] = BASE_URL . $user->image;
                $data = 'Bearer' . ' ' . $driver->createToken('MyApp')->accessToken;
                DB::commit();
            } catch (\Exception $exception) {
                DB::rollBack();
                return response()->json([
                    'message' => $exception->getMessage()
                ], 403);
            }
            $response_array = array('status' => true, 'status_code' => 200,
                'data' => $data);
        }
        $response = response()->json($response_array, 200);
        return $response;
    }

    public function driver_login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $driver = Driver::where('email', '=', $email)->first();
        if (!$driver) {
            return response()->json([
                'message' => 'incorrect email',
                'status' => false
            ], 403);
        }
        if (!Hash::check($password, $driver->password)) {
            return response()->json([
                'message' => 'incorrect password',
                'status' => false
            ], 403);
        }
        $request['driver_id'] = $driver->id;
        $request['name'] = $driver->name;
        $request['email'] = $driver->email;
        $request['phone'] = $driver->phone;
        $request['image'] = BASE_URL_DRIVER . $driver->image;
        $request['front_photo'] = BASE_URL_DRIVER . $driver->front_photo;
        $request['back_photo'] = BASE_URL_DRIVER . $driver->back_photo;
        $data = 'Bearer' . ' ' . $driver->createToken('MyApp')->accessToken;
        $response_array = array(
            'status' => true, 'status_code' => 200, 'message' => 'Logged in successfully',
            'driver_id' => $request->driver_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'image' => $request->image,
            'front_photo' => $request->front_photo,
            'back_photo' => $request->back_photo,
            'data' => $data);
        return response()->json([
            'response' => $response_array
        ]);
//
    }
//    public function add_vehicle(Request $request, Driver $driver)
//    {
//        $validator = Validator::make(
//            $request->all(),
//            array(
//                'make' => 'required',
//                'model' => 'required',
//                'number' => 'required',
//                'color' => 'required',
//                'no_of_seats' => 'required',
//            ));
//        if ($validator->fails())
//            return response()->json([
//                'message' => 'validation error',
//                'data' => $validator->errors()
//            ], 422);
//        $driver->vehicle()->create($request->all());
//        return response()->json([
//            'message' => 'vehicle added'
//        ]);
//    }

    function getDistance($latitude2, $longitude2)
    {
        $latitude1 = 31.476671;
        $longitude1 = 74.301437;
        $earth_radius = 6371;

        $dLat = deg2rad($latitude2 - $latitude1);
        $dLon = deg2rad($longitude2 - $longitude1);

        $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * asin(sqrt($a));
        $d = $earth_radius * $c;

        return $d;
    }

    public function start_ride(Request $request, Driver $driver)
    {
        $validator = Validator::make(
            $request->all(),
            array(
                'ending_point' => 'required',
                'starting_point'=>'required',
                'vehicle_id' => 'required',
                's_latitude' => 'required',
                's_longitude' => 'required',
                'e_latitude' => 'required',
                'e_longitude' => 'required',

            ));
        if ($validator->fails())
            return response()->json([
                'message' => 'validation error',
                'data' => $validator->errors()
            ], 422);
        $lat = $request->s_latitude;
        $lng = $request->s_longitude;
        $radius = 1000;
        $distance = $this->getDistance($lat, $lng);
        if (($driver->approved) && ($distance <= $radius)) {
            $driver->rides()->create($request->all());
        } else {
            return response()->json([
                'status' => false,
                'message' => 'you are not allowed to add '
            ]);
        }
        return response()->json([
            'status' => true,
            'message' => 'ride added'
        ]);
    }
    public function bookings(Vehicle $vehicle)
    {
        $bookings=Booking::where('vehicle_id',$vehicle->id)->where('status','pending')->get();
        if ($bookings === [])
            $status=false;
        else
            $status=true;
        return response()->json([
            'status' => $status,
            'bookings' => $bookings
        ]);
    }

}
