<?php
namespace Controller;

abstract class BaseController
{
    protected function render($render)
    {
        print_r(json_encode($render));
        exit();
    }
}
