<?php

namespace Wtolk\Crud\Form;

use App\Helpers\Dev;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Arr;
use phpDocumentor\Reflection\Types\Boolean;
use Whoops\Exception\ErrorException;

class TableField extends Model
{
    public $link;
    public $function;

    public static function make($field_name, $field_title = null)
    {
        $item = new self();
        $item->title = $field_title;
        $item->field_name_dotted = $field_name;
        $item->field_value = $item->getFieldValueFromDottedString($field_name);
        $item->field_name = $item->getFieldNameFromDottedString($field_name);
        return $item;
    }

    public function link($closure)
    {
        $this->link = $closure;
        return $this;
    }

    public function addLink($closure)
    {
        $this->function = $closure;
        return $this;
    }

    public function render($entity) {
        return null;
        if (!Arr::isAssoc($entity)) {
            throw new ErrorException('Неправильно задан $form->source, должен быть ассоциативный массив', 500);
        }
        $input = $this;
        $input->entity = $entity;
        if (is_a($input->entity, 'Illuminate\Database\Eloquent\Collection') || is_a($input->entity, 'Illuminate\Pagination\LengthAwarePaginator')) {
            return null;
        }

        $input->field_value = Arr::get($input->entity, $this->field_name_dotted);
        Dev::dd($input);
        return view($this->template, compact('input'))->render();
    }


}
