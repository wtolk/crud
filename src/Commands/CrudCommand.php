<?php

namespace Wtolk\Crud\Commands;

use Illuminate\Console\Command;
use Wtolk\Crud\Generator;


class CrudCommand extends Command
{

    protected $signature = 'crud:make {entity : Название модели} {--table= : из какой таблицы сделать} {--adfm : если генератор нужен для adfm пакета}' ;
    protected $description = 'Генерирует сущность (Модель, Контроллер, Экран)';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
//        dd(app_path('/Models/'));

        $class = $this->choice('Какой вид Класса делаем?', [
            'All', 'Model', 'Controller', 'Screen', 'Routes'], 0);
        $this->info('Генерируем ...'.$class);
        $operation = 'make'.$class;
        $generator = new Generator($this->argument('entity'), $this->option('table'));
        if ($this->option('adfm')) {
            $generator->setAdfmOption();
        }
        $generator->$operation();
    }
}
