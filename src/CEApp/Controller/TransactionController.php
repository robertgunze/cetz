<?php 
namespace CEApp\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Silex\Application;

class TransactionController extends BaseController{
    
    public function __construct(){
        parent::__construct();
    }

    public function index(Request $request, Application $app){
        $offset = !empty($request->request->get('offset'))?$request->request->get('offset'):$this->offset;
        $limit = !empty($request->request->get('limit'))?$request->request->get('limit'):$this->limit;

        $query = "";
        $result = $app['db']()->run($query,['offset'=>intval($offset),'limit'=>intval($limit)]);
        $records = $result->getRecords();
        $data = [];
        foreach($records as $record){
            $data[] = [
            ];
        }
        
        return $app['twig']->render('transactions/index.twig',array('transactions'=>$data));
        
    }
    
    public function show($id,Application $app){
        $query = "";
        $result = $app['db']()->run($query,['id'=>intval($id)]);
        $record = $result->getRecord();
        if($record){
             return new JsonResponse([

            ]);
        }
  
        return new JsonResponse([]);
       
        
    }
    
    public function store(Request $request, Application $app){
        //create new user with POST
        $params = $request->request->all();
        
        $query = "";
        $result = $app['db']()->run($query,$params);
        $id = $result->getRecord()->value("ID(n)");
        
        if($id){

            return new Response("Property created");
        }
        
        return new Response("Failed to create property");
    }
    
    
    public function edit($id){
        //show edit form #id
        
    }
    
    public function update($id){
        //update property info with PUT
    }
    
    public function destroy($id){
        //delete property with DELETE
    }
}