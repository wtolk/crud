<?php

namespace Wtolk\Crud\Form;

class Select extends Model
{
    public $type = 'text';
    public $template = 'crud::stubs.fields.input-select';
    public $options = [];
    public $empty = null;
    
    public function options(Array $array)
    {
        $this->options = $array;
        return $this;
    }

    public function empty($name, $value = null)
    {
        $this->empty = ['name' => $name, 'value' => $value];
        return $this;
    }
}
