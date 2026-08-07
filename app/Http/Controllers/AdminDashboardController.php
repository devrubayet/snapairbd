<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    function index(Request $request){
        $feedbackCount = Testimonial::count();
        return view('admin.dashboard',compact('feedbackCount'));
    }
}
