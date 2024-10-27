<?php

namespace App\Http\Requests\Admin;

use System\Request\Request;

class SlideRequest extends Request
{

    public function rules(): array {

        $image = (methodField() == 'put')
            ? 'file|mimes:jpeg,jpg,png,gif'
            : 'required|file|mimes:jpeg,jpg,png,gif';

        return [
            'title' => 'required|max:191',
            'body' => 'required|max:1000',
            'address' => 'required|max:191',
            'amount' => 'required|max:191',
            'image' => $image,
            'url' => 'required|max:191'
        ];

    }

}
