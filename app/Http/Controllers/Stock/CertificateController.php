<?php

namespace App\Http\Controllers\Stock;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Request;

use Carbon\Carbon;
use DB;
class CertificateController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    public function showCertificateForm() {
      
        return view('stocks.certificates.certificate');
    }
    public function register(Request $request) {
        //Validar data
        $this->validator(Request::all())->validate();
        //Criar servidor no banco de dados
        $data = $this->create(Request::all());
        return redirect('/certificatelist');
    }
    protected function validator(array $data) {

        $rules = [
            'certificate_emitter' => 'max:50',
            'certificate_owner' => 'max:50',
            'certificate_type' => 'max:50',
            'certificate_value' => 'required',
            'certificate_expirationdate' => 'date', 
            'certificate_status' => 'required', 
            'certificate_use' => 'required', 
        ];
        $messages = [
            'max'  => 'O texto precisa conter menos que 50 caracteres.',
            'required'  => 'Este campo é obrigatório',
            'date'  => 'O valor informado não é uma data',
        ];
        return Validator::make($data, $rules, $messages);
    }

    protected function create(array $data) {
        $date = Carbon::parse($data['certificate_expirationdate']);
        return Certificate::create([
            'certificate_emitter' => $data['certificate_emitter'], 
            'certificate_owner' => $data['certificate_owner'], 
            'certificate_type' => $data['certificate_type'], 
            'certificate_value' => $data['certificate_value'], 
            'certificate_expirationdate' => $data['certificate_expirationdate'], 
            'certificate_status' => $data['certificate_status'], 
            'certificate_use' => $data['certificate_use'], 
            'certificate_expiraem' => $date
            ]);
    }

    public function showListCertificate() {
        $lastcertificate = DB::table('certificates')
         ->orderby('updated_at', 'desc')
         ->select('certificates.*')->first();
         $data = Certificate::all();
        return view('stocks.certificates.list-certificate')->with(compact('lastcertificate', 'data'));
    }

    public function showCertificateEditForm($id) {
        $data = DB::table('certificates')->where('certificates.id', '=', $id)->select('certificates.*')->get();
        return view('stocks.certificates.edit-certificate')->with(compact('data'));;
    }
    public function editcertificate(Request $request) {
        //Validar data
        $this->validator(Request::all())->validate();
        //Criar servidor no banco de dados
        $data = $this->edit(Request::all());
        return redirect('/certificatelist');
    }
    public function edit() {
     
        $data = Request::all();
        $date = Carbon::parse($data['certificate_expirationdate']);
        //dd($date);
        $edit = Certificate::where('id', $data['id'])->first();
        $edit->certificate_emitter=$data['certificate_emitter'];
        $edit->certificate_owner=$data['certificate_owner'];
        $edit->certificate_type=$data['certificate_type'];
        $edit->certificate_value=$data['certificate_value']; 
        $edit->certificate_expirationdate=$data['certificate_expirationdate']; 
        $edit->certificate_status=$data['certificate_status']; 
        $edit->certificate_use=$data['certificate_use']; 
        $edit->certificate_expiraem=$date;
        $edit->save();
        return Redirect::back();
    }
}
