
/* Роуты админки сгенерированные автоматически для {{$generator->controller_namespace}}\{{$generator->entity_name}}Controller */

Route::get('/{{strtolower($generator->entity_name)}}s', '{{$generator->entity_name}}Controller@index')->name('@if($generator->isAdfmMode)adfm.@endif{{strtolower($generator->entity_name)}}s.index');
Route::get('/{{strtolower($generator->entity_name)}}s/create', '{{$generator->entity_name}}Controller@create')->name('@if($generator->isAdfmMode)adfm.@endif{{strtolower($generator->entity_name)}}s.create');
Route::post('/{{strtolower($generator->entity_name)}}s', '{{$generator->entity_name}}Controller@store')->name('@if($generator->isAdfmMode)adfm.@endif{{strtolower($generator->entity_name)}}s.store');
Route::get('/{{strtolower($generator->entity_name)}}s/{id}/edit', '{{$generator->entity_name}}Controller@edit')->name('@if($generator->isAdfmMode)adfm.@endif{{strtolower($generator->entity_name)}}s.edit');
Route::match(['put', 'patch'],'/{{strtolower($generator->entity_name)}}s/{id}', '{{$generator->entity_name}}Controller@update')->name('@if($generator->isAdfmMode)adfm.@endif{{strtolower($generator->entity_name)}}s.update');
Route::delete('/{{strtolower($generator->entity_name)}}s/{id}', '{{$generator->entity_name}}Controller@destroy')->name('@if($generator->isAdfmMode)adfm.@endif{{strtolower($generator->entity_name)}}s.destroy');

