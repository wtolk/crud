<?php

namespace Wtolk\Crud;

use Illuminate\Support\Facades\Storage;

class Generator
{

    public $entity_name;
    public $table_name;
    public $fields;
    public $isAdfmMode = false;
    public $model_path;
    public $model_namespace;
    public $controller_path;
    public $controller_namespace;
    public $screen_path;
    public $screen_namespace;
    public $routes_path;
    private $storage;

    public function __construct($name, $table = null)
    {
        $this->entity_name = $name;
        $this->table_name = $table;
        $this->model_path = 'app/Models/';
        $this->model_namespace = 'App\Models';
        $this->controller_path = 'app/Http/Controllers/';
        $this->controller_namespace = 'App\Http\Controllers';
        $this->screen_path = 'app/Http/Controllers/Screens/';
        $this->screen_namespace = 'App\Http\Controllers\Screens';
        $this->routes_path = 'routes/web.php';
        if ($this->table_name) {
            self::getFieldsType($this->table_name);
        }

        $rootPath = app_path('../');
        $this->storage = Storage::createLocalDriver(['root' => $rootPath]);
    }

    public function setAdfmOption()
    {
        $this->isAdfmMode = true;
        $this->model_path = 'packages/wtolk/adfm/src/Models/';
        $this->controller_path = 'packages/wtolk/adfm/src/Controllers/';
        $this->screen_path = 'packages/wtolk/adfm/src/Controllers/Screens/';
        $this->model_namespace = 'Wtolk\Adfm\Models';
        $this->controller_namespace = 'Wtolk\Adfm\Controllers';
        $this->screen_namespace = 'Wtolk\Adfm\Controllers\Screens';
        $this->routes_path = 'packages/wtolk/adfm/src/routes.php';
    }


    public function makeModel()
    {
        $data = view('crud::stubs.model', ['generator' => $this])->render();
        $this->storage->put($this->model_path.$this->entity_name.'.php',  $data);
    }

    public function makeController()
    {
        $data = view('crud::stubs.controller', ['generator' => $this])->render();
        $this->storage->put($this->controller_path.$this->entity_name.'Controller.php',  $data);
    }

    public function makeScreen()
    {
        $data = view('crud::stubs.screen', ['generator' => $this])->render();
        $this->storage->put($this->screen_path.$this->entity_name.'Screen.php',  $data);
    }

    public function makeRoutes()
    {
        $data = view('crud::stubs.routes', ['generator' => $this])->render();
        $this->storage->append($this->routes_path,  $data);
    }

    public function makeAll()
    {
        $this->makeModel();
        $this->makeController();
        $this->makeScreen();
        $this->makeRoutes();
    }

    public function getFieldsType($table)
    {
        $fields = \Schema::getColumnListing($table);
        $list = [];
        foreach ($fields as $field) {
            if (in_array($field, ['id', 'created_at', 'updated_at', 'deleted_at', 'model_name', 'model_id']) ) {
                continue;
            }
            $list[$field] = \Schema::getColumnType($table, $field);
        }
        foreach ($list as $name => $type) {
            if (in_array($type, ['integer']) ) {
                unset($list[$name]);
            }
        }

        $this->fields = $list;
    }

}
