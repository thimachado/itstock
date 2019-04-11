<?php
namespace App\Http\Controllers\Stock;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Request;
use App\Http\Controllers\Controller;
use App\Models\Deposit;
use DB;
class DepositController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }
    public function showDepositForm() {
        $data = Deposit::all();
        //dd($data);
        return view('stocks.deposits.deposits')->with(compact('data'));
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
            'deposit_name' => 'max:30|unique:deposits',
        ];
        $messages = [
            'deposit_name.unique'  => 'Esta depósito já existe.',
            'deposit_name.max'  => 'O texto precisa conter menos que 30 caracteres.'
        ];
        return Validator::make($data, $rules, $messages);
  
    }
    protected function create(array $data) {
        return Deposit::create(['deposit_name' => $data['deposit_name'], ]);
    }
    public function showDepositEditForm($id) {
        $data = DB::table('deposits')->where('deposits.id', '=', $id)->select('deposits.*')->get();
        return view('stocks.deposits.edit-deposit')->with(compact('data'));;
    }
    public function editdeposit(Request $request) {
        //Validar data
        $this->validatorEdit(Request::all())->validate();
        //Criar servidor no banco de dados
        $data = $this->edit(Request::all());
        return redirect('/deposits');
    }
    protected function validatorEdit(array $data) {
        $rules = [
            'deposit_name' => 'max:30',
        ];
        $messages = [
            'deposit_name.max'  => 'O texto precisa conter menos que 30 caracteres.'
        ];
        return Validator::make($data, $rules, $messages);
    }
    public function edit() {
        $data = Request::all();
        $edit = Deposit::where('id', $data['id'])->first();
        $edit->deposit_name = $data['deposit_name'];
        $edit->save();
        return Redirect::back();
    }
}
