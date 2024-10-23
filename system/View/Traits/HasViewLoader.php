<?php

namespace System\View\Traits;

trait HasViewLoader{

    private $viewNameArray;

    private function viewLoader($dir){

        $dir = trim($dir, " .");
        $dir = str_replace(".", "/", $dir);
        $file = dirname(__DIR__, 3) . "/resources/view/$dir.blade.php";

        if (file_exists($file)){

            $this->registerView($dir);
            return file_get_contents($file);
        }

        else
            throw new \Exception("View not found!");
    }

    private function registerView($view){

        $this->viewNameArray[] = $view;
    }
}