<?php
namespace App\Http\Controllers\Stock;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Request;
use App\Http\Controllers\Controller;
use App\Models\Business;
use DB;
class BusinessController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }
    public function showBusinessForm() {
        $data = Business::all();
        //dd($data);
        return view('stocks.business.business')->with(compact('data'));
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
            'business_name' => 'max:30|unique:business'
        ];
    
        $messages = [
            'business_name.unique'  => 'Este negócio já existe.',
            'business_name.max'  => 'O texto precisa conter menos que 30 caracteres.'
        ];
        return Validator::make($data, $rules, $messages);
    }
    protected function create(array $data) {
        return Business::create(['business_name' => $data['business_name'], ]);
    }
    public function showBusinessEditForm($id) {
        $data = DB::table('business')->where('business.id', '=', $id)->select('business.*')->get();
        return view('stocks.business.edit-business')->with(compact('data'));;
    }
    public function editbusiness(Request $request) {
        //Validar data
        $this->validatorEdit(Request::all())->validate();
        //Criar servidor no banco de dados
        $data = $this->edit(Request::all());
        return redirect('/business');
    }
    protected function validatorEdit(array $data) {
        $rules = [
            'business_name' => 'max:30'
        ];
    
        $messages = [
            'business_name.max'  => 'O texto precisa conter menos que 30 caracteres.',
        ];
        return Validator::make($data, $rules, $messages);
    }
    public function edit() {
        $data = Request::all();
        $edit = Business::where('id', $data['id'])->first();
        $edit->business_name = $data['business_name'];
        $edit->save();
        return Redirect::back();
    }
}
