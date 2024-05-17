<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Banner;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $banner=Banner::all();
        $about=About::all();
        return view('front.index',compact('banner','about'));
      }
      public function about(){
          return view('front.about');
      }
      public function services(){
          return view('front.service');
      }
      public function contact(){
          return view('front.contact');
      }
      public function price(){
          return view('front.price');
      }
      public function team(){
          return view('front.team');
      }
      public function testimonial(){
          return view('front.testimonial');
      }
      public function appointment(){
          return view('front.appointment');
      }
}
