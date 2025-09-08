<?php

namespace Drupal\hello_world\Controller;

use Drupal\Core\Controller\ControllerBase;

class HelloWorldController extends ControllerBase{
    public function content(){
        $msg = 'Hello world';
        return[
            '#markup' => $this -> t($msg),
        ];
    }
}