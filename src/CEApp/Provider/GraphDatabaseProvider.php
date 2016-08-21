<?php

namespace CEApp\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Silex\Application;
use Silex\Api\BootableProviderInterface;
use GraphAware\Neo4j\Client\ClientBuilder;

class GraphDatabaseProvider implements ServiceProviderInterface, BootableProviderInterface
{
	public function register(Container $app){

        $app['db'] = $app->protect(function() use ($app) {
        	return ClientBuilder::create()
            ->addConnection('default', 'http://neo4j:drobyg3@localhost:7474') // Example for HTTP connection configuration (port is optional)
            ->addConnection('bolt', 'bolt://neo4j:drobyg3@localhost:7687') // Example for BOLT connection configuration (port is optional)
            ->build();
        });
	}

	public function boot(Application $app){


	}

} 