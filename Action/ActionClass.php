<?php

namespace Zbara\Framework\Action;

class ActionClass
{
    private $system;
    private $folder;
    private $method;
    public $controller;


    /**
     * Action constructor.
     * @param $system
     */
    public function __construct($system)
    {
        $this->system = $system;
    }


    public function make($action): ActionClass
    {
        $this->folder = null;
        $this->controller = null;
        $this->method = null;

        $action = preg_replace("/[^\w\d\s\/]/", '', $action);
        $parts = explode('/', $action);
        $parts = array_filter($parts);

        foreach ($parts as $item) {
            $fullpath = include_dir . '/Method' . $this->folder . '/' . $item;
            if (is_dir($fullpath)) {
                $this->folder .= '/' . $item;
                array_shift($parts);
                continue;
            } elseif (is_file($fullpath . '.php')) {
                $this->controller = $item;
                array_shift($parts);
                break;
            } else break;
        }
        if (empty($this->folder)) {
            $this->folder = 'main';
        }
        if (empty($this->controller)) {
            $this->controller = 'index';
        }
        if ($c = array_shift($parts)) {
            $this->method = $c;
        } else {
            $this->method = 'index';
        }

        $controllerFile = include_dir . '/Method' . $this->folder . '/' . $this->controller . '.php';

        return $this;
    }

    /**
     * @return array|mixed
     */
    public function go()
    {

        $controllerFile = include_dir . '/Method' . $this->folder . '/' . $this->controller . '.php';
        $controllerClass = sprintf('\%s\%s\%s\%s', 'App', 'Method', trim($this->folder, '/'), $this->controller);







        if (is_readable($controllerFile)) {
            $controller = new $controllerClass($this->system);

            if (is_callable(array($controller, $this->method))) {
                $this->method = $this->method;
            } else {
                $this->method = 'index';
            }
            return call_user_func_array(array($controller, $this->method), [$this->system->request, $this->system->Connection, $this->system->Config]);
        }

        die(view('system/errorCLient.tpl', ['msg' => 'Запрашиваемая страница не найдена на нашем сервере.', 'title' => '404 Не найдено']));
    }
}