<?php

namespace Zbara\Framework\Model;

abstract class Model
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function __get($key)
    {
        return $this->model->$key;
    }

    public function __set($key, $value)
    {
        $this->model->$key = $value;
    }
}