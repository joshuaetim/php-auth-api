<?php
declare(strict_types=1);

namespace App\Controllers;

use Predis\Client;
use Laminas\Diactoros\Response;
use RedisApp\Handlers\PostHandler;
use RedisApp\Handlers\ViewHandler;
use RedisApp\Handlers\RequestHandler;
use Psr\Http\Message\ServerRequestInterface;

class PageController 
{
    protected $client;

    public function __construct()
    {
        // $this->client = redis();
    }
    
    public function home(ServerRequestInterface $request) : Response
    {
        $data = ['title' => 'Home'];

        return view('index.html', $data);
    }
}