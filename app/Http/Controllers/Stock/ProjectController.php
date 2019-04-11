<?php
namespace App\Http\Controllers\Stock;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Request;
use App\Http\Controllers\Controller;
use App\Models\Project;
use DB;
class ProjectController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }
    public function showProjectForm() {
        $data = Project::all();
        //dd($data);
        return view('stocks.projects.projects')->with(compact('data'));
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
            'project_cod' => 'max:5|unique:projects', 
            'project_name' => 'max:30|unique:projects', 
        ];
    
        $messages = [
            'project_cod.unique' => 'Este código já existe.',
            'project_cod.max'  => 'O código precisa conter no máximo 5 caracteres.',
            'project_name.unique' => 'Este projeto já existe.',
            'project_name.max'  => 'O texto precisa conter no máximo 30 caracteres.',
        ];
     return Validator::make($data, $rules, $messages);
    }
    protected function create(array $data) {
        return Project::create(['project_cod' => $data['project_cod'], 'project_name' => $data['project_name'], ]);
    }
    public function showProjectEditForm($id) {
        $data = DB::table('projects')->where('projects.id', '=', $id)->select('projects.*')->get();
        return view('stocks.projects.edit-project')->with(compact('data'));;
    }
    public function editproject(Request $request) {
        //Validar data
        $this->validatorEdit(Request::all())->validate();
        //Criar servidor no banco de dados
        $data = $this->edit(Request::all());
        return redirect('/projects');
    }
    protected function validatorEdit(array $data) {
        $rules = [
            'project_cod' => 'max:5', 
            'project_name' => 'max:30', 
        ];
    
        $messages = [
            'project_cod.max'  => 'O código precisa conter no máximo 5 caracteres.',
            'project_name.max'  => 'O texto precisa conter no máximo 30 caracteres.',
        ];
     return Validator::make($data, $rules, $messages);
    }
    public function edit() {
        $data = Request::all();
        $edit = Project::where('id', $data['id'])->first();
        $edit->project_cod = $data['project_cod'];
        $edit->project_name = $data['project_name'];
        $edit->save();
        return Redirect::back();
    }
}
