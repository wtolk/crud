<?php

namespace Wtolk\Crud\Form;

use App\Helpers\Dev;

class Column
{
    public $class = 'col col-md-8';
    public $fields;
    public $route;
    public $renderedFields;
    public $method = null;

    public static function make($fields)
    {
        $item = new self();
        $item->fields = $fields;
        return $item;
    }

    public function class($class)
    {
        $this->class = $class;
        return $this;
    }

}
