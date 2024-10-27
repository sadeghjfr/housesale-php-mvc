<?php

namespace App\Http\Controllers\Admin;

use App\Ads;
use App\Category;
use App\Gallery;
use App\Http\Requests\Admin\AdsRequest;
use App\Http\Requests\Admin\GalleryRequest;
use App\Http\Requests\Admin\SlideRequest;
use App\Http\Services\ImageUpload;
use App\Slide;
use System\Auth\Auth;

class SlideController extends AdminController {

    public function index(){

        $sliders = Slide::all();
        return view('admin/slide/index', compact('sliders'));
    }

    public function create(){

        return view('admin/slide/create');
    }
    public function store(){

        $request = new SlideRequest();
        $inputs = $request->all();

        $path = "images/sliders/" . date('Y/M/d');
        $name = date('Y_m_d_H_i_s_') . rand(10,99);
        $inputs['image'] = ImageUpload::uploadAndFitImage($request->file('image'), $path, $name, 1500, 904);

        Slide::create($inputs);
        redirect('admin/slide');
    }
    public function edit($id){

        $slide = Slide::find($id);
        return view('admin.slide.edit', compact('slide'));
    }
    public function update($id){

        $request = new SlideRequest();
        $inputs = $request->all();
        $inputs['id'] = $id;
        $file = $request->file('image');

        if (!empty($file['tmp_name'])){

            $path = "images/sliders/" . date('Y/M/d');
            $name = date('Y_m_d_H_i_s_') . rand(10,99);
            $inputs['image'] = ImageUpload::uploadAndFitImage($request->file('image'), $path, $name, 1500, 904);
        }

        Slide::update($inputs);
        redirect('admin/slide');
    }

    public function destroy($id){

        Slide::delete($id);
        back();
    }

}