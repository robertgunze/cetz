<?php

$app->mount("/users", new \CEApp\Controller\Provider\User());
$app->mount("/transactions", new \CEApp\Controller\Provider\Transaction());
