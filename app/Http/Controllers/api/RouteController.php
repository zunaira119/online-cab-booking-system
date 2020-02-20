<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Route;
use App\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RouteController extends Controller
{
    public function add_route(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'starting_point' => 'required',
            'ending_point' => 'required',
            's_latitude' => 'required',
            's_longitude' => 'required',
            'e_latitude'=>'required',
            'e_longitude'=>'required',
        ]);
        if ($validator->fails())
            return response()->json([
                'message' => 'validation error'
            ], 422);
        return response()->json([
            'message' => 'route added'
        ]);
    }
    function distance($lat1, $lon1, $lat2, $lon2)
    {
        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
            return 0;
        } else {
            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            return ($miles * 1.609344);
//            $unit = strtoupper($unit);
//
//            if ($unit == "K") {
//                return ($miles * 1.609344);
//            } else if ($unit == "N") {
//                return ($miles * 0.8684);
//            } else {
//                return $miles;
//            }
        }
    }

//    public function available_rides(Request $request)
//    {
//        $validator = Validator::make($request->all(), [
//            'pickup_point' => 'required|string|max:191',
//            'drop_off_point' => 'required',
//            's_latitude' => 'required',
//            's_longitude' => 'required',
//            'e_latitude' => 'required',
//            'e_longitude' => 'required',
//        ]);
//        if ($validator->fails())
//            return response()->json([
//                'message' => 'validation error'
//            ], 422);
//        $routes = Route::where('starting_point', $request->pickup_point)->orwhere('ending_point', $request->drop_off_point)->get();
//        $s_lat = $request->s_latitude;
//        $s_long = $request->s_longitude;
//        $d_lat = $request->e_latitude;
//        $d_long = $request->e_longitude;
//        foreach ($routes as $index => $route) {
//            $c_lat = $route->s_latitude;
//            $c_long = $route->s_longitude;
//            $e_lat = $route->e_latitude;
//            $e_long = $route->e_longitude;
//            $r_distance = $this->distance($c_lat, $c_long, $e_lat, $e_long);
//            $u_distance = $this->distance($s_lat, $s_long, $d_lat, $d_long);
//            if ($u_distance >= $r_distance) {
//                $available = Vehicle::Wherehas('routes', function ($query) use ($route, $request) {
//                    $query->where('route_id', $route->id);
//                })->get();
//                return response()->json([
//                    'available' => $available
//                ]);
//            } else
//                return response()->json([
//                    'message' => 'no rides available'
//                ]);
//        }
//
////        $available = Vehicle::WhereHas('route', function ($query) use ($request) {
////            $query->whereBetween('created_at', array($fromDate->toDateTimeString(), $toDate->toDateTimeString()) )->get();
////        })->get();
//
////        return response()->json([
////            'available' => $available
////        ]);
//    }

}
