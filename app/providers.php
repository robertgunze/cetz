<?php 

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../resources/views',
));

$app->register(new CEApp\Provider\GraphDatabaseProvider());
