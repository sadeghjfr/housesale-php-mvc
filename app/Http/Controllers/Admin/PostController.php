<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Requests\Admin\PostRequest;
use App\Http\Services\ImageUpload;
use App\Post;
use System\Auth\Auth;

class PostController extends AdminController {

    public function index(){

        $posts = Post::all();
        return view('admin/post/index', compact('posts'));
    }

    public function create(){

        $categories = Category::all();
        return view('admin/post/create', compact('categories'));
    }
    public function store(){

        $request = new PostRequest();
        $inputs = $request->all();
        $inputs['user_id'] = Auth::user()->id;
        $inputs['status'] = 0;

        $path = "images/posts/" . date('Y/M/d');
        $name = date('Y_m_d_H_i_s_') . rand(10,99);
        $inputs['image'] = ImageUpload::uploadAndFitImage($request->file('image'), $path, $name, 800, 499);

        Post::create($inputs);
        redirect('admin/post');
    }
    public function edit($id){

        $post = Post::find($id);
        $categories = Category::all();
        return view('admin/post/edit', compact('post', 'categories'));
    }
    public function update($id){

        $request = new PostRequest();
        $inputs = $request->all();
        $inputs['user_id'] = Auth::user()->id;
        $inputs['status'] = 0;
        $inputs['id'] = $id;
        $file = $request->file('image');

        if (!empty($file['tmp_name'])){

            $path = "images/posts/" . date('Y/M/d');
            $name = date('Y_m_d_H_i_s_') . rand(10,99);
            $inputs['image'] = ImageUpload::uploadAndFitImage($request->file('image'), $path, $name, 800, 499);
        }

        Post::update($inputs);
        redirect('admin/post');
    }

    public function status($id){

        $inputs['id'] = $id;
        $post = Post::find($id);

        ($post->status === 1) ? $inputs['status'] = 0 : $inputs['status'] = 1;

        Post::update($inputs);
        back();
    }

    public function destroy($id){

        Post::delete($id);
        back();
    }

}