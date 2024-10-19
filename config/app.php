<?php

const APP_TITLE = "For sale houses";
const BASE_URL = "http://localhost";

define("BASE_DIR", realpath(__DIR__ . "/../"));

$tmp = str_replace(BASE_URL , '', explode('?', $_SERVER['REQUEST_URI'])[0]);

$tmp === "/" ? $tmp = "" : $tmp = substr($tmp, 1);

define("CURRENT_ROUTE", $tmp);

global $routes;

$routes = [
    'get'=>"",
    'post'=>"",
    'put'=>"",
    'delete'=>""
];



















