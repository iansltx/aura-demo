<?php

$di->params['MyProject\API\Action\BaseAction'] = [
    'request' => $di->lazyGet('request'),
    'models' => $di->lazyGet('models'),
    'queries' => $di->lazyGet('queries'),
    'responders' => $di->lazyGet('responders')
];

$di->params['MyProject\API\Responder\BaseResponder'] = [
    'accept' => $di->lazyGet('accept'),
    'response' => $di->lazyGet('response')
];

$di->params['MyProject\API\Service\ModelFactory'] = [
    'map' => [
        'Raffle' => $di->newFactory('MyProject\API\Model\Raffle'),
        'User' => $di->newFactory('MyProject\API\Model\User')
    ]
];
$di->set('models', $di->lazyNew('MyProject\API\Service\ModelFactory'));

$di->params['MyProject\API\Service\ResponderFactory'] = [
    'map' => [
        'Base' => $di->newFactory('MyProject\API\Responder\BaseResponder')
    ]
];
$di->set('responders', $di->lazyNew('MyProject\API\Service\ResponderFactory'));

// not implemented!
$di->set('queries', function() {return [];});
