<?php

use Phalcon\Events\Event;
use Phalcon\Mvc\Micro;
use Phalcon\Mvc\User\Plugin;

class CORSPlugin extends Plugin {

    public function beforeHandleRoute(Event $event, Micro $app) {

        $origin = $app->request->getHeader('ORIGIN') ? $app->request->getHeader('ORIGIN') : '*';

        if (strtoupper($app->request->getMethod()) == 'OPTIONS') {
            $app->response
                ->setHeader('Access-Control-Allow-Origin', $origin)
                ->setHeader('Access-Control-Allow-Methods', 'GET,PUT,POST,DELETE,OPTIONS')
                ->setHeader('Access-Control-Max-Age', '86400')
                ->setHeader('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Range, Content-Disposition, Content-Type, Authorization')
                ->setHeader('Access-Control-Allow-Credentials', 'true');

            $app->response->setStatusCode(200, 'OK')->send();

            exit;
        }

        $app->response
            ->setHeader('Access-Control-Allow-Origin', $origin)
            ->setHeader('Access-Control-Allow-Methods', 'GET,PUT,POST,DELETE,OPTIONS')
            ->setHeader('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Range, Content-Disposition, Content-Type, Authorization')
            ->setHeader('Access-Control-Allow-Credentials', 'true');
    }
}
