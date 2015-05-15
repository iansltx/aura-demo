<?php

namespace MyProject\API\Action\Raffle;

use MyProject\API\Action\BaseAction;

class GetAction extends BaseAction
{
    // stub needed to help the dispatcher match route params to method params
    public function __invoke($id = null) {
        return parent::__invoke($id);
    }
}
