<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Ride;
use App\Route;
use App\User;
use App\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    public function available_seats(Vehicle $vehicle)
    {
        if ($vehicle->no_of_seats === $vehicle->reserved_seats)
        {
            return response()->json([
                'message' => 'Fully booked',
                'status'=>false
            ]);
        }
            $available= $vehicle->no_of_seats - $vehicle->reserved_seats;

        return response()->json([
            'available' => $available,
            'status'=>true
        ]);
    }
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
    public function available_rides(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            array(
                'ending_point' => 'required',
                'e_latitude'=>'required',
                'e_longitude'=>'required',
                'c_latitude' => 'required',
                'c_longitude' => 'required'
            ));
        if ($validator->fails())
            return response()->json([
                'message' => 'validation error',
                'data' => $validator->errors()
            ], 422);
        $lat = $request->c_latitude;
        $lng = $request->c_longitude;
        $latitude = $request->e_latitude;
        $longitude = $request->e_longitude;
        $radius = 1000;
        $distance = $this->getDistance($lat, $lng);
        if ($distance<=$radius)
        {
            $available = DB::table('rides')
                ->select('rides.*', DB::raw("6371 * acos(cos(radians(" . $latitude . "))
     * cos(radians(e_latitude))
     * cos(radians(e_longitude) - radians(" . $longitude . "))
     + sin(radians(" . $latitude . "))
     * sin(radians(rides.e_latitude))) AS distance"))
                ->having('distance', '<=', $radius)
                ->get();
            $status=true;
        }
        else
        {
            $status=false;
        }
        return response()->json([
            'status'=>$status,
            'available' => $available
        ]);
    }
    public function book_ride(Request $request,Vehicle $vehicle,User $user)
    {
        $validator = Validator::make($request->all(), [
//            'vehicle_id'=>'required',
            'drop_off_point'=>'required',
        ]);
        if ($validator->fails())
            return response()->json([
                'message' => 'validation error'
            ], 422);
//        $user=auth()->user();
        $request['vehicle_id']=$vehicle->id;
        $user->bookings()->create($request->all());
//        $query = DB::table($vehicle)
//            ->where('id',$vehicle->id)->get();
//        $query=Vehicle::where('id',$vehicle->id)->increment('reserved_seats',1)->decrement('available_seats',1);
//        dd($query);
        $vehicle->increment('reserved_seats');
        $vehicle->decrement('available_seats');

//        $query->increment('reserved_seats');
//        $query->decrement('available_seats');

//        Vehicle::where('id',$vehicle->id)->update(['available_seats' => -1],['reserved_seats'=> +1]);
        return response()->json([
            'status' => true
        ]);
    }
}
