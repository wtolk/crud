<?php

namespace Wtolk\Crud\Form;

use App\Helpers\Dev;

class Link
{
    public $title;
    public $icon;
    public $route;
    public $route_param = [];
    public $href = null;
    public $method = 'GET';
    public $template = 'crud::stubs.fields.link';
    public $entity;
    public $class;
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

    public function class($class_names)
    {
        $this->class = $class_names;
        return $this;
    }

    public function route($route_name, $route_param = null)
    {
        $this->route = $route_name;
        $this->route_param = $route_param;
        $router = app('Illuminate\Routing\Router');
        $route = $router->getRoutes()->getByName($route_name);
        $methods = $route->methods();
        $this->method = $methods[0];
        return $this;
    }

    public function canSee($bool)
    {
        $this->canSee = $bool;
        return $this;
    }

    public function render($entity = null) {
        $link = $this;
        $link->entity = $entity;
        return view($this->template, compact('link'))->render();
    }


}
