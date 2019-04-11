<?php
namespace App\Http\Controllers\Stock;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Request;
use App\Http\Controllers\Controller;
use App\Models\Area;
use DB;
class AreaController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }
    public function showAreaForm() {
        $data = Area::all();
        //dd($data);
        return view('stocks.areas.areas')->with(compact('data'));
    }
    public function register(Request $request) {
        // dd(Request::all());
        //Validar data
        $this->validator(Request::all())->validate();
        //Criar servidor no banco de dados
        $data = $this->create(Request::all());
        return Redirect::back();
    }


    protected function validator(array $data) {

        $rules = [
            'area_name' => 'max:30|unique:areas',
        ];
    
        $messages = [
            'area_name.unique'  => 'Esta área já existe.',
            'area_name.max'  => 'O texto precisa conter menos que 30 caracteres.',
        ];
      
        return Validator::make($data, $rules, $messages);
    }
    protected function create(array $data) {
        return Area::create(['area_name' => $data['area_name'], ]);
    }
    public function showAreaEditForm($id) {
        $data = DB::table('areas')->where('areas.id', '=', $id)->select('areas.*')->get();
        return view('stocks.areas.edit-area')->with(compact('data'));;
    }
    public function editarea(Request $request) {
        //Validar data
        $this->validatorEdit(Request::all())->validate();
        //Criar servidor no banco de dados
        $data = $this->edit(Request::all());
        return redirect('/areas');
    }
    protected function validatorEdit(array $data) {

        $rules = [
            'area_name' => 'max:30',
        ];
    
        $messages = [
            'area_name.max'  => 'O texto precisa conter menos que 30 caracteres.',
        ];
     return Validator::make($data, $rules, $messages);
    }
    public function edit() {
        $data = Request::all();
        $edit = Area::where('id', $data['id'])->first();
        $edit->area_name = $data['area_name'];
        $edit->save();
        return Redirect::back();
    }
}
