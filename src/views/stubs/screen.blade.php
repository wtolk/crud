{!! $php_tags !!}

namespace {{$generator->screen_namespace}};

use App\Helpers\Dev;
use Wtolk\Crud\Form\Column;
use Wtolk\Crud\Form\File;
use Wtolk\Crud\Form\Summernote;
use Wtolk\Crud\FormPresenter;
use Wtolk\Adfm\Models\{{$generator->entity_name}};
use Wtolk\Crud\Form\Input;
use Wtolk\Crud\Form\Checkbox;
use Wtolk\Crud\Form\TableField;
use Wtolk\Crud\Form\Link;
use Wtolk\Crud\Form\Button;


class {{$generator->entity_name}}Screen
{
    public $form;
    public $request;

    public function __construct()
    {
        $this->form = new FormPresenter();
        $this->request = request();

    }

    public static function index()
    {
        $screen = new self();
        $screen->form->layout('table-list')->source([
            '{{strtolower($generator->entity_name)}}s' => {{$generator->entity_name}}::paginate(50)
        ]);

        $screen->form->addField(
            TableField::make('title', 'Название')
                ->link(function ($model) {
                    echo Link::make($model->title)->route('adfm.{{strtolower($generator->entity_name)}}s.edit', ['id' => $model->id])->render();
            })
        );
        $screen->form->addField(TableField::make('created_at', 'Дата создания'));
        $screen->form->addField(
            TableField::make('delete', 'Операции')
                ->link(function ($model) {
                    echo Link::make('Удалить')->route('adfm.{{strtolower($generator->entity_name)}}s.destroy', ['id' => $model->id])->render();
            })
        );
        $screen->form->buttons([
            Link::make('Добавить')->class('button')->icon('note')->route('adfm.{{strtolower($generator->entity_name)}}s.create')
        ]);
        $screen->form->build();
        $screen->form->render();
    }

    public static function create()
    {
        $screen = new self();
        $screen->form->isModelExists = false;
        $screen->form->layout('form-edit')->source([
            '{{strtolower($generator->entity_name)}}' => new {{$generator->entity_name}}()
        ]);
        $screen->form->title = 'Создание {{strtolower($generator->entity_name)}}';
        $screen->form->route = route('adfm.{{strtolower($generator->entity_name)}}s.store');
        $screen->form->columns = self::getFields();
        $screen->form->buttons([
            Button::make('Сохранить')->icon('save')->route('adfm.{{strtolower($generator->entity_name)}}s.update')->submit(),
            Button::make('Удалить')->icon('trash')->route('adfm.{{strtolower($generator->entity_name)}}s.destroy')->canSee($screen->form->isModelExists)
        ]);
        $screen->form->build();
        $screen->form->render();
    }

    public static function edit()
    {
        $screen = new self();
        $screen->form->isModelExists = true;
        $screen->form->layout('form-edit')->source([
            '{{strtolower($generator->entity_name)}}' => {{$generator->entity_name}}::findOrFail($screen->request->route('id'))
        ]);
        $screen->form->title = 'Редактирование {{strtolower($generator->entity_name)}}';
        $screen->form->route = route('adfm.{{strtolower($generator->entity_name)}}s.update', $screen->form->source['{{strtolower($generator->entity_name)}}']->id);
        $screen->form->columns = self::getFields();
        $screen->form->buttons([
            Button::make('Сохранить')->icon('save')->route('adfm.{{strtolower($generator->entity_name)}}s.update')->submit(),
            Button::make('Удалить')->icon('trash')->route('adfm.{{strtolower($generator->entity_name)}}s.destroy')->canSee($screen->form->isModelExists)
        ]);
        $screen->form->build();
        $screen->form->render();
    }

    public static function getFields() {
        return [
            Column::make([
@foreach($generator->fields as $field_name => $field_type)
                @component('crud::stubs.screen_components.'.$field_type, ['field_name' => $field_name, 'entity_name' => $generator->entity_name])
                @endcomponent
@endforeach
            ])
        ];
    }

}
