<?php
namespace App\Http\Controllers\Stock;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use DB;
class BrandController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }
    public function showBrandForm() {
        $data = Brand::all();
        //die($data);
        return view('stocks.brands.brands')->with(compact('data'));
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
            'brand_name' => 'required|max:30|unique:brands'
        ];
    
        $messages = [
            'brand_name.unique'  => 'Esta marca já existe.',
            'brand_name.max'  => 'O texto precisa conter menos que 30 caracteres.',
        ];
        return Validator::make($data, $rules, $messages);
    }
    protected function create(array $data) {
        return Brand::create(['brand_name' => $data['brand_name'], ]);
    }
    public function showBrandEditForm($id) {
        $data = DB::table('brands')->where('brands.id', '=', $id)->select('brands.*')->get();
        return view('stocks.brands.edit-brand')->with(compact('data'));;
    }
    public function editBrand(Request $request) {
        //Validar data
        $this->validatorEdit(Request::all())->validate();
        //Criar servidor no banco de dados
        $data = $this->edit(Request::all());
        return redirect('/brands');
    }
    protected function validatorEdit(array $data) {

        $rules = [
            'brand_name' => 'max:30'
        ];
        $messages = [
            'brand_name.max'  => 'O texto precisa conter menos que 30 caracteres.',
        ];
      
        return Validator::make($data, $rules, $messages);
    }
    public function edit() {
        $data = Request::all();
        $edit = Brand::where('id', $data['id'])->first();
        $edit->brand_name = $data['brand_name'];
        $edit->save();
        return Redirect::back();
    }
}
