<?php

namespace Wtolk\Crud\Form;

class TreeElements extends Model
{
    public $type = 'textarea';
    public $template = 'crud::stubs.fields.tree-elements';
    public $link;

    public function link($closure)
    {
        $this->link = $closure;
        return $this;
    }
}
