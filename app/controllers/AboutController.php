<?php
declare(strict_types=1);

class AboutController extends ControllerBase
{
    public function initialize()
    {
        parent::initialize();

        $this->tag->setTitle('Halaman About');
    }

    public function indexAction()
    {
        
    }

}