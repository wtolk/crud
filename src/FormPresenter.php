<?php

namespace Wtolk\Crud;

use App\Helpers\Dev;
use Illuminate\Support\Facades\Storage;
use Wtolk\Crud\Form\Column;
use Wtolk\Crud\Form\ItemMenu;

class FormPresenter
{
    public $template;
    public $source = [];
    public $buttons;
    public $fields;
    public $columns;
    public $mainMenu = [];
    public $renderedButtons;
    public $title;
    public $route;
    public $isModelExists = false; // Если на экране выводится существующая модель для редактирования, а не для добавления.


    public function template($layout)
    {
        $this->template = 'crud::admin.'.$layout;
        return $this;
    }

    public function source(Array $entities)
    {
        $this->source = $entities;
        return $this;
    }

    public function buttons(Array $items)
    {
        $this->buttons = $items;
        return $this;
    }

    public function registerMainMenu()
    {
        $this->mainMenu = [
            ItemMenu::make('Страницы')->route('adfm.pages.index')->icon("insert_drive_file"),
            ItemMenu::make('Меню')->route('adfm.menus.index')->icon("menu"),
            'Конфигурация' => [
                ItemMenu::make('Роли')->route('adfm.roles.index')->icon('supervised_user_circle'),
                ItemMenu::make('Пользователи')->route('adfm.users.index')->icon('people'),
            ]
        ];
    }

    /**
     * Принимает объект класса Input или массив объектов
     * для отображени в форме
     */
    public function addField($field) {
        if (is_array($field)) {
            foreach ($field as $f) {
                $this->fields[] = $f;
            }
        } else {
            $this->fields[] = $field;
        }
        return $this;
    }

    public function build()
    {
        if (empty($this->columns)) {
            $this->columns[] = Column::make($this->fields);
        }
        foreach ($this->columns as $index => $column) {
            foreach ($column->fields as $field) {
                $column->renderedFields[] = $field->render($this->source);
            }
            $this->columns[$index] = $column;
        }

        foreach ($this->buttons as $button) {
//            Dev::dd($button->canSee); die;
            if ($button->canSee) {
//                Dev::dd($button->canSee); die;
                $this->renderedButtons[] = $button->render($this->source);
            }
        }

        return $this;
    }

    public function render()
    {
        $this->registerMainMenu();
        echo view($this->template, ['form' => $this])->render();
    }
}
