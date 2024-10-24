<?php

namespace System\Application;

class Application{

    public function __construct(){

        $this->loadProviders();
        $this->loadHelpers();
        $this->registerRoutes();
        $this->routing();
    }

    private function loadProviders(){

        $appConfigs = require dirname(__DIR__, 2) . "/config/app.php";
        $providers = $appConfigs['providers'];

        foreach ($providers as $provider){

            $providerObj = new $provider();
            $providerObj->boot();
        }
    }

    private function loadHelpers(){

        require_once (dirname(__DIR__) . "/helpers/helpers.php");

        if (file_exists(dirname(__DIR__, 2) . "/app/Http/Helpers.php"))
            require_once (dirname(__DIR__, 2) . "/app/Http/Helpers.php");
    }

    private function registerRoutes(){

        global $routes;
        $routes = ['get' => [], 'post' => [], 'put' => [], 'delete' => []];

        require_once (dirname(__DIR__, 2) . "/routes/web.php");
        require_once (dirname(__DIR__, 2) . "/routes/api.php");
    }

    private function routing(){

        $routing = new \System\Router\Routing();
        $routing->run();
    }

}