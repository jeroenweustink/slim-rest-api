<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../class-loader.php';

$app = new Slim\Slim();

switch($app->request()->getMethod()) {
    case 'GET':
        $app->get('/:resource(/:id)', function($resource, $id = null) {
            $resource = \App\Resource::load($resource);
            $resource->get($id);
        });
        break;
    case 'POST':
        $app->post('/:resource', function($resource) {
            $resource = \App\Resource::load($resource);
            $resource->post();
        });
        break;
    case 'PUT':
        $app->put('/:resource(/:id)', function($resource, $id = null) {
            $resource = \App\Resource::load($resource);
            $resource->put();
        });
        break;
    case 'DELETE':
        $app->delete('/:resource(/:id)', function($resource, $id = null) {
            $resource = \App\Resource::load($resource);
            $resource->delete($id);
        });
        break;
}

$app->run();