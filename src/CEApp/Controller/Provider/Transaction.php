<?php 
namespace CEApp\Controller\Provider;

use Silex\Application;
use Silex\Api\ControllerProviderInterface;

class Transaction implements ControllerProviderInterface{
    
    public function connect(Application $app){
        
        $transactions = $app['controllers_factory'];
        
        $transactions->get('/','CEApp\\Controller\\TransactionController::index');
        $transactions->get('/{id}','CEApp\\Controller\\TransactionController::show');
        $transactions->get('/edit/{id}','CEApp\\Controller\\TransactionController::edit');
        $transactions->post('/','CEApp\\Controller\\TransactionController::store');
        $transactions->put('/{id}','CEApp\\Controller\\TransactionController::update');
        $transactions->delete('/{id}','CEApp\\Controller\\TransactionController::destroy');
        
        return $transactions;
        
    }
}