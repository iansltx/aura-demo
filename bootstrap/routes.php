<?php

use Aura\Router\RouteCollection;

$di->get('router')->attach('API', '/v1', function (RouteCollection $api) {
    $api->attach('Raffle', '/raffles', function (RouteCollection $r) {
        $r->addValues(['controller' => 'Raffle']);

        $r->addPost('Create', '');
        $r->addDelete('Delete', '/{id}');
        $r->addGet('Get', '/{id}');
        $r->addPut('Update', '/{id}');
        $r->addGet('GetMany', '');
    });
});
