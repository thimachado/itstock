<?php

namespace App\Http\Controllers\Stock;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Models\Domain;
use Carbon\Carbon;
use Request;
use DB;
class DomainController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    public function showDomainForm() {
        $data = Domain::all();
        return view('stocks.domains.domains')->with(compact('data'));
    }

    public function register(Request $request) {
        //Validar data
        $this->validator(Request::all())->validate();
        //Criar servidor no banco de dados
        $data = $this->create(Request::all());
        return redirect('/domainlist');
    }
    protected function validator(array $data) {

        $rules = [
            'domain_name' => 'max:30|unique:domains',
            'domain_holder' => 'max:30',
            'domain_owner' => 'required|max:30',
            'domain_userlogin' => 'max:30',
            'domain_emaillogin' => 'max:30|email',
            'domain_password' => 'max:50',
            'domain_createdat' => 'date|before_or_equal:domain_expireat', 
            'domain_expireat' => 'date|after_or_equal:domain_createdat',
            'domain_updatedat' => 'date|after_or_equal:domain_createdat',
        ];
        $messages = [
            'max'  => 'O texto precisa conter menos que 30 caracteres.',
            'email' =>'O email informado não é um email válido.',
            'domain_name.unique'  => 'Este domínio já existe.',
            'domain_createdat.before_or_equal'  => 'A data de criação precisa ser anterior ou igual a data de expiração.',
            'domain_expireat.after_or_equal'  => 'A data de expiração precisa ser posterior ou igual a data de criação.',
            'domain_updatedat.after_or_equal'  => 'A data de atualização precisa ser posterior ou igual a data de criação.',
        ];
        return Validator::make($data, $rules, $messages);
    }
    protected function create(array $data) {
        $date = Carbon::parse($data['domain_expireat']);
        return Domain::create([
            'domain_name' => $data['domain_name'], 
            'domain_holder' => $data['domain_holder'],
            'domain_owner' => $data['domain_owner'],
            'domain_userlogin' => $data['domain_userlogin'],
            'domain_emaillogin' => $data['domain_emaillogin'],
            'domain_password' => $data['domain_password'],
            'domain_createdat' => $data['domain_createdat'],
            'domain_expireat' => $data['domain_expireat'],
            'domain_updatedat' => $data['domain_updatedat'],
            'domain_observation' => $data['domain_observation'],
            'domain_status' => $data['domain_status'],
            'domain_expiraem' =>$date,
            ]);
    }

    public function showListDomain() {
        $lastdomain = DB::table('domains')
         ->orderby('updated_at', 'desc')
         ->select('domains.*')->first();
         $data = Domain::all();
        return view('stocks.domains.list-domain')->with(compact('lastdomain', 'data'));
    }

    public function showDomainEditForm($id) {
        $data = DB::table('domains')->where('domains.id', '=', $id)->select('domains.*')->get();
        return view('stocks.domains.edit-domain')->with(compact('data'));;
    }
    public function editdomain(Request $request) {
        //Validar data
        $this->validatorEdit(Request::all())->validate();
        //Criar servidor no banco de dados
        $data = $this->edit(Request::all());
        return redirect('/domainlist');
    }
    protected function validatorEdit(array $data) {
       
        $rules = [
            'domain_name' => 'max:30',
            'domain_holder' => 'max:30',
            'domain_owner' => 'required|max:30',
            'domain_userlogin' => 'max:30',
            'domain_emaillogin' => 'max:30|email',
            'domain_password' => 'max:50',
            'domain_createdat' => 'date|before_or_equal:domain_expireat', 
            'domain_expireat' => 'date|after_or_equal:domain_createdat',
            'domain_updatedat' => 'date|after_or_equal:domain_createdat',
        ];
        $messages = [
            'max'  => 'O texto precisa conter menos que 30 caracteres.',
            'email' =>'O email informado não é um email válido.',
            'domain_createdat.before_or_equal'  => 'A data de criação precisa ser anterior ou igual a data de expiração.',
            'domain_expireat.after_or_equal'  => 'A data de expiração precisa ser posterior ou igual a data de criação.',
            'domain_updatedat.after_or_equal'  => 'A data de atualização precisa ser posterior ou igual a data de criação.',
        ];
        return Validator::make($data, $rules, $messages);
    }
    public function edit() {
     
        $data = Request::all();
        $date = Carbon::parse($data['domain_expireat']);
        //dd($date);
        $edit = Domain::where('id', $data['id'])->first();
        $edit->domain_name = $data['domain_name'];
        $edit->domain_holder = $data['domain_holder'];
        $edit->domain_owner = $data['domain_owner'];
        $edit->domain_userlogin = $data['domain_userlogin'];
        $edit->domain_emaillogin = $data['domain_emaillogin'];
        $edit->domain_createdat = $data['domain_createdat'];
        $edit->domain_expireat = $data['domain_expireat'];
        $edit->domain_updatedat = $data['domain_updatedat'];
        $edit->domain_expiraem = $date;
        $edit->save();
        return Redirect::back();
    }
}
