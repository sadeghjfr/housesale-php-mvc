<?php

namespace App\Http\Services;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageUpload{

    public static function uploadAndFitImage($file, $path, $name, $width, $height){

        $path = trim($path, '\/') . '/';
        $name = trim($name, '\/') . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);

        if (!is_dir($path))
            if (!mkdir($path, 0777, true))
                die("Image resize: Failed to create directory");

        is_writable($path);

        $manager = new ImageManager(new Driver());
        $image = $manager->read($file['tmp_name']);
        $image->resize($width, $height);
        $image->save($path.$name);

        return '/' . $path . $name;
    }
}