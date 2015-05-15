<?php

use Aura\Web\WebFactory;
use Aura\Accept\AcceptFactory;

function cleanURL($request_uri) {
    $path = rtrim(parse_url($request_uri, PHP_URL_PATH), '/');
    if (strpos($path, '.') === false) {
        return $path;
    }
    return substr($path, 0, strrpos($path, '.'));
}

require __DIR__ . '/../vendor/autoload.php';

$di = new \Aura\Di\Container(new \Aura\Di\Factory);
$di->set('router', (new \Aura\Router\RouterFactory)->newInstance());

require __DIR__ . '/../bootstrap/routes.php';

$webFactory = new WebFactory($GLOBALS);
$di->set('request', function() use ($webFactory) {return $webFactory->newRequest();});
$di->set('response', function() use ($webFactory) {return $webFactory->newResponse();});
$di->set('accept', (new AcceptFactory($_SERVER))->newInstance());

require __DIR__ . '/../bootstrap/services.php';

$route = $di->get('router')->match(cleanURL($_SERVER['REQUEST_URI']), $_SERVER);

if (!$route) {
    $response = $di->get('response');
    $response->content->set('{"message": "No Route"}');
    $response->content->setType('application/vnd.error+json');
    $response->status->setCode(400);
} else {
    $dispatcher = new \Aura\Dispatcher\Dispatcher;
    $dispatcher->setObjectParam('action');
    $controller = array_key_exists('controller', $route->params) ? ($route->params['controller'] . '\\') : '';
    $actionParts = explode('.', $route->params['action']);
    $actionName = 'MyProject\\API\\Action\\' . $controller . end($actionParts) . 'Action';
    $dispatcher->setObject('matched', $di->newInstance($actionName));
    $response = $dispatcher(['action' => 'matched'] + $route->params);
}

header($response->status->get(), true, $response->status->getCode());

foreach ($response->headers->get() as $label => $value) {
    header("{$label}: {$value}");
}

echo $response->content->get();
