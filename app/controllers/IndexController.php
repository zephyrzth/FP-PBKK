<?php
declare(strict_types=1);

class IndexController extends ControllerBase
{
    public function initialize()
    {
        parent::initialize();

        $this->tag->setTitle('Welcome');
    }

    public function indexAction()
    {
        $this->flash->notice(
            'Mari bantu saudara kita dengan berdonasi.'
        );
    }

}

