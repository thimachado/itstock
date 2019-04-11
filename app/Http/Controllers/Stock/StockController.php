<?php
namespace App\Http\Controllers\Stock;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Stock;
use DB;
class StockController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }
    public function showStockForm() {
        $databrand = Brand::all();
        $datacategory = Category::all();
        $data = DB::table('products')->join('categories', 'categories.id', '=', 'products.category_id')->join('brands', 'brands.id', '=', 'products.brand_id')->select('products.*', 'brands.brand_name', 'categories.category_name')->get();
        $stock = DB::table('stocks')->join('categories', 'categories.id', '=', 'stocks.category_id')->join('brands', 'brands.id', '=', 'stocks.brand_id')->join('products', 'products.id', '=', 'stocks.product_id')->select('stocks.*', 'products.product_model', 'brands.brand_name', 'categories.category_name')->get();
        return view('stocks.stocks.stocks')->with(compact('data', 'stock', 'databrand', 'datacategory'));
    }
    public function getBrands($idcat) {
        $products = DB::table("products")->join('categories', 'categories.id', '=', 'products.category_id')->join('brands', 'brands.id', '=', 'products.brand_id')->where("category_id", $idcat)->pluck("brands.brand_name", "brands.id");
        return json_encode($products);
    }
    public function getProducts($idcat, $idbrand) {
        $products = DB::table("products")->join('categories', 'categories.id', '=', 'products.category_id')->join('brands', 'brands.id', '=', 'products.brand_id')->where("category_id", $idcat)->where("brand_id", $idbrand)->pluck("product_model", "products.id");
        return json_encode($products);
    }
    public function register(Request $request) {
        //Validar data
        //dd(Request::all());
        $this->validator(Request::all())->validate();
        $data = $this->create(Request::all());
        return Redirect::back();
    }
    protected function validator(array $data) {
        return Validator::make($data, ['stock_quantity' => 'required|integer|max:255', 'category_id' => 'required', 'brand_id' => 'required', 'product_model' => 'required', ]);
    }
    protected function create(array $data) {
        return Stock::create(['category_id' => $data['category_id'], 'brand_id' => $data['brand_id'], 'product_id' => $data['product_model'], 'stock_quantity' => $data['stock_quantity'], ]);
    }
    public function delete($id) {
        $dele = Stock::where('id', $id)->delete();
        return Redirect::back();
    }
    public function showStockEditForm($id) {
        $stock = DB::table('stocks')->join('categories', 'categories.id', '=', 'stocks.category_id')->join('brands', 'brands.id', '=', 'stocks.brand_id')->join('products', 'products.id', '=', 'stocks.product_id')->where('stocks.id', '=', $id)->select('stocks.*', 'products.product_model', 'brands.brand_name', 'categories.category_name')->get();
        return view('stocks.stocks.edit-stock')->with(compact('stock'));
    }
    public function editstock(Request $request) {
        //Validar data
        $this->validatorEdit(Request::all())->validate();
        //Criar servidor no banco de dados
        $data = $this->edit(Request::all());
        return redirect('/stock');
    }
    protected function validatorEdit(array $data) {
        return Validator::make($data, ['category_id' => 'required', 'brand_id' => 'required', 'product_model' => 'required', 'stock_quantity' => 'required|integer', ]);
    }
    public function edit() {
        $data = Request::all();
        $edit = Stock::where('id', $data['id'])->first();
        $edit->product_id = $data['product_model'];
        $edit->brand_id = $data['brand_id'];
        $edit->category_id = $data['category_id'];
        $edit->stock_quantity = $data['stock_quantity'];
        $edit->save();
        return Redirect::back();
    }
}
