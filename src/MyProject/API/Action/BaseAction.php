<?php

namespace MyProject\API\Action;

use Aura\Web\Request;
use MyProject\API\Service\ModelFactory;
use MyProject\API\Service\ResponderFactory;

class BaseAction
{
    protected $request;
    protected $models;
    protected $queries;
    protected $responders;

    public function __construct(Request $request, ModelFactory $models, $queries, ResponderFactory $responders) {
        $this->request = $request;
        $this->models = $models;
        $this->queries = $queries;
        $this->responders = $responders;
    }

    public function __invoke() {
        return $this->responders->getInstance('Base', [
            'action_class' => get_called_class(),
            'action_params' => func_get_args()
        ]);
    }
}
