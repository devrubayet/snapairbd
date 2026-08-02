<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use App\Models\ExclusiveOffer;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function index(Request $request){
        $offers = ExclusiveOffer::all();
        $airlines = Airline::all();
        $testimonials = Testimonial::all();
        return view('home', compact('offers','airlines','testimonials'));
    }

    function about(){
        return view('frontend.pages.about');
    }
}
