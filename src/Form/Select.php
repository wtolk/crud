<?php

namespace Wtolk\Crud\Form;

use App\Helpers\Dev;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Arr;
use phpDocumentor\Reflection\Types\Boolean;
use Whoops\Exception\ErrorException;

class Select extends Model
{
    public $title;
    public $required = false;
    public $placeholder;
    public $type = 'text';
    public $template = 'crud::stubs.fields.input-select';
    public $field_name;
    public $field_name_dotted;
    public $field_value = null;
    public $entity;
    public $options = [];
    public $empty = null;

    public static function make($field_name)
    {
        $item = new self();
        $item->field_name_dotted = $field_name;
        $item->field_value = $item->getFieldValueFromDottedString($field_name);
        $item->field_name = $item->getFieldNameFromDottedString($field_name);
        return $item;
    }

    public function title($title)
    {
        $this->title = $title;
        return $this;
    }

    public function required($bool = true)
    {
        $this->required = $bool;
        return $this;
    }

    public function placeholder($placeholder)
    {
        $this->placeholder = $placeholder;
        return $this;
    }

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
        $input->field_value = Arr::get($input->entity, $this->field_name_dotted);
        return view($this->template, compact('input'))->render();
    }


}
