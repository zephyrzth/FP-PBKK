<?php
declare(strict_types=1);

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
    protected function initialize()
    {
        $this->tag->prependTitle('Donasi Dhana | ');
        $this->view->setTemplateBefore('main');
    }
}
