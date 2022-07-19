<?php

namespace App\Http\Controllers;

use AmrShawky\LaravelCurrency\Facade\Currency;
use App\Models\Course;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    public function index(Request $request){

        $location = geoip($request->ip)->getLocation();
        if ($location->currency == 'VEF'){
            $location->currency='VES';
        }

        $courses = Course::all()->map(function($course) use ($location){

;
            $course->converted_price = Currency::convert()
                ->from($course->currency_code)
                ->to($location->currency)->amount($course->price)->get();
            return $course;
        });



        return view('courses-public',['location'=>$location,'courses'=>$courses]);
    }
}
