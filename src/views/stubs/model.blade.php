{!! $php_tags !!}
namespace {{$generator->model_namespace}};

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wtolk\Adfm\Helpers\AttachmentTrait;

class {{$generator->entity_name}} extends Model
{
    use HasFactory;
    use SoftDeletes;
    use AttachmentTrait;

    protected $fillable = [
@foreach($generator->fields as $field_name => $field_type)
        '{!! nl2br($field_name) !!}'@if(!$loop->last),@endif{!! nl2br('') !!}
@endforeach
    ];
}
