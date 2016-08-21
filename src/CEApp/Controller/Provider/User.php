<?php 
namespace CEApp\Controller\Provider;

use Silex\Application;
use Silex\Api\ControllerProviderInterface;

class User implements ControllerProviderInterface{
    
    public function connect(Application $app){
        
        $users = $app['controllers_factory'];
        
        $users->get('/','CEApp\\Controller\\UserController::index');
        $users->get('/{id}','CEApp\\Controller\\UserController::show');
        $users->get('/edit/{id}','CEApp\\Controller\\UserController::edit');
        $users->post('/','CEApp\\Controller\\UserController::store');
        $users->put('/{id}','CEApp\\Controller\\UserController::update');
        $users->delete('/{id}','CEApp\\Controller\\UserController::destroy');
        
        return $users;
        
    }
}