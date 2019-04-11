<?php

namespace App\Http\Controllers\Stock;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Models\ContractCategory;
use App\Models\IndexReadjust;
use App\Models\Attachment;
use App\Models\Contract;
use App\Models\Reseller;
use App\Models\Area;
use Carbon\Carbon;
use Request;
use DB;
class ContractController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function showContractForm() {
        $dataarea = Area::all();
        $datareseller = Reseller::all();
        $datacategory = ContractCategory::all();
        $dataindex = IndexReadjust::all();
    return view('stocks.contracts.contract')->with(compact('datacategory','datareseller','dataarea','dataindex'));
    }
    public function register(Request $request) {

        //Validar data
        $this->validator(Request::all())->validate();
        //Criar servidor no banco de dados
        $this->create(Request::all());
    return redirect('/contractlist');
    }

    protected function validator(array $data) {

        $rules = [
            'reseller_id' => 'required',
            'contract_number' => 'required|string|max:30|unique:contracts',
            'contract_title' => 'required|string|max:50|unique:contracts',
            'contractcategory_id' => 'required',
            'contract_type' => 'required',
            'contract_startdate' => 'required|date|before_or_equal:contract_expirationdate',
            'contract_expirationdate' => 'required|date|after_or_equal:contract_startdate',
            'contract_warningdate' => 'required|date|before_or_equal:contract_expirationdate|after_or_equal:contract_startdate',
            'contract_paytype' => 'required',
            'contract_totalvalue' => 'required|numeric',
            'contract_qtdparcelas' => 'required|numeric',
            'contract_ultimaparcela' => 'required|date',
            'contract_objectdescription' => 'required|string',
            'contract_releasedescription' => 'required|string',
            'contract_area' => 'required|string',
            'contract_status' => 'required',
            'index_id' => 'required|numeric',
            'contract_indexpercentage' => 'required|numeric',
            'contract_anualreadjust' => 'required|string',
        ];

        $messages = [
            'required'=>'Este campo é obrigatório.',
            'string'=> 'Este campo deve ser do tipo texto.',
            'numeric'=> 'Este campo aceita apenas numerais.',
            'min'=>'O valor inserido precisa de ao menos um caractere.',
            'date'=> 'Este campo deve ser do tipo data.',
            'contract_number.max'=>'O Nr.Contrato deve conter no máximo 30 caracteres.',
            'contract_number.unique'=>'Este Nr.Contrato já existe.',
            'contract_internal.max'=>'O Nr.Interno deve conter no máximo 15 caracteres.',
            'contract_internal.unique'=>'Este Nr.Interno já existe.',
            'contract_title.max'=>'O Nr.Interno deve conter no máximo 50 caracteres.',
            'contract_title.unique'=>'Este título já existe.',
            'contract_startdate.before_or_equal'  => 'A data de início precisa ser anterior ou igual a data de expiração.',
            'contract_expirationdate.after_or_equal'  => 'A data de expiração precisa ser posterior ou igual a data de início.',
            'contract_warningdate.before_or_equal'  => 'A data de aviso prévio precisa ser entre a data de início e a data de expiração.',
            'contract_warningdate.after_or_equal'  => 'A data de aviso prévio precisa ser entre a data de início e a data de expiração.',
            ];

    return Validator::make($data, $rules, $messages);
        }

    protected function create(array $data) {

        $date = Carbon::parse($data['contract_expirationdate']);
        //dd($date);
        Contract::create([
            'reseller_id' => $data['reseller_id'],
            'contract_number' => $data['contract_number'],
            'contract_internal' =>$data['contract_internal'],
            'contract_title' => $data['contract_title'],
            'contractcategory_id' =>  $data['contractcategory_id'],
            'contract_type' => $data['contract_type'],
            'contract_startdate' => $data['contract_startdate'],
            'contract_expirationdate' => $data['contract_expirationdate'],
            'contract_warningdate' =>  $data['contract_warningdate'],
            'contract_paytype' =>  $data['contract_paytype'],
            'contract_totalvalue' =>  $data['contract_totalvalue'],
            'contract_qtdparcelas' => $data['contract_qtdparcelas'],
            'contract_ultimaparcela' => $data['contract_ultimaparcela'],
            'contract_objectdescription' =>$data['contract_objectdescription'],
            'contract_releasedescription' =>$data['contract_releasedescription'],
            'contract_area' => $data['contract_area'],
            'index_id' => $data['index_id'],
            'contract_status' => $data['contract_status'],
            'contract_indexpercentage' =>  $data['contract_indexpercentage'],
            'contract_anualreadjust' =>  $data['contract_anualreadjust'],
            'expirated_at' => $date,
        ]);

        $lastinsert = DB::table("contracts")
        ->orderBy('id', 'desc')
        ->select('contracts.id')->first();

        if(Request::hasFile('attachments')) {
            $file = Request::file('attachments');
            $length= count($file);
        for ($i = 0; $i < $length; $i++) {
            $filename = $file[$i]->getClientOriginalName();
            $exists = Storage::exists('public/contracts/'.$filename);

         if($exists == true){
            $filename = rand(0, 999).'-'.$filename;
         }

            Attachment::create([
                'attachment_name' => $filename,
                'attachment_path' => '/storage/contracts',
                'contract_id' => $lastinsert->id,
            ]);

            $file[$i]->storeAs('public/contracts',  $filename);
        }
    }
    return;
    }

    public function showListContract() {
        $lastcontract = DB::table('contracts')
        ->join('resellers', 'resellers.id', '=', 'contracts.reseller_id')
        ->orderby('contracts.updated_at', 'desc')
        ->select('contracts.*','resellers.reseller_name')->first();
        $data = DB::table('contracts')
        ->join('resellers', 'resellers.id', '=', 'contracts.reseller_id')
        ->orderby('contracts.id', 'desc')
        ->select('contracts.*','resellers.reseller_name')->get();
    return view('stocks.contracts.list-contract')->with(compact('lastcontract', 'data'));
    }

    public function showContractEditForm($id) {
        $dataarea = Area::all();
        $datareseller = Reseller::all();
        $datacategory = ContractCategory::all();
        $dataindex = IndexReadjust::all();
        $data = DB::table('contracts')
        ->join('resellers', 'resellers.id', '=', 'contracts.reseller_id')
        ->join('contractcategories', 'contractcategories.id', '=', 'contracts.contractcategory_id')
        ->join('indexreadjustments', 'indexreadjustments.id', '=', 'contracts.index_id')
        ->where('contracts.id', '=', $id)
        ->select('contracts.*','resellers.reseller_name','contractcategories.category_name', 'indexreadjustments.index_name')->get();

        $attachments = DB::table('attachments')
        ->where('attachments.contract_id', '=', $id)
        ->select('attachments.*')->get();
    return view('stocks.contracts.edit-contract')->with(compact('data', 'datacategory','datareseller','dataarea','dataindex','attachments'));
    }

    public function editcontract(Request $request) {
       $this->validatorEdit(Request::all())->validate();
        //Criar servidor no banco de dados
        $data = $this->edit(Request::all());
        return redirect('/contractlist');
    }

    public function deletecontract($id,$name) {
        $name = "public/contracts/$name";
        $delete = Attachment::where('id', $id)->delete();
        Storage::delete($name);
    return response(['id'=>$id]);
    }

    protected function validatorEdit(array $data) {
        $rules = [
            'reseller_id' => 'required',
            'contract_number' => 'required|string|max:30',
            'contract_title' => 'required|string|max:50',
            'contractcategory_id' => 'required',
            'contract_type' => 'required',
            'contract_startdate' => 'required|date|before_or_equal:contract_expirationdate',
            'contract_expirationdate' => 'required|date|after_or_equal:contract_startdate',
            'contract_warningdate' => 'required|date|before_or_equal:contract_expirationdate|after_or_equal:contract_startdate',
            'contract_paytype' => 'required',
            'contract_totalvalue' => 'required|numeric',
            'contract_qtdparcelas' => 'required|numeric',
            'contract_ultimaparcela' => 'required|date',
            'contract_objectdescription' => 'required|string',
            'contract_releasedescription' => 'required|string',
            'contract_area' => 'required|string',
            'index_id' => 'required|numeric',
            'contract_indexpercentage' => 'required|numeric',
            'contract_anualreadjust' => 'required|string',
            'contract_status' => 'required'
        ];

        $messages = [
            'required'=>'Este campo é obrigatório.',
            'string'=> 'Este campo deve ser do tipo texto.',
            'numeric'=> 'Este campo aceita apenas numerais.',
            'min'=>'O valor inserido precisa de ao menos um caractere.',
            'date'=> 'Este campo deve ser do tipo data.',
            'contract_number.max'=>'O Nr.Contrato deve conter no máximo 30 caracteres.',
            'contract_internal.max'=>'O Nr.Interno deve conter no máximo 15 caracteres.',
            'contract_title.max'=>'O Nr.Interno deve conter no máximo 50 caracteres.',
            'contract_startdate.before_or_equal'  => 'A data de início precisa ser anterior ou igual a data de expiração.',
            'contract_expirationdate.after_or_equal'  => 'A data de expiração precisa ser posterior ou igual a data de início.',
            'contract_warningdate.before_or_equal'  => 'A data de aviso prévio precisa ser entre a data de início e a data de expiração.',
            'contract_warningdate.after_or_equal'  => 'A data de aviso prévio precisa ser entre a data de início e a data de expiração.',
            ];

            return Validator::make($data, $rules, $messages);


        }

        public function edit() {
            $data = Request::all();
            $date = Carbon::parse($data['contract_expirationdate']);
           // dd($date);
            $edit = Contract::where('id', $data['id'])->first();
            $edit->reseller_id = $data['reseller_id'];
            $edit->contract_number = $data['contract_number'];
            $edit->contract_internal = $data['contract_internal'];
            $edit->contract_title = $data['contract_title'];
            $edit->contractcategory_id = $data['contractcategory_id'];
            $edit->contract_type = $data['contract_type'];
            $edit->contract_startdate = $data['contract_startdate'];
            $edit->contract_expirationdate = $data['contract_expirationdate'];
            $edit->contract_warningdate = $data['contract_warningdate'];
            $edit->contract_paytype = $data['contract_paytype'];
            $edit->contract_totalvalue = $data['contract_totalvalue'];
            $edit->contract_qtdparcelas = $data['contract_qtdparcelas'];
            $edit->contract_ultimaparcela = $data['contract_ultimaparcela'];
            $edit->contract_area = $data['contract_area'];
            $edit->index_id = $data['index_id'];
            $edit->contract_indexpercentage = $data['contract_indexpercentage'];
            $edit->contract_anualreadjust = $data['contract_anualreadjust'];
            $edit->contract_objectdescription = $data['contract_objectdescription'];
            $edit->contract_releasedescription = $data['contract_releasedescription'];
            $edit->contract_status = $data['contract_status'];
            $edit->expirated_at = $date;
            $edit->save();
            if(Request::hasFile('attachments')) {
            $file = Request::file('attachments');
            $length= count($file);
        for ($i = 0; $i < $length; $i++) {
            $filename = $file[$i]->getClientOriginalName();
            $exists = Storage::exists('public/contracts/'.$filename);

         if($exists == true){
            $filename = rand(0, 999).'-'.$filename;
         }

            Attachment::create([
                'attachment_name' => $filename,
                'attachment_path' => '/storage/contracts',
                'contract_id' =>$data['id'],
            ]);

            $file[$i]->storeAs('public/contracts',  $filename);
        }
    }
            return Redirect::back();
        }

        public function showContractModal($id) {

            $data = DB::table('contracts')
            ->join('resellers', 'resellers.id', '=', 'contracts.reseller_id')
            ->join('contractcategories', 'contractcategories.id', '=', 'contracts.contractcategory_id')
            ->join('indexreadjustments', 'indexreadjustments.id', '=', 'contracts.index_id')
            ->where('contracts.id', '=', $id)
            ->select('contracts.*','resellers.reseller_name','contractcategories.category_name', 'indexreadjustments.index_name')->get();

            $attachments = DB::table('attachments')
            ->where('attachments.contract_id', '=', $id)
            ->select('attachments.*')->get();

            return view('stocks.contracts.show-contract')->with(compact('data','attachments'));
        }



}
