<?php

namespace MyProject\API\Service;

class ModelFactory
{
    protected $map = [];

    public function __construct($map = []) {
        $this->map = $map;
    }

    /**
     * @param string $model_name
     * @param array $data
     * @return \MyProject\API\Model\BaseModel
     */
    public function getInstance($model_name, $data = []) {
        $factory = $this->map[$model_name];
        $model = $factory($data);
        return $model;
    }
}
