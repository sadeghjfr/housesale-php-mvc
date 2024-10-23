<?php

namespace System\View\Traits;

trait HasIncludeContent{

    private function checkIncludesContent(){

        while (1){

            $includesNamesArray = $this->findIncludesNames();

            if (!empty($includesNamesArray)){

                foreach ($includesNamesArray as $includeName){

                    $this->initialIncludes($includeName);
                }
            }

            else
                break;
        }
    }

    private function findIncludesNames(){

        $includesNamesArray = [];

        $regex = "/@include+\('([^)]+)'\)/";
        preg_match_all($regex, $this->content, $includesNamesArray, PREG_UNMATCHED_AS_NULL);
        return $includesNamesArray[1] ?? false;
    }

    private function initialIncludes($includeName){

        return
            $this->content =
                str_replace(
                    "@include('$includeName')", $this->viewLoader($includeName), $this->content
                );

    }


}