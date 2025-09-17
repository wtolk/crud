<?php

namespace Wtolk\Crud\Form;

use Illuminate\Support\Arr;
use Whoops\Exception\ErrorException;

class Tab
{
    public string $title = 'Tab Title';
    public string $id;
    public $fields;
    public $renderedFields;
    public string $template = 'crud::stubs.fields.tab';

    public static function make($fields): static
    {
        $item = new self();
        $item->fields = $fields;
        return $item;
    }

    public function title($title): static
    {
        $this->title = $title;
        return $this;
    }

    public function __toString()
    {
        return $this->render(['item' => null]);
    }
    public function render($entity): string
    {
        if (!Arr::isAssoc($entity)) {
            throw new ErrorException('Неправильно задан $form->source, должен быть ассоциативный массив', 500);
        }
        $input = $this;
        foreach ($this->fields as $field) {
            $this->renderedFields[] = $field->render($entity);
        }

        return view($this->template, compact('input'))->render();
    }

}
