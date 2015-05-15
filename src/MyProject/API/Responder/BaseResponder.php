<?php

namespace MyProject\API\Responder;

use Aura\Accept\Accept;
use Aura\Web\Response;

class BaseResponder
{
    protected $accept;
    protected $response;
    protected $data = [];

    public function __construct($data = [], Accept $accept, Response $response) {
        $this->data = $data;
        $this->accept = $accept;
        $this->response = $response;
    }

    public function __invoke() {
        $this->response->content->setType('application/json');
        $this->response->content->set(json_encode([
            'responder_class' => get_called_class(),
            'data' => $this->data
        ], JSON_PRETTY_PRINT));

        return $this->response;
    }
}
