<?php
namespace App\Http\Controllers\Stock;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use DB;
class ProductController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }
    public function showProductForm() {
        $databrand = Brand::all();
        $datacategory = Category::all();
        $data = DB::table('products')->join('categories', 'categories.id', '=', 'products.category_id')->join('brands', 'brands.id', '=', 'products.brand_id')->select('products.*', 'brands.brand_name', 'categories.category_name')->get();
        return view('stocks.products.products')->with(compact('data', 'databrand', 'datacategory'));
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
            'product_model' => 'max:30|unique:products',
        ];
    
        $messages = [
            'product_model.unique'  => 'Este produto já existe.',
            'product_model.max'  => 'O texto precisa conter menos que 30 caracteres.',
        ];
     return Validator::make($data, $rules, $messages);


    }
    protected function create(array $data) {
        return Product::create(['product_model' => $data['product_model'], 'category_id' => $data['category_id'], 'brand_id' => $data['brand_id'], ]);
    }
    public function showProductEditForm($id) {
        $databrand = Brand::all();
        $datacategory = Category::all();
        $data = DB::table('products')->join('categories', 'categories.id', '=', 'products.category_id')->join('brands', 'brands.id', '=', 'products.brand_id')->where('products.id', '=', $id)->select('products.*', 'brands.brand_name', 'categories.category_name')->get();
        return view('stocks.products.edit-product')->with(compact('data', 'databrand', 'datacategory'));
    }
    public function editproduct(Request $request) {
        //Validar data
        $this->validatorEdit(Request::all())->validate();
        //Criar servidor no banco de dados
        $data = $this->edit(Request::all());
        return redirect('/products');
    }
    protected function validatorEdit(array $data) {
        $rules = [
            'product_model' => 'max:30',
        ];
    
        $messages = [
            'product_model.max'  => 'O texto precisa conter menos que 30 caracteres.',
        ];
     return Validator::make($data, $rules, $messages);
    }
    public function edit() {
        $data = Request::all();
        $edit = Product::where('id', $data['id'])->first();
        $edit->product_model = $data['product_model'];
        $edit->brand_id = $data['brand_id'];
        $edit->category_id = $data['category_id'];
        $edit->save();
        return Redirect::back();
    }
}
