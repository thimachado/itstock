<?php

namespace App\Http\Controllers\Stock;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Models\ContractCategory;
use Request;
use DB;
class ContractCategoryController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    public function showCategoryForm() {
        $data = ContractCategory::all();
        return view('stocks.categories.contractcategories')->with(compact('data'));
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
            'category_name' => 'max:30|unique:contractcategories'
        ];
        $messages = [
            'category_name.unique'  => 'Esta categoria já existe.',
            'category_name.max'  => 'O texto precisa conter menos que 30 caracteres.'
        ];
        return Validator::make($data, $rules, $messages);
    }
    protected function create(array $data) {
        return ContractCategory::create(['category_name' => $data['category_name'], ]);
    }

    public function showCategoryEditForm($id) {
        $data = DB::table('contractcategories')->where('contractcategories.id', '=', $id)->select('contractcategories.*')->get();
        return view('stocks.categories.edit-contractcategory')->with(compact('data'));;
    }
    public function editCategory(Request $request) {
        //Validar data
        $this->validatorEdit(Request::all())->validate();
        //Criar servidor no banco de dados
        $data = $this->edit(Request::all());
        return redirect('/contractcategories');
    }
    protected function validatorEdit(array $data) {
        $rules = [
            'category_name' => 'max:30|unique:contractcategories'
        ];
        $messages = [
            'category_name.unique'  => 'Esta categoria já existe.',
            'category_name.max'  => 'O texto precisa conter menos que 30 caracteres.'
        ];
        return Validator::make($data, $rules, $messages);
    }
    public function edit() {
        $data = Request::all();
        $edit = ContractCategory::where('id', $data['id'])->first();
        $edit->category_name = $data['category_name'];
        $edit->save();
        return Redirect::back();
    }
}
