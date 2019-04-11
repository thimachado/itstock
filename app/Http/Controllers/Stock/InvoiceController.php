<?php
namespace App\Http\Controllers\Stock;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Request;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Inventory;
use App\Models\Reseller;
use App\Models\Area;
use App\Models\Project;
use App\Models\CostCenter;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Deposit;
use App\Models\Category;
use App\Models\Stock;
use DB;
class InvoiceController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }
    public function showInvoiceForm() {
        $datareseller = Reseller::all();
        $dataarea = Area::all();
        $datacategory = Category::all();
        $databrand = Brand::all();
        $datadeposit = Deposit::all();
        $datacostcenter = DB::table('costcenters')->join('projects', 'projects.id', '=', 'costcenters.project_id')->select('costcenters.*', 'projects.project_cod', 'projects.project_name')->get();
        return view('stocks.invoices.invoice')->with(compact('datareseller', 'dataarea', 'datacostcenter', 'datacategory', 'databrand', 'datadeposit'));;
    }
    public function getProjects($id) {
        $projects = DB::table("costcenters")->join('projects', 'projects.id', '=', 'costcenters.project_id')->where('costcenters.id', $id)->pluck("projects.project_name", "projects.id");
        return json_encode($projects);
    }
    public function getAreas($id) {
        $projects = DB::table("costcenters")->join('areas', 'areas.id', '=', 'costcenters.area_id')->where('costcenters.id', $id)->pluck("areas.area_name", "areas.id");
        return json_encode($projects);
    }
    public function register(Request $request) {
        //Validar data
        $this->validator(Request::all())->validate();
        $this->create(Request::all(), Request::input('category_id'), Request::input('brand_id'), Request::input('product_id'), Request::input('itemvalue'), Request::input('quantity'));
        return redirect('/invoicelist');
    }
    protected function validator(array $data) {

        $rules = [
        'invoice_type' => 'required',
        'invoice_typemov' => 'required',
        'invoice_number' => 'required',
        'reseller_id' => 'required', 
        'area_id' => 'required',
        'project_id' => 'required', 
        'deposit_id' => 'required|numeric', 
        'costcenter_id' => 'required',
        'invoice_owner' => 'required|string',
        'invoice_ctafin' => 'required|string', 
        'invoice_ctacon' => 'required|string', 
        'invoice_billingdate' => 'required|date|before:invoice_duedate', 
        'invoice_duedate' => 'required|date|after_or_equal:invoice_billingdate',
        'category_id.*' => 'required|numeric',
        'brand_id.*' => 'required|numeric', 
        'product_id.*' => 'required|numeric', 
        'itemvalue.*' => 'required|numeric|min:1', 
        'quantity.*' => 'required|numeric|min:1',
        ];
        $messages = [
            'required'=>'Este campo é obrigatório.',
            'string'=> 'Este campo deve ser do tipo texto.',
            'itemvalue.*.numeric'=> 'O campo valor unitário aceita apenas numerais.',
            'quantity.*.numeric'=> 'O campo quantidade aceita apenas numerais.',
            'min'=>'O valor inserido precisa de ao menos um caractere.',
            'date'=> 'Este campo deve ser do tipo data.',
            'invoice_billingdate.before'  => 'A data de faturamento precisa ser anterior a data de vencimento.',
            'invoice_duedate.after_or_equal'  => 'A data de vencimento precisa ser posterior ou igual a data de faturamento.',
        ];
        return Validator::make($data, $rules, $messages);

    }
    protected function create(array $data, array $categories, array $brands, array $products, array $itemval, array $quantity) {
        $length = count($categories);
        foreach ($categories as $value) {
            $category[] = $value;
        }
        foreach ($brands as $value) {
            $brand[] = $value;
        }
        foreach ($products as $value) {
            $product[] = $value;
        }
        foreach ($itemval as $value) {
            $item[] = $value;
        }
        foreach ($quantity as $value) {
            $qtd[] = $value;
        }
        for ($i = 0;$i < $length;$i++) {
            Invoice::create(['invoice_type' => $data['invoice_type'], 'invoice_typemov' => $data['invoice_typemov'], 'invoice_number' => $data['invoice_number'], 'reseller_id' => $data['reseller_id'], 'area_id' => $data['area_id'], 'project_id' => $data['project_id'], 'deposit_id' => $data['deposit_id'], 'costcenter_id' => $data['costcenter_id'], 'invoice_owner' => $data['invoice_owner'], 'invoice_ctafin' => $data['invoice_ctafin'], 'invoice_ctacon' => $data['invoice_ctacon'], 'invoice_billingdate' => $data['invoice_billingdate'], 'invoice_duedate' => $data['invoice_duedate'], 'category_id' => (int)$category[$i], 'brand_id' => (int)$brand[$i], 'product_id' => (int)$product[$i], 'invoice_itemvalue' => (float)$item[$i], 'invoice_itemquantity' => (int)$qtd[$i]]);
            Inventory::create(['category_id' => (int)$category[$i], 'brand_id' => (int)$brand[$i], 'product_id' => (int)$product[$i], 'costcenter_id' => $data['costcenter_id'], 'invoice_number' => $data['invoice_number'], 'inventory_itemvalue' => (float)$item[$i], 'inventory_itemquantity' => (int)$qtd[$i], 'inventory_typemov' => $data['invoice_type'], 'deposit_id' => $data['deposit_id']]);
            $price[] = DB::table("inventories")->where('inventories.product_id', (int)$product[$i])->avg('inventory_itemvalue');
            if (Stock::where('product_id', '=', (int)$product[$i])->count() > 0) {
                $edit = Stock::where('product_id', (int)$product[$i])->first();
                $edit->stock_quantity = ($edit->stock_quantity + (int)$qtd[$i]);
                $edit->stock_avgprice = (int)$price[$i];
                $edit->save();
            } else {
                Stock::create(['category_id' => (int)$category[$i], 'brand_id' => (int)$brand[$i], 'product_id' => (int)$product[$i], 'stock_quantity' => (int)$qtd[$i], 'stock_avgprice' => (int)$price[$i], ]);
            }
        }
        return;
    }
    public function showListInvoice() {
        $lastinvoice = DB::table('invoices'
        )->join('resellers', 'resellers.id', '=', 'invoices.reseller_id')
        ->join('costcenters', 'costcenters.id', '=', 'invoices.costcenter_id')->join('projects', 'projects.id', '=', 'invoices.project_id')->join('areas', 'areas.id', '=', 'invoices.area_id')->where('invoices.invoice_type', '=', 'E')->orderby('invoices.id', 'desc')->select('invoices.invoice_number', 'invoices.invoice_owner', 'invoices.invoice_billingdate', 'invoices.invoice_duedate', 'resellers.reseller_name', 'costcenters.*', 'projects.*', 'areas.*')->first();
        $data = DB::table('invoices')->join('resellers', 'resellers.id', '=', 'invoices.reseller_id')
        ->join('costcenters', 'costcenters.id', '=', 'invoices.costcenter_id')
        ->join('projects', 'projects.id', '=', 'invoices.project_id')->join('areas', 'areas.id', '=', 'invoices.area_id')
        ->where('invoices.invoice_type', '=', 'E')
        ->select('invoices.invoice_number', 'invoices.invoice_owner', 'invoices.invoice_billingdate', 'invoices.invoice_duedate', 'resellers.reseller_name', 'costcenters.*', 'projects.*', 'areas.*')->distinct()->get();
        return view('stocks.invoices.list-invoice')->with(compact('lastinvoice', 'data'));
    }
    public function showInvoiceEditForm($id) {
        $datareseller = Reseller::all();
        $dataarea = Area::all();
        $dataproject = Project::all();
        $datacostcenter = CostCenter::all();
        $datacategory = Category::all();
        $databrand = Brand::all();
        $datadeposit = Deposit::all();
        $data = DB::table('invoices')->join('resellers', 'resellers.id', '=', 'invoices.reseller_id')->join('costcenters', 'costcenters.id', '=', 'invoices.costcenter_id')->join('projects', 'projects.id', '=', 'invoices.project_id')->join('areas', 'areas.id', '=', 'invoices.area_id')->join('deposits', 'deposits.id', '=', 'invoices.deposit_id')->where('invoices.invoice_number', '=', $id)->select('invoices.invoice_number', 'invoices.invoice_typemov', 'invoices.invoice_owner', 'invoices.invoice_ctafin', 'invoices.invoice_ctacon', 'invoices.invoice_billingdate', 'invoices.invoice_duedate', 'reseller_id', 'invoices.area_id', 'invoices.costcenter_id', 'invoices.deposit_id', 'deposits.*', 'resellers.reseller_name', 'costcenters.*', 'projects.*', 'areas.*')->distinct()->get();
        $itens = DB::table('inventories')->join('categories', 'categories.id', '=', 'inventories.category_id')->join('brands', 'brands.id', '=', 'inventories.brand_id')->join('products', 'products.id', '=', 'inventories.product_id')->where('inventories.invoice_number', '=', $id)->select('inventories.*', 'categories.*', 'brands.*', 'products.*')->get();
        return view('stocks.invoices.edit-invoice')->with(compact('data', 'datareseller', 'dataarea', 'dataproject', 'datacostcenter', 'datacategory', 'databrand', 'datadeposit', 'itens'));
    }
    public function editinvoice(Request $request) {
        //Validar data
        $this->validatorEdit(Request::all())->validate();
        //Criar servidor no banco de dados
        $data = $this->edit(Request::all());
        return redirect('/invoicelist');
    }
    protected function validatorEdit(array $data) {
        $rules = [
            'invoice_type' => 'required',
            'invoice_typemov' => 'required',
            'invoice_number' => 'required',
            'reseller_id' => 'required', 
            'area_id' => 'required',
            'project_id' => 'required', 
            'deposit_id' => 'required|numeric', 
            'costcenter_id' => 'required',
            'invoice_owner' => 'required|string',
            'invoice_ctafin' => 'required|string', 
            'invoice_ctacon' => 'required|string', 
            'invoice_billingdate' => 'required|date|before:invoice_duedate', 
            'invoice_duedate' => 'required|date|after_or_equal:invoice_billingdate',
            'category_id.*' => 'required|numeric',
            'brand_id.*' => 'required|numeric', 
            'product_id.*' => 'required|numeric', 
            'itemvalue.*' => 'required|numeric|min:1', 
            'quantity.*' => 'required|numeric|min:1',
            ];
            $messages = [
                'required'=>'Este campo é obrigatório.',
                'string'=> 'Este campo deve ser do tipo texto.',
                'itemvalue.*.numeric'=> 'O campo valor unitário aceita apenas numerais.',
                'quantity.*.numeric'=> 'O campo quantidade aceita apenas numerais.',
                'min'=>'O valor inserido precisa de ao menos um caractere.',
                'date'=> 'Este campo deve ser do tipo data.',
                'invoice_billingdate.before'  => 'A data de faturamento precisa ser anterior a data de vencimento.',
                'invoice_duedate.after_or_equal'  => 'A data de vencimento precisa ser posterior ou igual a data de faturamento.',
            ];
            return Validator::make($data, $rules, $messages);
    }
    public function edit(array $data) {
        $product = DB::table('invoices')->where("invoice_number", $data['invoice_id'])->select('product_id', 'invoice_itemquantity')->get();
        $length = count($product);
        for ($i = 0;$i < $length;$i++) {
            if (Stock::where('product_id', '=', (int)$product[$i]->product_id)->count() > 0) {
                $edit = Stock::where('product_id', (int)$product[$i]->product_id)->first();
                $edit->stock_quantity = ($edit->stock_quantity - (int)$product[$i]->invoice_itemquantity);
                $edit->save();
            }
        }
        $deleteinvoice = Invoice::where('invoice_number', $data['invoice_id'])->delete();
        $deleinventory = Inventory::where('invoice_number', $data['invoice_id'])->delete();
        $data = $this->create(Request::all(), Request::input('category_id'), Request::input('brand_id'), Request::input('product_id'), Request::input('itemvalue'), Request::input('quantity'));
        return Redirect::back();
    }
    public function showInvoiceModal($id) {
        $data = DB::table('invoices')->join('resellers', 'resellers.id', '=', 'invoices.reseller_id')->join('costcenters', 'costcenters.id', '=', 'invoices.costcenter_id')->join('projects', 'projects.id', '=', 'invoices.project_id')->join('areas', 'areas.id', '=', 'invoices.area_id')->join('deposits', 'deposits.id', '=', 'invoices.deposit_id')->where('invoices.invoice_number', '=', $id)->select('invoices.invoice_number', 'invoices.invoice_typemov', 'invoices.invoice_type', 'invoices.invoice_owner', 'invoices.invoice_ctafin', 'invoices.invoice_ctacon', 'invoices.invoice_billingdate', 'invoices.invoice_duedate', 'reseller_id', 'invoices.area_id', 'invoices.costcenter_id', 'invoices.deposit_id', 'deposits.*', 'resellers.reseller_name', 'costcenters.*', 'projects.*', 'areas.*')->distinct()->get();
        $itens = DB::table('inventories')->join('categories', 'categories.id', '=', 'inventories.category_id')->join('brands', 'brands.id', '=', 'inventories.brand_id')->join('products', 'products.id', '=', 'inventories.product_id')->where('inventories.invoice_number', '=', $id)->select('inventories.*', 'categories.*', 'brands.*', 'products.*')->get();
        return view('stocks.invoices.show-invoice')->with(compact('data', 'itens'));
    }
    public function getProductsAvgPrice($product) {
        $price[] = DB::table("inventories")->where('inventories.product_id', $product)->avg('inventory_itemvalue');
        if ($price[0] == null) {
            $price[0] = 0;
        }
        return json_encode($price);
    }
}
