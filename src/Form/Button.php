<?php

namespace Wtolk\Crud\Form;

use App\Helpers\Dev;

class Button
{
    public $title;
    public $icon;
    public $route;
    public $method = null;
    public $submit = false;
    public $template = 'crud::stubs.fields.button';
    public $entity;
    public $canSee = true;

    public static function make($title)
    {
        $item = new self();
        $item->title = $title;
        return $item;
    }

    public function icon($icon_name)
    {
        $this->icon = $icon_name;
        return $this;
    }

    public function route($route_name)
    {
        $this->route = $route_name;
        $router = app('Illuminate\Routing\Router');
        $route = $router->getRoutes()->getByName($route_name);
        $methods = $route->methods();
        $this->method = $methods[0];
        return $this;
    }

    public function submit()
    {
        $this->submit = true;
        return $this;
    }

    public function canSee($bool)
    {
        $this->canSee = $bool;
        return $this;
    }

    public function render($entity) {
        $button = $this;
        $button->entity = $entity;
        return view($this->template, compact('button'))->render();
    }


}
