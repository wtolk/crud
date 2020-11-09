<?php

namespace Wtolk\Crud\Form;

use App\Helpers\Dev;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Arr;
use phpDocumentor\Reflection\Types\Boolean;
use Whoops\Exception\ErrorException;

class Custom extends Model
{

    public $template = null;
    public $vars = [];

    public static function template($template) {
        $item = new self();
        $item->template = $template;
        return $item;
    }

    public function vars(Array $vars)
    {
        $this->vars = $vars;
        return $this;
    }

    public function render($entity) {

        $input = $this;
        $input->entity = $entity;

        return view($this->template, $this->vars)->render();
    }


}
