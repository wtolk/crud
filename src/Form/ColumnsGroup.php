<?php

namespace Wtolk\Crud\Form;

use Illuminate\Support\Arr;
use Whoops\Exception\ErrorException;

class ColumnsGroup
{
    public array $columns = [];

    public string $template = 'crud::stubs.fields.columns-group';

    public static function make(Column ...$columns)
    {
        $item = new self();
        $item->columns = $columns;
        return $item;
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

        foreach ($this->columns as $index => $column) {
            $this->columns[$index] = $column->render($entity);
        }

        return view($this->template, compact('input'))->render();
    }

}
