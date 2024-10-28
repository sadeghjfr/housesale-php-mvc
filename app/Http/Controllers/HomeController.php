<?php

namespace App\Http\Controllers;

use App\Ads;
use App\Post;
use App\Slide;

class HomeController extends Controller {

    public function index(){

        $slides = Slide::all();
        $newestAds = Ads::orderBy('created_at', 'desc')->limit(0,6)->get();
        $bestAds = Ads::orderBy('created_at', 'desc')->orderBy('view', 'desc')->limit(0,4)->get();
        $posts = Post::where('published_at', '<=', date('Y-m-d H:i:s'))->orderBy('created_at', 'desc')->limit(0,4)->get();

        return view('app.index', compact('slides', 'newestAds', 'bestAds', 'posts'));
    }


}