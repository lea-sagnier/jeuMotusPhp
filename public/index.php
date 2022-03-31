<?php

declare(strict_types=1);

use App\Routing\Router;

spl_autoload_register(function($fqcn) {
    $path = str_replace('\\', '/', $fqcn);
    require_once (__DIR__.'/../'.$path.'.php');
});

$eventDispatcher = new Dispatcher();
$eventDispatcher->addListeners();

$router = Router::getFromGlobals();

$eventDispatcher->dispatch($routerEvent = new RouterEvent($router));
$router = $routerEvent->router;

$controller = $router->getController();

$eventDispatcher->dispatch($controllerEvent = new ControllerEvent($controller, $router));
$controller = $controllerEvent->controller;


ob_start();
$controller->render();
$content = ob_get_clean();

$eventDispatcher->dispatch($contentEvent = new ContentEvent($content));
$content = $contentEvent->content;

echo $content;
