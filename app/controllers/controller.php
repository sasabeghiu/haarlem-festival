<?php

class Controller
{

    function displayView($model)
    {
        $directory = substr(get_class($this), 0, -10);
        $view = debug_backtrace()[1]['function'];
        //require __DIR__ . "/../views/$directory/$view.php";
        //require __DIR__ . '/../views/tourguide/index.php';
        require __DIR__ . '/../views/event/index.php';
    }
}
