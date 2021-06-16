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
    public $filters;
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

    public function filters(Array $filters)
    {
        $this->filters = $filters;
        return $this;
    }

    public function registerMainMenu()
    {
        $this->mainMenu = [
            ItemMenu::make('Страницы')->route('adfm.pages.index')->icon("insert_drive_file"),
            ItemMenu::make('Меню')->route('adfm.menus.index')->icon("menu"),
            ItemMenu::make('Обратная сязь')->route('adfm.feedbacks.index')->icon('feedback'),

           'Каталог' => [
               ItemMenu::make('Категории')->route('adfm.categories.index')->icon('format_list_bulleted'),
               ItemMenu::make('Товары')->route('adfm.products.index')->icon('card_giftcard'),
            ],

            'Конфигурация' => [
                ItemMenu::make('Роли')->route('adfm.roles.index')->icon('supervised_user_circle'),
                ItemMenu::make('Пользователи')->route('adfm.users.index')->icon('people'),
            ],
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

        if (isset($this->buttons)) {
            foreach ($this->buttons as $button) {
                if ($button->canSee) {
                    $this->renderedButtons[] = $button->render($this->source);
                }
            }
        }


        if (isset($this->filters)) {
            foreach ($this->filters as $filter) {
                $this->renderedFilters[] = $filter->render($this->source);
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
