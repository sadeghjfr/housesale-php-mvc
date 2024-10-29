<?php

namespace App\Http\Controllers;

use App\Ads;
use App\Category;
use App\Comment;
use App\Http\Requests\UserCommentRequest;
use App\Post;
use App\Slide;
use System\Auth\Auth;

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

    public function allPosts(){

        $posts = Post::all();
        return view('app.all-posts', compact('posts'));
    }

    public function post($id) {

        $post = Post::find($id);
        $posts = Post::where('published_at', '<=', date('Y-m-d H:i:s'))->orderBy('created_at', 'desc')->limit(0,4)->get();
        $categories = Category::all();
        $comments = Comment::where('approved', 1)->whereNull('parent_id')->where('post_id', $id)->get();
        return view('app.post', compact('posts', 'post','categories','comments'));

    }

    public function comment($post_id) {

        $request = new UserCommentRequest();
        $inputs = $request->all();
        $inputs['post_id'] = $post_id;
        $inputs['approved'] = 0;
        $inputs['status'] = 0;
        $inputs['user_id'] = Auth::user()->id;
        Comment::create($inputs);
        back();
    }

    public function category($id)
    {
        $category = Category::find($id);
        $ads = $category->ads()->get();
        $posts = $category->posts()->get();
        return view('app.category', compact('posts', 'category', 'ads'));
    }

}