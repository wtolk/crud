{!! $php_tags !!}

namespace {{$generator->controller_namespace}};

use App\Http\Controllers\Controller;
use {{$generator->controller_namespace}}\Screens\{{$generator->entity_name}}Screen;
use Illuminate\Http\Request;
use App\Adfm\Models\{{$generator->entity_name}};

class {{$generator->entity_name}}Controller extends Controller
{

    public function index()
    {
        {{$generator->entity_name}}Screen::index();
    }

    public function create()
    {
        {{$generator->entity_name}}Screen::create();
    }

    /**
     * Создание
     */
    public function store(Request $request)
    {
        $item = new {{$generator->entity_name}}();
        $item->fill($request->all()['{{strtolower($generator->entity_name)}}'])->save();
        return redirect()->route('adfm.{{strtolower($generator->entity_name)}}s.index');
    }

    /**
     * Форма редактирования
     */
    public function edit($id)
    {
        {{$generator->entity_name}}Screen::edit();
    }

    /**
     * Обновление
     */
    public function update(Request $request, $id)
    {
        $item = {{$generator->entity_name}}::findOrFail($id);
        $item->fill($request->all()['{{strtolower($generator->entity_name)}}'])->save();
        return redirect()->route('adfm.{{strtolower($generator->entity_name)}}s.index');
    }

    /**
     * Удаляем в корзину
     */
    public function destroy($id)
    {
        {{$generator->entity_name}}::destroy($id);
        return redirect()->route('adfm.{{strtolower($generator->entity_name)}}s.index');
    }
}
