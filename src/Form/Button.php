<?php

namespace Wtolk\Crud\Form;

class Button extends Model
{
    public $route;
    public $method = null;
    public $submit = false;
    public $template = 'crud::stubs.fields.button';

    public static function make($title)
    {
        $item = new self();
        $item->title = $title;
        return $item;
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

    public function render($entity) {
        $button = $this;
        $button->entity = $entity;
        return view($this->template, compact('button'))->render();
    }
}
