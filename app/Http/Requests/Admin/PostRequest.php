<?php

namespace App\Http\Requests\Admin;

use System\Request\Request;

class PostRequest extends Request {

    public function rules(): array {

        if (methodField() == 'put'){

            return [
                'title' => 'required|max:191',
                'body' => 'required',
                'image' => 'file|mimes:jpeg,jpg,png,gif',
                'cat_id' => 'required|exist:categories,id',
                'published_at' => 'required|date',
            ];
        }

        else{

            return [
                'title' => 'required|max:191',
                'body' => 'required',
                'image' => 'required|file|mimes:jpeg,jpg,png,gif',
                'cat_id' => 'required|exist:categories,id',
                'published_at' => 'required|date',
            ];
        }

    }
}
