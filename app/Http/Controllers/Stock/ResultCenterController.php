<?php
namespace App\Http\Controllers\Stock;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Request;
use App\Http\Controllers\Controller;
use App\Models\ResultCenter;
use DB;
class ResultCenterController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }
    public function showResultCenterForm() {
        $data = ResultCenter::all();
        return view('stocks.resultcenters.resultcenter')->with(compact('data'));
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
            'resultcenter_name' => 'max:30|unique:resultcenters',
        ];
    
        $messages = [
            'resultcenter_name.unique'  => 'Este Centro de Resultado já existe.',
            'resultcenter_name'  => 'O texto precisa conter menos que 30 caracteres.',
        ];
      
        return Validator::make($data, $rules, $messages);
    }
    protected function create(array $data) {
        return ResultCenter::create(['resultcenter_name' => $data['resultcenter_name'], ]);
    }
    public function showResultCenterEditForm($id) {
        $data = DB::table('resultcenters')->where('resultcenters.id', '=', $id)->select('resultcenters.*')->get();
        return view('stocks.resultcenters.edit-resultcenter')->with(compact('data'));;
    }
    public function editresultcenter(Request $request) {
        //Validar data
        $this->validatorEdit(Request::all())->validate();
        //Criar servidor no banco de dados
        $data = $this->edit(Request::all());
        return redirect('/resultcenter');
    }
    protected function validatorEdit(array $data) {
        $rules = [
            'resultcenter_name' => 'max:30',
        ];
    
        $messages = [
            'resultcenter_name'  => 'O texto precisa conter menos que 30 caracteres.',
        ];
      
        return Validator::make($data, $rules, $messages);
    }
    public function edit() {
        $data = Request::all();
        $edit = ResultCenter::where('id', $data['id'])->first();
        $edit->resultcenter_name = $data['resultcenter_name'];
        $edit->save();
        return Redirect::back();
    }
}
