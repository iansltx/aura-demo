<?php

namespace MyProject\API\Service;

class ResponderFactory
{
    protected $map = [];

    public function __construct($map = []) {
        $this->map = $map;
    }

    /**
     * @param string $name
     * @param array $data
     * @return \MyProject\API\Responder\BaseResponder
     */
    public function getInstance($name, $data = []) {
        return call_user_func($this->map[$name], $data);
    }
}
