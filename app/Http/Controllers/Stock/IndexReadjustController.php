<?php
namespace App\Http\Controllers\Stock;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Models\IndexReadjust;
use Request;
use DB;
class IndexReadjustController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    public function showIndexForm() {
        $data = IndexReadjust::all();
        //die($data);
        return view('stocks.indexreadjust.index')->with(compact('data'));
    }

public function register(Request $request) {
    //Validar data
    $this->validator(Request::all())->validate();
    //Criar servidor no banco de dados
    $data = $this->create(Request::all());
    return Redirect::back();
}
protected function validator(array $data) {
    $rules = [
        'index_name' => 'max:30|unique:indexreadjustments',
    ];
    $messages = [
        'index_name.unique'  => 'Este índice já existe.',
        'index_name.max'  => 'O texto precisa conter menos que 30 caracteres.'
    ];
    return Validator::make($data, $rules, $messages);
}
protected function create(array $data) {
    return IndexReadjust::create(['index_name' => $data['index_name'], ]);
}
public function showIndexEditForm($id) {
    $data = DB::table('indexreadjustments')->where('indexreadjustments.id', '=', $id)->select('indexreadjustments.*')->get();
    return view('stocks.indexreadjust.edit-index')->with(compact('data'));;
}
public function editIndex(Request $request) {
    //Validar data
    $this->validatorEdit(Request::all())->validate();
    //Criar servidor no banco de dados
    $data = $this->edit(Request::all());
    return redirect('/index');
}
protected function validatorEdit(array $data) {
    $rules = [
        'index_name' => 'max:30',
    ];
    $messages = [
        'index_name.max'  => 'O texto precisa conter menos que 30 caracteres.'
    ];
    return Validator::make($data, $rules, $messages);
}
public function edit() {
    $data = Request::all();
    $edit = IndexReadjust::where('id', $data['id'])->first();
    $edit->index_name = $data['index_name'];
    $edit->save();
    return Redirect::back();
}
}
