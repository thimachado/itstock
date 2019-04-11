<?php
namespace App\Http\Controllers\Stock;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Request;
use App\Http\Controllers\Controller;
use App\Models\ClientGroup;
use DB;
class ClientGroupController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }
    public function showClientGroupForm() {
        $data = ClientGroup::all();
        //dd($data);
        return view('stocks.clientgroups.clientgroups')->with(compact('data'));
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
            'clientgroup_name' => 'max:30|unique:clientgroups'
        ];
        $messages = [
            'clientgroup_name.unique'  => 'Este grupo de cliente já existe.',
            'clientgroup_name.max'  => 'O texto precisa conter menos que 30 caracteres.'
        ];
        return Validator::make($data, $rules, $messages);
    }
    protected function create(array $data) {
        return ClientGroup::create(['clientgroup_name' => $data['clientgroup_name'], ]);
    }
    public function showClientGroupEditForm($id) {
        $data = DB::table('clientgroups')->where('clientgroups.id', '=', $id)->select('clientgroups.*')->get();
        return view('stocks.clientgroups.edit-clientgroup')->with(compact('data'));;
    }
    public function editclientgroup(Request $request) {
        //Validar data
        $this->validatorEdit(Request::all())->validate();
        //Criar servidor no banco de dados
        $data = $this->edit(Request::all());
        return redirect('/clientgroup');
    }
    protected function validatorEdit(array $data) {
        $rules = [
            'clientgroup_name' => 'max:30'
        ];
        $messages = [
            'clientgroup_name.max'  => 'O texto precisa conter menos que 30 caracteres.'
        ];
        return Validator::make($data, $rules, $messages);
    }
    public function edit() {
        $data = Request::all();
        $edit = ClientGroup::where('id', $data['id'])->first();
        $edit->clientgroup_name = $data['clientgroup_name'];
        $edit->save();
        return Redirect::back();
    }
}
