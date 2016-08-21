<?php
require_once __DIR__.'/../vendor/autoload.php';


$app = new \Silex\Application();

//set debug flag to true in dev mode
$app['debug'] = true;


$app->get('/api',function(){
    return '{name:"CE App",version:"1.0.0"}';
});

//registering routes
require_once __DIR__.'/../app/routes.php';

//registering providers 
require_once __DIR__.'/../app/providers.php';

$app->run();

