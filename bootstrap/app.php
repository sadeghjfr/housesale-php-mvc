<?php

session_start();

if(isset($_SESSION['temporary_flash'])) unset($_SESSION['temporary_flash']);
if(isset($_SESSION['temporary_errorFlash'])) unset($_SESSION['temporary_errorFlash']);
if(isset($_SESSION['old'])) unset($_SESSION['temporary_old']);

if(isset($_SESSION['flash']))
{
    $_SESSION['temporary_flash'] = $_SESSION['flash'];
    unset($_SESSION['flash']);
}

if(isset($_SESSION['errorFlash']))
{
    $_SESSION['temporary_errorFlash'] = $_SESSION['errorFlash'];
    unset($_SESSION['errorFlash']);
}

if(isset($_SESSION['old']))
{
    $_SESSION['temporary_old'] = $_SESSION['old'];
    unset($_SESSION['old']);
}

$params = [];
$params = !isset($_GET) ? $params : array_merge($params, $_GET);
$params = !isset($_POST) ? $params : array_merge($params, $_POST);
$_SESSION['old'] = $params;
unset($params);

require_once ("../system/helpers/helper.php");


require_once ("../config/app.php");
require_once ("../config/database.php");


global $routes;
$routes = ['get' => [], 'post' => [], 'put' => [], 'delete' => []];
require_once ("../routes/web.php");
require_once ("../routes/api.php");


$routing = new \System\Router\Routing();
$routing->run();