<?php 
namespace CEApp\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Silex\Application;

class UserController extends BaseController{
    
    public function __construct(){
        parent::__construct();
    }

    public function index(Request $request, Application $app){
        //show the list of users 
        //print_r($app['db']);die('here');
        $offset = !empty($request->request->get('offset'))?$request->request->get('offset'):$this->offset;
        $limit = !empty($request->request->get('limit'))?$request->request->get('limit'):$this->limit;

        $query = "MATCH (p:User) RETURN ID(p) as id,p.name as name,p.email as email,p.type as type,p.phone as phone SKIP {offset} LIMIT {limit}";
        $result = $app['db']()->run($query,['offset'=>intval($offset),'limit'=>intval($limit)]);
        $records = $result->getRecords();
        $data = [];
        foreach($records as $record){
            $data[] = [
                'id'=>$record->value('id'),
                'name'=>$record->value('name'),
                'email'=>$record->value('email'),
                'type'=>$record->value('type'),
                'phone'=>$record->value('phone')
            ];
        }
        
        //return new JsonResponse($data);
        return $app['twig']->render('users/index.twig',array('users'=>$data));
        
    }
    
    public function show($id,Application $app){
        //show the user #id
        $query = "MATCH (p:User) WHERE ID(p) = {id} RETURN ID(p) as id,p.name as name,p.email as email,p.type as type,p.phone as phone";
        $result = $app['db']()->run($query,['id'=>intval($id)]);
        $record = $result->getRecord();
        if($record){
             return new JsonResponse([
            'id'=>$record->value('id'),
            'name'=>$record->value('name'),
            'email'=>$record->value('email'),
            'type'=>$record->value('type'),
            'phone'=>$record->value('phone')

            ]);
        }
  
        return new JsonResponse([]);
       
        
    }
    
    public function store(Request $request, Application $app){
        //create new user with POST
        $params = $request->request->all();
        $name = $params['name'];
        $email = $params['email'];
        $type = $params['type'];
        $phone = $params['phone'];
        $location = $params['location'];
        
        $query = "CREATE (n:User) SET n.name = {name}, n.type = {type}, n.location = {location}, n.email = {email}, n.phone = {phone} RETURN ID(n)";
        $result = $app['db']()->run($query,$params);
        $id = $result->getRecord()->value("ID(n)");
        
        if($id){

            return new Response("User created");
        }
        
        return new Response("Failed to create user");
    }
    
    
    public function edit($id){
        //show edit form #id
        
    }
    
    public function update($id){
        //update user info with PUT
    }
    
    public function destroy($id){
        //delete user with DELETE
    }
}