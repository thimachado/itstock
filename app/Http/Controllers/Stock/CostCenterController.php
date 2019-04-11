<?php
namespace App\Http\Controllers\Stock;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Request;
use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\ClientGroup;
use App\Models\ResultCenter;
use App\Models\Project;
use App\Models\Area;
use App\Models\CostCenter;
use App\Models\Vertical;
use DB;
class CostCenterController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }
    public function showCostCenterForm() {
        $databusiness = Business::all();
        $dataclientgroup = ClientGroup::all();
        $dataresultcenter = ResultCenter::all();
        $dataproject = Project::all();
        $dataarea = Area::all();
        $datavertical = Vertical::all();
        $data = DB::table('costcenters')->join('business', 'business.id', '=', 'costcenters.business_id')->join('clientgroups', 'clientgroups.id', '=', 'costcenters.clientgroup_id')->join('resultcenters', 'resultcenters.id', '=', 'costcenters.resultcenter_id')->join('projects', 'projects.id', '=', 'costcenters.project_id')->join('areas', 'areas.id', '=', 'costcenters.area_id')->join('verticals', 'verticals.id', '=', 'costcenters.vertical_id')->select('costcenters.*', 'business.business_name', 'clientgroups.clientgroup_name', 'resultcenters.resultcenter_name', 'projects.project_name', 'projects.project_cod', 'verticals.vertical_name', 'areas.area_name')->get();
        return view('stocks.costcenters.costcenter')->with(compact('data', 'databusiness', 'dataclientgroup', 'dataresultcenter', 'dataproject', 'dataarea', 'datavertical'));
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
         'costcenter_cod' => 'required|max:5|unique:costcenters', 
         'costcenter_description' => 'required|max:50|unique:costcenters',
         'costcenter_ccowner' => 'required|string|max:30', 
         'business_id' => 'required', 
         'costcenter_businessowner' => 'required|string|max:30', 
         'clientgroup_id' => 'required', 
         'resultcenter_id' => 'required', 
         'area_id' => 'required', 
         'project_id' => 'required', 
         'vertical_id' => 'required', 
        ];
        $messages = [
            'required'=>'Este campo é obrigatório.',
            'string'=> 'Este campo deve ser do tipo texto.',
            'costcenter_cod.unique'  => 'Esta código já existe.',
            'costcenter_cod.max'  => 'O código precisa conter no máximo 5 caracteres.',
            'costcenter_description.unique'  => 'Esta descrição já existe.',
            'costcenter_description.max'  => 'A descrição precisa conter no máximo 50 caracteres.',
            'costcenter_ccowner.max'  => 'Este campo precisa conter no máximo 30 caracteres.',
            'costcenter_businessowner.max'  => 'Este campo precisa conter no máximo 30 caracteres.'
        ];

        return Validator::make($data, $rules, $messages);
    }
    protected function create(array $data) {
        return CostCenter::create(['costcenter_cod' => $data['costcenter_cod'], 'costcenter_description' => $data['costcenter_description'], 'costcenter_ccowner' => $data['costcenter_ccowner'], 'business_id' => $data['business_id'], 'costcenter_businessowner' => $data['costcenter_businessowner'], 'clientgroup_id' => $data['clientgroup_id'], 'resultcenter_id' => $data['resultcenter_id'], 'area_id' => $data['area_id'], 'project_id' => $data['project_id'], 'vertical_id' => $data['vertical_id'], ]);
    }
    public function showCostCenterEditForm($id) {
        $databusiness = Business::all();
        $dataclientgroup = ClientGroup::all();
        $dataresultcenter = ResultCenter::all();
        $dataproject = Project::all();
        $dataarea = Area::all();
        $datavertical = Vertical::all();
        $data = DB::table('costcenters')->join('business', 'business.id', '=', 'costcenters.business_id')->join('clientgroups', 'clientgroups.id', '=', 'costcenters.clientgroup_id')->join('resultcenters', 'resultcenters.id', '=', 'costcenters.resultcenter_id')->join('projects', 'projects.id', '=', 'costcenters.project_id')->join('areas', 'areas.id', '=', 'costcenters.area_id')->join('verticals', 'verticals.id', '=', 'costcenters.vertical_id')->where('costcenters.id', $id)->select('costcenters.*', 'business.business_name', 'clientgroups.clientgroup_name', 'resultcenters.resultcenter_name', 'projects.project_name', 'projects.project_cod', 'verticals.vertical_name', 'areas.area_name')->get();
        return view('stocks.costcenters.edit-costcenter')->with(compact('data', 'databusiness', 'dataclientgroup', 'dataresultcenter', 'dataproject', 'dataarea', 'datavertical'));
    }
    public function editcostcenter(Request $request) {
        //Validar data
        $this->validatorEdit(Request::all())->validate();
        //Criar servidor no banco de dados
        $data = $this->edit(Request::all());
        return redirect('/costcenter');
    }
    protected function validatorEdit(array $data) {
        $rules = [
            'costcenter_cod' => 'required|max:5', 
            'costcenter_description' => 'required|string|max:50',
            'costcenter_ccowner' => 'required|string|max:30', 
            'business_id' => 'required', 
            'costcenter_businessowner' => 'required|string|max:30', 
            'clientgroup_id' => 'required', 
            'resultcenter_id' => 'required', 
            'area_id' => 'required', 
            'project_id' => 'required', 
            'vertical_id' => 'required', 
           ];
           $messages = [
               'required'=>'Este campo é obrigatório.',
               'string'=> 'Este campo deve ser do tipo texto.',
               'costcenter_cod.max'  => 'O código precisa conter no máximo 5 caracteres.',
               'costcenter_description.max'  => 'A descrição precisa conter no máximo 50 caracteres.',
               'costcenter_ccowner.max'  => 'Este campo precisa conter no máximo 30 caracteres.',
               'costcenter_businessowner.max'  => 'Este campo precisa conter no máximo 30 caracteres.'
           ];
   
           return Validator::make($data, $rules, $messages);
    }
    public function edit() {
        $data = Request::all();
        $edit = CostCenter::where('id', $data['id'])->first();
        $edit->costcenter_cod = $data['costcenter_cod'];
        $edit->costcenter_description = $data['costcenter_description'];
        $edit->costcenter_ccowner = $data['costcenter_ccowner'];
        $edit->business_id = $data['business_id'];
        $edit->costcenter_businessowner = $data['costcenter_businessowner'];
        $edit->clientgroup_id = $data['clientgroup_id'];
        $edit->resultcenter_id = $data['resultcenter_id'];
        $edit->area_id = $data['area_id'];
        $edit->project_id = $data['project_id'];
        $edit->vertical_id = $data['vertical_id'];
        $edit->save();
        return Redirect::back();
    }
}
