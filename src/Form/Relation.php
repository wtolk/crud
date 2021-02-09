<?php

namespace Wtolk\Crud\Form;

use Illuminate\Support\Arr;
use Whoops\Exception\ErrorException;

class Relation extends Model
{
    public $type = 'text';
    public $template = 'crud::stubs.fields.input-relation';
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

    public function render($entity) {
        if (!Arr::isAssoc($entity)) {
            throw new ErrorException('Неправильно задан $form->source, должен быть ассоциативный массив', 500);
        }
        $input = $this;
        $input->entity = $entity;
        if ($this->default_value) {
            $input->field_value = $this->default_value;
        } else {
            $input->field_value = (Arr::get($input->entity, $this->field_name_dotted) == null) ? null : Arr::get($input->entity, $this->field_name_dotted)->id;
        }
        return view($this->template, compact('input'))->render();
    }


}
