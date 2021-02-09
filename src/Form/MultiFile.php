<?php

namespace Wtolk\Crud\Form;

class MultiFile extends Model
{
    public $preview = false;
    public $type = 'file';
    public $template = 'crud::stubs.fields.input-multifile';

    public function preview($bool = true)
    {
        $this->preview = $bool;
        return $this;
    }
}
