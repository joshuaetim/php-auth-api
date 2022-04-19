<?php
declare(strict_types=1);

use League\Route\Http\Exception\NotFoundException;

require_once '../vendor/autoload.php';

define('BASEPATH', dirname(__DIR__));

$dotenv = Dotenv\Dotenv::createImmutable(BASEPATH);
$dotenv->load();

session_start();

require_once '../src/helpers.php';

$request = Laminas\Diactoros\ServerRequestFactory::fromGlobals();

$router = new League\Route\Router;

$router->get('/', [App\Controllers\PageController::class, 'home']);

$router->get('/test', function(){
    return textResponse($_ENV['APP_ENV']);
});

$router->middleware(new \App\Middleware\CsrfMiddleware);

try{
    $response = $router->dispatch($request);

    $emitter = new Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
    $emitter->emit($response);
} catch(NotFoundException $exception) {
    header('Location: /'); // todo: make a 404 page
}

// echo PageController::home();