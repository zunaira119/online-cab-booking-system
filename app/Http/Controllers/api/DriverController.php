<?php

namespace App\Http\Controllers\api;

use App\Booking;
use App\Driver;
use App\Http\Controllers\Controller;
use App\Route;
use App\User;
use App\Ride;
use App\Vehicle;
use App\UserBookingHistory;
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
                'message' => 'Email Dose Not Exist!',
                'status' => false
            ], 403);
        }
        if (!Hash::check($password, $driver->password)) {
            return response()->json([
                'message' => 'Incorrect Password',
                'status' => false
            ], 403);
        }
        $request['driver_id'] = $driver->id;
        $request['name'] = $driver->name;
        $request['email'] = $driver->email;
        $request['phone'] = $driver->phone;
        $request['approved'] = $driver->approved;
        $request['vehicle_id'] = $driver->vehicle->id;
        $request['image'] = BASE_URL_DRIVER . $driver->image;
        $request['front_photo'] = BASE_URL_DRIVER . $driver->front_photo;
        $request['back_photo'] = BASE_URL_DRIVER . $driver->back_photo;
        $data = 'Bearer' . ' ' . $driver->createToken('MyApp')->accessToken;
        $response_array = array(
            'driver_id' => $request->driver_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'approved' => $request->approved,
            'vehicle_id' => $driver->vehicle->id,
            'image' => $request->image,
            'data' => $data);
        return response()->json([
            'status' => true, 'status_code' => 200, 'message' => 'Logged in successfully',
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
            $driver->rides()->create([
            'vehicle_id'=>$request->vehicle_id,
            'ending_point'=>$request->ending_point,
            'starting_point'=>'University Area',
            's_latitude'=>$request->s_latitude,
            's_longitude'=>$request->s_longitude,
            'e_latitude'=>$request->e_latitude,
            'e_longitude'=>$request->e_longitude,
            ]);
              $status=Ride::where('driver_id',$driver->id)->update(['status' => 'online']);

              return response()->json([
                'status' => true,
                'message' => 'Ride Added & You Are Online Now!',
            ]);
           
        } else {
            return response()->json([
                'status' => false,
                'message' => 'You Are Not Allowed To Add '
            ]);
        }
        
    }

    public function setDriverOffline(Driver $driver)
    {
        $status=Ride::where('driver_id',$driver->id)->first();
        $resetVehicle=Vehicle::where('driver_id',$driver->id)->first();
        $resetVehicle->update(['reserved_seats' => null , 'available_seats'=>null]);
        $status->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'You Are Offline Now!',
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

    public function driver_request_approvel(Request $request)
    {
        $validator = Validator::make(
        $request->all(),
            array(
                'status' => 'required',
                'user_id' => 'required',
                'vehicle_id' => 'required',
                'drop_off_point'=>'required',
                'e_latitude'=>'required',
                'e_longitude'=>'required',
            ));

        $query=Vehicle::where('id',$request->vehicle_id)->first();
            if($request->status=='approved'){
        $status=Booking::where([
            ['vehicle_id', '=', $request->vehicle_id],
            ['user_id', '=', $request->user_id]
        ])->update(['status' => $request->status]);
        if($query->reserved_seats!=$query->no_of_seats){
            $up_available_seats=$query->no_of_seats - $query->reserved_seats-1;
            $query->update(['reserved_seats' => $query->reserved_seats+1 , 'available_seats'=>$up_available_seats]);
        }
        elseif($query->reserved_seats!=$query->no_of_seats){
          return response()->json([
            'status' => 'False',
            ]);
        }
        
        if($status){
            return response()->json([
                'status' => true,
                'message'=>'Request Approved'
            ]);
        }
            
    }
    elseif($request->status=='pickup'){
       $status=Booking::where([
            ['vehicle_id', '=', $request->vehicle_id],
            ['user_id', '=', $request->user_id]
        ])->update(['status' => $request->status]);
            return response()->json([
                'status' =>  'True',
            ]);
        } 
        
        elseif($request->status=='completed'){
            $status=Booking::where([
                 ['vehicle_id', '=', $request->vehicle_id],
                 ['user_id', '=', $request->user_id]
                 ])->first();
              
             //Save History
              $history = new UserBookingHistory();
              $history->vehicle_id = $request->vehicle_id;
              $history->user_id = $request->user_id;
              $history->status = $request->status;
              $history->drop_off_point = $request->drop_off_point;
              $history->e_latitude = $request->e_latitude;
              $history->e_longitude = $request->e_longitude;
              $history->save();
            $status->delete();
                 return response()->json([
                     'status' =>  true,
                 ]);
             }
           elseif($request->status=='canceled'){
        $status = Booking::where([
            ['vehicle_id', $request->vehicle_id],
            ['user_id',  $request->user_id]
        ])->first();
        $up_available_seats=$query->reserved_seats+1;
         $query->update(['reserved_seats' => $query->reserved_seats-1 , 'available_seats'=>$up_available_seats]);
        $status->delete();
            return response()->json([
                'status' =>  true,
            ]);
        } 
        
    }

    //Accepted Rides
    public function accepted_rides(Vehicle $vehicle)
    {
        $acceptedRides=Booking::with('user')
        ->where([
            ['vehicle_id', $vehicle->id],
            ['status','approved'],
        ])->orWhere('status','pickup')->get();

        return response()->json([
           'data' => $acceptedRides
        ]);
    }

}
