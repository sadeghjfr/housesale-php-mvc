<?php

namespace App\Http\Controllers\Admin;

use App\Ads;
use App\Category;
use App\Gallery;
use App\Http\Requests\Admin\AdsRequest;
use App\Http\Requests\Admin\GalleryRequest;
use App\Http\Services\ImageUpload;
use System\Auth\Auth;

class AdsController extends AdminController {

    public function index(){

        $ads = Ads::all();
        return view('admin/ads/index', compact('ads'));
    }

    public function create(){

        $categories = Category::all();
        return view('admin/ads/create', compact('categories'));
    }
    public function store(){

        $request = new AdsRequest();
        $inputs = $request->all();
        $inputs['user_id'] = Auth::user()->id;
        $inputs['status'] = 0;
        $inputs['view'] = 0;

        $path = "images/ads/" . date('Y/M/d');
        $name = date('Y_m_d_H_i_s_') . rand(10,99);
        $inputs['image'] = ImageUpload::uploadAndFitImage($request->file('image'), $path, $name, 800, 532);

        Ads::create($inputs);
        redirect('admin/ads');
    }
    public function edit($id){

        $advertise = Ads::find($id);
        $categories = Category::all();
        return view('admin/ads/edit', compact('advertise', 'categories'));
    }
    public function update($id){

        $request = new AdsRequest();
        $inputs = $request->all();
        $inputs['user_id'] = Auth::user()->id;
        $inputs['status'] = 0;
        $inputs['view'] = 0;
        $inputs['id'] = $id;

        $file = $request->file('image');

        if (!empty($file['tmp_name'])){

            $path = "images/ads/" . date('Y/M/d');
            $name = date('Y_m_d_H_i_s_') . rand(10,99);
            $inputs['image'] = ImageUpload::uploadAndFitImage($request->file('image'), $path, $name, 800, 532);
        }

        Ads::update($inputs);
        redirect('admin/ads');
    }

    public function destroy($id){

        Ads::delete($id);
        back();
    }

    public function gallery($id){

        $advertise = Ads::find($id);
        $galleries = Gallery::where('advertise_id', $id)->get();
        return view('admin.ads.gallery', compact('advertise', 'galleries'));
    }

    public function storeGalleryImage($id){

        $request = new GalleryRequest();
        $inputs = [];
        $inputs['advertise_id'] = $id;

        $path = "images/gallery/" . date('Y/M/d');
        $name = date('Y_m_d_H_i_s_') . rand(10,99);
        $inputs['image'] = ImageUpload::uploadAndFitImage($request->file('image'), $path, $name, 730, 400);

        Gallery::create($inputs);
        back();
    }

    public function deleteGalleryImage($gallery_id){

        Gallery::delete($gallery_id);
        back();
    }


}