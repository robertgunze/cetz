<?php 
namespace CEApp\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use GraphAware\Neo4j\Client\ClientBuilder;

class BaseController{

    protected $offset = 0;
    protected $limit = 100;

    function __construct(){
        
    }
}