<?php

namespace Wtolk\Crud\Form;

use App\Helpers\Dev;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Arr;
use phpDocumentor\Reflection\Types\Boolean;
use Whoops\Exception\ErrorException;

class MultiFile extends Model
{
    public $title;
    public $required = false;
    public $preview = false;
    public $placeholder;
    public $type = 'file';
    public $template = 'crud::stubs.fields.input-multifile';
    public $field_name;
    public $field_name_dotted;
    public $field_value = null;
    public $entity;

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

    public function preview($bool = true)
    {
        $this->preview = $bool;
        return $this;
    }

    public function placeholder($placeholder)
    {
        $this->placeholder = $placeholder;
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