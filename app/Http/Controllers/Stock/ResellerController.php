<?php

namespace App\Http\Controllers\Stock;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Request;
use App\Http\Controllers\Controller;
use App\Models\Reseller;
use DB;


class ResellerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showResellerForm(){
        $data = Reseller::all ();

        //dd($data);
        return view ( 'stocks.resellers.resellers' )->with(compact('data'));
    }
    public function register(Request $request)
    {
       //Validar data
        $this->validator(Request::all())->validate();
       
        //Criar servidor no banco de dados
        $data = $this->create(Request::all());
  
       return Redirect::back();
    }

    protected function validator(array $data)
    {
        $rules = [
            'reseller_name' => 'max:30|unique:resellers',
            'reseller_site' => 'max:50|unique:resellers',
            'reseller_email' => 'email|max:255|unique:resellers',
        ];
    
        $messages = [
            'reseller_name.unique'  => 'Este fornecedor já existe.',
            'reseller_name.max'  => 'O texto precisa conter menos que 30 caracteres.',
            'reseller_site.unique'  => 'Este site já existe.',
            'reseller_site.max'  => 'O texto precisa conter menos que 50 caracteres.',
            'reseller_email.unique'  => 'Este email já existe.',
            'reseller_email.email'  => 'O email informado não é um email válido.',
            'reseller_email.max'  => 'O email precisa conter menos que 255 caracteres.',
        ];
     return Validator::make($data, $rules, $messages);
    }

    protected function create(array $data)
{
           return Reseller::create([
            'reseller_name' => $data['reseller_name'], 
            'reseller_site' => $data['reseller_site'], 
            'reseller_email' => $data['reseller_email'], 
        ]);
    }

    public function showResellerEditForm($id)
    {

        $data = DB::table('resellers')
        ->where('resellers.id', '=', $id)
        ->select('resellers.*')->get();

        return view ( 'stocks.resellers.edit-reseller')->with(compact('data'));;
    }

    public function editreseller(Request $request)
    {
       //Validar data
        $this->validatorEdit(Request::all())->validate();
       //Criar servidor no banco de dados
        $data = $this->edit(Request::all());
       return redirect('/resellers');
    }

    protected function validatorEdit(array $data)
    {
        $rules = [
            'reseller_name' => 'max:30',
            'reseller_site' => 'max:50',
            'reseller_email' => 'email|max:255',
        ];
    
        $messages = [
            'reseller_name.max'  => 'O texto precisa conter menos que 30 caracteres.',
            'reseller_site.max'  => 'O texto precisa conter menos que 50 caracteres.',
            'reseller_email.email'  => 'O email informado não é um email válido.',
            'reseller_email.max'  => 'O email precisa conter menos que 255 caracteres.',
        ];
     return Validator::make($data, $rules, $messages);
    }

    public function edit()
    {
    $data = Request::all();
    $edit = Reseller::where('id',$data['id'])->first();
    $edit->reseller_name=$data['reseller_name'];
    $edit->reseller_site=$data['reseller_site'];
    $edit->reseller_email=$data['reseller_email'];
    $edit->save();

    return Redirect::back();
    }
}
