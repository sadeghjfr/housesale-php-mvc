<?php

namespace App\Http\Controllers;

use App\Ads;
use App\Category;
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

    public function about(){

        return view('app.about');
    }

    public function ads($id){

        $advertise = Ads::find($id);
        $galleries = $advertise->galleries()->get();
        $posts = Post::where('published_at', '<=', date('Y-m-d H:i:s'))->orderBy('created_at', 'desc')->limit(0,4)->get();
        $relatedAds = Ads::where('cat_id', $advertise->cat_id)->where('id', '!=', $id)->orderBy('created_at', 'desc')->limit(0,2)->get();
        $categories = Category::all();

        return view('app.ads', compact('advertise', 'galleries', 'posts', 'relatedAds', 'categories'));
    }

    public function allAds(){

        $ads = Ads::all();
        return view('app.all-ads', compact('ads'));
    }


}