<?php


namespace Wtolk\Crud\Form;


use App\Helpers\Dev;
use Illuminate\Support\Arr;
use Whoops\Exception\ErrorException;

class Model
{
    public $default_value = null;

    public function defaultValue($value) {
        $this->default_value = $value;
        return $this;
    }
    public function getFieldNameFromDottedString($dotted_string)
    {
        $field_array = explode( '.', $dotted_string);
        $fields_paths[] = array_shift($field_array);
        foreach ($field_array as $element) {
            $fields_paths[] = '['.$element.']';
        }
        $fields_paths = implode('', $fields_paths);
        return $fields_paths;
    }

    public function getFieldValueFromDottedString($dotted_string)
    {
        $array = explode( '.', $dotted_string);
        $array[0] = "['".$array[0]."']";
        $field_value = implode('->', $array);
        return $field_value;
    }

    public function render($entity) {
        if (!Arr::isAssoc($entity)) {
            throw new ErrorException('Неправильно задан $form->source, должен быть ассоциативный массив', 500);
        }
        $input = $this;
        $input->entity = $entity;
        if ($input->entity)
            $input->field_value = Arr::get($input->entity, $this->field_name_dotted);
        return view($this->template, compact('input'))->render();
    }
}
