<?php


namespace Wtolk\Crud\Form;


use App\Helpers\Dev;
use Illuminate\Support\Arr;
use Whoops\Exception\ErrorException;

class Model
{
    public $title;
    public $class;
    public $icon;
    public $type;
    public $required = false;
    public $placeholder = false;
    public $default_value = null;
    public $canSee = true;
    public $field_name;
    public $field_name_dotted;
    public $field_value = null;
    public $entity;
    public $multiple = false;

    public static function make($field_name)
    {
        $item = new static();
        $item->field_name_dotted = $field_name;
        $item->field_value = $item->getFieldValueFromDottedString($field_name);
        $item->field_name = $item->getFieldNameFromDottedString($field_name);
        return $item;
    }

    public function defaultValue($value) {
        $this->default_value = $value;
        return $this;
    }

    /**
     *  Заполняет значение по умолчанию из адресной строки
     */
    public function setFilter()
    {
        $args = explode( '.', $this->field_name_dotted);
        $this->default_value = (request()->{$args[0]} && request()->{$args[0]}[$args[1]] ) ? request()->{$args[0]}[$args[1]] : null;
        return $this;
    }

    public function multiple($bool = true) {
        $this->multiple = $bool;
        return $this;
    }

    public function setType($value) {
        $this->type = $value;
        return $this;
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

    public function icon($icon_name)
    {
        $this->icon = $icon_name;
        return $this;
    }

    public function class($class_names)
    {
        $this->class = $class_names;
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

    public function canSee($bool)
    {
        $this->canSee = $bool;
        return $this;
    }

    public function __toString()
    {
        $this->default_value = '';
        return $this->render(['item' => null]);
    }

    public function render($entity) {
        if ($this->canSee) {
            if (!Arr::isAssoc($entity)) {
                throw new ErrorException('Неправильно задан $form->source, должен быть ассоциативный массив', 500);
            }
            $input = $this;
            $input->entity = $entity;
            if ($this->default_value !== null) {
                $input->field_value = $this->default_value;
            } elseif ($input->entity) {
                $input->field_value = Arr::get($input->entity, $this->field_name_dotted);
            }
            return view($this->template, compact('input'))->render();
        }
    }
}
