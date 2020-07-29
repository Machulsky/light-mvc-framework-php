<?php

/**
 * Created by PhpStorm.
 * User: Пётр
 * Date: 27.03.2019
 * Time: 14:41
 */
class View
{
    public function __construct($service)
    {
        $this->service = $service;
        $this->theme = 'default';
        $this->path = THEMES_DIR.$this->theme.'/';

    }

    public function render($template, $vars = [])
    {
        $this->service->render($this->path.$template, $vars);
    }

    public function partial($template, $vars = [])
    {
        extract($vars);
        require $this->path.$template;

    }

}