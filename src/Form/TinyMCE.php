<?php

namespace Wtolk\Crud\Form;

use Illuminate\Support\Arr;
use Whoops\Exception\ErrorException;
use XhtmlFormatter\Formatter;

class TinyMCE extends Model
{
    public $type = 'textarea';
    public $template = 'crud::stubs.fields.input-tinymce';
    public $devMode = false;
    
    public function devMode($bool = true) {
        $this->devMode = $bool;
        return $this;
    }
    
    public function render($entity) {
        if ($this->canSee) {
            if (!Arr::isAssoc($entity)) {
                throw new ErrorException('Неправильно задан $form->source, должен быть ассоциативный массив', 500);
            }
            $input = $this;
            $input->entity = $entity;
            if ($this->default_value !== null) {
                $input->field_value = $this->default_value;
            } elseif ($input->entity) {
                $input->field_value = Arr::get($input->entity, $this->field_name_dotted);
                if ($this->field_value == null) {
                    $input->field_value = '';
                }
            }

            $formatter = new Formatter();
            $input->field_value = $formatter->format($input->field_value);
            return view($this->template, compact('input'))->render();
        }
    }
}