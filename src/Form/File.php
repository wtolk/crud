<?php

namespace Wtolk\Crud\Form;

use App\Helpers\Dev;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Arr;
use phpDocumentor\Reflection\Types\Boolean;
use Whoops\Exception\ErrorException;

class File extends Model
{
    public $type = 'file';
    public $template = 'crud::stubs.fields.input-file';
}
