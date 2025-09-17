<?php

namespace Wtolk\Crud\Form;

use Illuminate\Support\Arr;
use Whoops\Exception\ErrorException;

class TabsGroup
{
    public array $tabs = [];
    public array $renderedTabs = [];
    public string $template = 'crud::stubs.fields.tabs-group';

    public static function make(Tab ...$tabs): static
    {
        $item = new self();
        $item->tabs = $tabs;
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

        foreach ($this->tabs as $index => $tab) {
            $tab->id = 'tab-' . $index;
            $this->renderedTabs[$index] = $tab->render($entity);
        }

        $input = $this;
        return view($this->template, compact('input'))->render();
    }

}
