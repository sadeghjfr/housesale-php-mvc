<?php

namespace System\Request\Traits;
trait HasRunValidation{


    protected function errorRedirect(){

        if (!$this->errorExist)
            return $this->request;

        return back();
    }

    private function checkFirstError($name): bool {

        if (!errorExist($name) && !in_array($name, $this->errorVariablesName))
            return true;

        return false;
    }


    private function checkFileExist($name): bool {

        if (isset($this->files[$name]['name'])){

            if (!empty($this->files[$name]['name']))
                return true;

        }

        return false;
    }

    private function setError($name, $errorMessage){

        $this->errorVariablesName[] = $name;
        error($name, $errorMessage);
        $this->errorExist = true;
    }
}