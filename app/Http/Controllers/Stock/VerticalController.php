<?php
namespace App\Http\Controllers\Stock;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Request;
use App\Http\Controllers\Controller;
use App\Models\Vertical;
use DB;;
class VerticalController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }
    public function showVerticalForm() {
        $data = Vertical::all();
        return view('stocks.verticals.verticals')->with(compact('data'));
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
            'vertical_name' => 'max:30|unique:verticals',
        ];
    
        $messages = [
            'vertical_name.unique'  => 'Esta vertical já existe.',
            'vertical_name.max'  => 'O texto precisa conter menos que 30 caracteres.',
        ];
      
        return Validator::make($data, $rules, $messages);
    }
    protected function create(array $data) {
        return Vertical::create(['vertical_name' => $data['vertical_name'], ]);
    }
    public function showVerticalEditForm($id) {
        $data = DB::table('verticals')->where('verticals.id', '=', $id)->select('verticals.*')->get();
        return view('stocks.verticals.edit-vertical')->with(compact('data'));;
    }
    public function editvertical(Request $request) {
        //Validar data
        $this->validatorEdit(Request::all())->validate();
        //Criar servidor no banco de dados
        $data = $this->edit(Request::all());
        return redirect('/verticals');
    }
    protected function validatorEdit(array $data) {
        $rules = [
            'vertical_name' => 'max:30',
        ];
    
        $messages = [
            'vertical_name.max'  => 'O texto precisa conter menos que 30 caracteres.',
        ];
      
        return Validator::make($data, $rules, $messages);
    }
    public function edit() {
        $data = Request::all();
        $edit = Vertical::where('id', $data['id'])->first();
        $edit->vertical_name = $data['vertical_name'];
        $edit->save();
        return Redirect::back();
    }
}
