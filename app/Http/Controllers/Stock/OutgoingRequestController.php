<?php
namespace App\Http\Controllers\Stock;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
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
use App\Models\OutgoingRequest;
use App\Models\Stock;
use Request;
use Auth;
use DB;
class OutgoingRequestController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }
    public function showOutgoingRequestForm() {
        $dataarea = Area::all();
        $dataproject = Project::all();
        $datacategory = Category::all();
        $databrand = Brand::all();
        $datadeposit = Deposit::all();
        $datacostcenter = DB::table('costcenters')->select('costcenter_ccowner')->distinct()->get();
        return view('stocks.outgoingrequests.request')->with(compact('dataarea', 'dataproject', 'datacostcenter', 'datacategory', 'databrand', 'datadeposit'));
    }
    public function getVerticals($owner) {
        $verticals = DB::table("costcenters")
        ->join('verticals', 'verticals.id', '=', 'costcenters.vertical_id')
        ->where('costcenters.costcenter_ccowner', $owner)
        ->pluck("verticals.vertical_name", "verticals.id");
        return json_encode($verticals);
    }
    public function getCostCenters($owner, $vertical) {
        $costcenters = DB::table("costcenters")
        ->join('verticals', 'verticals.id', '=', 'costcenters.vertical_id')
        ->where('costcenters.costcenter_ccowner', $owner)
        ->where('costcenters.vertical_id', $vertical)
        ->pluck("costcenters.costcenter_description", 'costcenters.id');
        return json_encode($costcenters);
    }
    public function getProductsAvgPrice($product) {
        $price[] = DB::table("inventories")
        ->where('inventories.product_id', $product)
        ->avg('inventory_itemvalue');
        if ($price[0] == null) {
            $price[0] = 0;
        }

       $price[0] = number_format((float)$price[0], 2, '.', '');
       return json_encode($price);
    }
    public function getProductsQuantity($product) {
        $in = DB::table("inventories")->where('inventories.product_id', $product)->where('inventories.inventory_typemov', 'E')->sum('inventory_itemquantity');
        $out = DB::table("inventories")->where('inventories.product_id', $product)->where('inventories.inventory_typemov', 'S')->sum('inventory_itemquantity');
        $qty[] = ($in - $out);
        return json_encode($qty);
    }
    public function register(Request $request) {
        //Validar data
        $this->validator(Request::all())->validate();
        $this->create(Request::all(),
        Request::input('category_id'),
        Request::input('brand_id'),
        Request::input('product_id'),
        Request::input('itemvalue'),
        Request::input('quantity'));
        return redirect('/requestlist');
    }
    protected function validator(array $data) {

        $rules = [
        'invoice_type' => 'required',
        'request_number' => 'required',
        'request_owner' => 'required',
        'costcenter_ccowner' => 'required',
        'vertical_id' => 'required',
        'costcenter_id' => 'required',
        'area_id' => 'required|numeric',
        'project_id' => 'required',
        'invoice_ctafin' => 'required|string',
        'invoice_ctacon' => 'required|string',
        'request_datemov' => 'required|date|before_or_equal:request_returndate',
        'request_returndate' => 'required|date|after_or_equal:request_datemov',
        'category_id.*' => 'required|numeric',
        'brand_id.*' => 'required|numeric',
        'product_id.*' => 'required|numeric',
        'itemvalue.*' => 'required|numeric|min:1',
        'quantity.*' => 'required|numeric|min:1'
        ];
        $messages = [
            'required'=>'Este campo é obrigatório.',
            'string'=> 'Este campo deve ser do tipo texto.',
            'category_id.*.numeric'=> 'O campo marca aceita apenas numerais. Entre em contato com o administrador.',
            'brand.*.numeric'=> 'O campo marca aceita apenas numerais. Entre em contato com o administrador.',
            'product.*.numeric'=> 'O campo marca aceita apenas numerais. Entre em contato com o administrador.',
            'itemvalue.*.numeric'=> 'O campo valor unitário aceita apenas numerais.',
            'quantity.*.numeric'=> 'O campo quantidade aceita apenas numerais.',
            'min'=>'O valor inserido precisa de ao menos um caractere.',
            'date'=> 'Este campo deve ser do tipo data.',
            'request_datemov.before_or_equal'  => 'A data de movimento precisa ser anterior ou igual a data de devolução.',
            'request_returndate.after_or_equal'  => 'A data de devolução precisa ser posterior ou igual a data de movimento.',
        ];
            return Validator::make($data, $rules, $messages);
    }
    protected function create(array $data, array $categories, array $brands, array $products, array $itemval, array $quantity){
        $length = count($categories);
        $user = auth::user()->name;
        foreach( $categories as $value) {
            $category[] = $value;
        }
        foreach( $brands as $value) {
            $brand[] = $value;
        }
        foreach( $products as $value) {
            $product[] = $value;
        }
        foreach( $itemval as $value) {
                 $item[] = $value;
        }
        foreach( $quantity as $value) {
            $qtd[] = $value;
        }
        for ($i = 0; $i < $length; $i++) {
            OutgoingRequest::create([
                'invoice_type' =>  'S',
                'request_number' =>  $data['request_number'],
                'request_owner' => $data['request_owner'],
                'costcenter_id' => $data['costcenter_id'],
                'request_observation' => $data['request_observation'],
                'request_datemov' => $data['request_datemov'],
                'category_id' =>(int)$category[$i],
                'brand_id' => (int)$brand[$i],
                'product_id' =>(int)$product[$i],
                'request_avgprice' =>(float)$item[$i],
                'request_movquantity'=>(int)$qtd[$i],
                'request_user'=> $user

            ]);
            Invoice::create([
                'invoice_type' =>  'S',
                'invoice_typemov' => $data['invoice_typemov'],
                'invoice_number' =>  $data['request_number'],
                'reseller_id' => '6',
                'area_id' => $data['area_id'],
                'deposit_id' => '2',
                'costcenter_id' => $data['costcenter_id'],
                'project_id' => $data['project_id'],
                'invoice_owner' => $data['request_owner'],
                'invoice_ctafin' => $data['invoice_ctafin'],
                'invoice_ctacon' =>  $data['invoice_ctacon'],
                'invoice_billingdate' => $data['request_datemov'] ,
                'invoice_duedate' =>  $data['request_returndate'],
                'category_id' =>(int)$category[$i],
                'brand_id' => (int)$brand[$i],
                'product_id' =>(int)$product[$i],
                'invoice_itemvalue' =>(float)$item[$i],
                'invoice_itemquantity'=>(int)$qtd[$i],
                'vertical_id' => $data['vertical_id'],
                'invoice_loanstatus' => $data['invoice_loanstatus']
            ]);
            Inventory::create([
                'category_id' =>(int)$category[$i],
                'brand_id' => (int)$brand[$i],
                'product_id' =>(int)$product[$i],
                'costcenter_id' => $data['costcenter_id'],
                'invoice_number' =>$data['request_number'],
                'inventory_itemvalue' =>(float)$item[$i],
                'inventory_itemquantity'=>(int)$qtd[$i],
                'inventory_typemov' =>  'S',
                'deposit_id' => '2'
            ]);
            if (Stock::where('product_id', '=',(int)$product[$i] )->count() > 0) {
                $edit = Stock::where('product_id',(int)$product[$i])->first();
                $edit->stock_quantity =($edit->stock_quantity - (int)$qtd[$i]);
                $edit->save();
             }
        }
           return ;
    }
    public function showListRequest() {
        $lastinvoice = DB::table('invoices')
        ->join('resellers', 'resellers.id', '=', 'invoices.reseller_id')
        ->join('costcenters', 'costcenters.id', '=', 'invoices.costcenter_id')
        ->join('projects', 'projects.id', '=', 'invoices.project_id')
        ->join('areas', 'areas.id', '=', 'invoices.area_id')
        ->join('outgoingrequests', 'outgoingrequests.request_number', '=', 'invoices.invoice_number')
        ->where('invoices.invoice_type', '=', 'S')
        ->orderby('invoices.updated_at', 'desc')
        ->select('invoices.invoice_number', 'invoices.invoice_owner', 'invoices.invoice_billingdate', 'invoices.invoice_duedate','invoice_typemov',
         'resellers.reseller_name', 'costcenters.*', 'projects.*', 'areas.*','outgoingrequests.request_user')->first();

        $data = DB::table('invoices')->join('resellers', 'resellers.id', '=', 'invoices.reseller_id')
        ->join('costcenters', 'costcenters.id', '=', 'invoices.costcenter_id')
        ->join('projects', 'projects.id', '=', 'invoices.project_id')
        ->join('areas', 'areas.id', '=', 'invoices.area_id')
        ->join('outgoingrequests', 'outgoingrequests.request_number', '=', 'invoices.invoice_number')
        ->where('invoices.invoice_type', '=', 'S')
        ->select('invoices.invoice_number', 'invoices.invoice_owner', 'invoices.invoice_billingdate','invoice_typemov',
         'invoices.invoice_duedate', 'resellers.reseller_name', 'costcenters.*', 'projects.*', 'areas.*','outgoingrequests.request_user')->distinct()->get();
        return view('stocks.outgoingrequests.list-request')->with(compact('lastinvoice', 'data'));
    }

    public function showMyRequests() {

        $user = auth::user()->name;
        $lastinvoice = DB::table('invoices')
        ->join('resellers', 'resellers.id', '=', 'invoices.reseller_id')
        ->join('costcenters', 'costcenters.id', '=', 'invoices.costcenter_id')
        ->join('projects', 'projects.id', '=', 'invoices.project_id')
        ->join('areas', 'areas.id', '=', 'invoices.area_id')
        ->join('outgoingrequests', 'outgoingrequests.request_number', '=', 'invoices.invoice_number')
        ->where('invoices.invoice_type', '=', 'S')
        ->where('outgoingrequests.request_user', '=',$user)
        ->orderby('invoices.updated_at', 'desc')
        ->select('invoices.invoice_number', 'invoices.invoice_owner', 'invoices.invoice_billingdate', 'invoices.invoice_duedate','invoices.invoice_typemov',
         'resellers.reseller_name', 'costcenters.*', 'projects.*', 'areas.*','outgoingrequests.request_user')->first();

        if($lastinvoice == null){
            return redirect('/requestlist');
        }

         $data = DB::table('invoices')->join('resellers', 'resellers.id', '=', 'invoices.reseller_id')
        ->join('costcenters', 'costcenters.id', '=', 'invoices.costcenter_id')
        ->join('projects', 'projects.id', '=', 'invoices.project_id')
        ->join('areas', 'areas.id', '=', 'invoices.area_id')
        ->join('outgoingrequests', 'outgoingrequests.request_number', '=', 'invoices.invoice_number')
        ->where('invoices.invoice_type', '=', 'S')
        ->where('outgoingrequests.request_user', '=',  $user)
        ->select('invoices.invoice_number', 'invoices.invoice_owner', 'invoices.invoice_billingdate','invoices.invoice_typemov',
         'invoices.invoice_duedate', 'resellers.reseller_name', 'costcenters.*', 'projects.*', 'areas.*','outgoingrequests.request_user')->distinct()->get();
        return view('stocks.outgoingrequests.my-requests')->with(compact('lastinvoice', 'data'));
    }

    public function showRequestModal($id) {
        $data = DB::table('invoices')->join('resellers', 'resellers.id', '=', 'invoices.reseller_id')->join('costcenters', 'costcenters.id', '=', 'invoices.costcenter_id')->join('projects', 'projects.id', '=', 'invoices.project_id')->join('areas', 'areas.id', '=', 'invoices.area_id')->join('deposits', 'deposits.id', '=', 'invoices.deposit_id')->join('outgoingrequests', 'outgoingrequests.request_number', '=', 'invoices.invoice_number')->where('invoices.invoice_number', '=', $id)->select('invoices.invoice_number', 'invoices.invoice_typemov', 'invoices.invoice_type', 'invoices.invoice_owner', 'invoices.invoice_ctafin', 'invoices.invoice_ctacon', 'invoices.invoice_billingdate', 'invoices.invoice_duedate', 'reseller_id', 'invoices.area_id', 'invoices.costcenter_id', 'invoices.deposit_id', 'deposits.*', 'resellers.reseller_name', 'costcenters.*', 'projects.*', 'areas.*', 'outgoingrequests.request_observation','outgoingrequests.request_user')->distinct()->get();
        $itens = DB::table('inventories')->join('categories', 'categories.id', '=', 'inventories.category_id')->join('brands', 'brands.id', '=', 'inventories.brand_id')->join('products', 'products.id', '=', 'inventories.product_id')->where('inventories.invoice_number', '=', $id)->select('inventories.*', 'categories.*', 'brands.*', 'products.*')->get();
        return view('stocks.outgoingrequests.show-request')->with(compact('data', 'itens'));
    }
    public function showRequestEditForm($id) {
        $dataarea = Area::all();
        $dataproject = Project::all();
        $datacategory = Category::all();
        $databrand = Brand::all();
        $datadeposit = Deposit::all();
        $datacostcenter = DB::table('costcenters')->select('costcenter_ccowner')->distinct()->get();

        $data = DB::table('invoices')->join('resellers', 'resellers.id', '=', 'invoices.reseller_id')
        ->join('costcenters', 'costcenters.id', '=', 'invoices.costcenter_id')
        ->join('projects', 'projects.id', '=', 'invoices.project_id')
        ->join('areas', 'areas.id', '=', 'invoices.area_id')
        ->join('deposits', 'deposits.id', '=', 'invoices.deposit_id')
        ->join('outgoingrequests', 'outgoingrequests.request_number', '=', 'invoices.invoice_number')
        ->join('verticals', 'verticals.id', '=', 'invoices.vertical_id')
        ->where('invoices.invoice_number', '=', $id)
        ->select('invoices.invoice_number', 'invoices.invoice_typemov', 'invoices.invoice_owner',
         'invoices.invoice_ctafin', 'invoices.invoice_ctacon', 'invoices.invoice_billingdate', 'invoices.invoice_duedate', 'reseller_id', 'invoices.area_id','invoices.vertical_id',
         'invoices.costcenter_id', 'invoices.deposit_id', 'deposits.*', 'resellers.reseller_name', 'costcenters.*', 'projects.*', 'areas.*','verticals.*',
         'outgoingrequests.request_observation','outgoingrequests.request_user')->distinct()->get();
         $length = count($data);

         $itens = DB::table('inventories')->join('categories', 'categories.id', '=', 'inventories.category_id')
         ->join('brands', 'brands.id', '=', 'inventories.brand_id')->join('products', 'products.id', '=', 'inventories.product_id')
         ->where('inventories.invoice_number', '=', $id)->select('inventories.*', 'categories.*', 'brands.*', 'products.*')->get();

        return view('stocks.outgoingrequests.edit-request')->with(compact('data', 'datareseller', 'dataarea', 'dataproject', 'datacostcenter', 'datacategory', 'databrand', 'datadeposit', 'itens'));
    }
    protected function validatorEdit(array $data)
    {
        $rules = [
            'invoice_type' => 'required',
            'request_number' => 'required',
            'request_owner' => 'required',
            'costcenter_ccowner' => 'required',
            'vertical_id' => 'required',
            'costcenter_id' => 'required',
            'area_id' => 'required|numeric',
            'project_id' => 'required',
            'invoice_ctafin' => 'required|string',
            'invoice_ctacon' => 'required|string',
            'request_datemov' => 'required|date|before_or_equal:request_returndate',
            'request_returndate' => 'required|date|after_or_equal:request_datemov',
            'category_id.*' => 'required|numeric',
            'brand_id.*' => 'required|numeric',
            'product_id.*' => 'required|numeric',
            'itemvalue.*' => 'required|numeric|min:1',
            'quantity.*' => 'required|numeric|min:1'
        ];

        $messages = [
            'required'=>'Este campo é obrigatório.',
            'string'=> 'Este campo deve ser do tipo texto.',
            'category_id.*.numeric'=> 'O campo marca aceita apenas numerais. Entre em contato com o administrador.',
            'brand.*.numeric'=> 'O campo marca aceita apenas numerais. Entre em contato com o administrador.',
            'product.*.numeric'=> 'O campo marca aceita apenas numerais. Entre em contato com o administrador.',
            'itemvalue.*.numeric'=> 'O campo valor unitário aceita apenas numerais.',
            'quantity.*.numeric'=> 'O campo quantidade aceita apenas numerais.',
            'min'=>'O valor inserido precisa de ao menos um caractere.',
            'date'=> 'Este campo deve ser do tipo data.',
            'request_datemov.before_or_equal'  => 'A data de movimento precisa ser anterior ou igual a data de devolução.',
            'request_returndate.after_or_equal'  => 'A data de devolução precisa ser posterior ou igual a data de movimento.',
            ];

    return Validator::make($data, $rules, $messages);
    }
    public function edit(array $data) {
        $product = DB::table('invoices')->where("invoice_number", $data['request_number'])->select('product_id', 'invoice_itemquantity')->get();
        $length = count($product);
        for ($i = 0;$i < $length;$i++) {
            if (Stock::where('product_id', '=', (int)$product[$i]->product_id)->count() > 0) {
                $edit = Stock::where('product_id', (int)$product[$i]->product_id)->first();
                $edit->stock_quantity = ($edit->stock_quantity + (int)$product[$i]->invoice_itemquantity);
                $edit->save();
            }
        }
        $deleteinvoice = Invoice::where('invoice_number', $data['request_number'])->delete();
        $deleinventory = Inventory::where('invoice_number', $data['request_number'])->delete();
        $delerequest = OutgoingRequest::where('request_number', $data['request_number'])->delete();
        $data = $this->create(Request::all(), Request::input('category_id'), Request::input('brand_id'), Request::input('product_id'), Request::input('itemvalue'), Request::input('quantity'));
        return Redirect::back();
    }
    public function editrequest(Request $request) {
        //Validar data
        $this->validatorEdit(Request::all())->validate();
        //Criar servidor no banco de dados
        $data = $this->edit(Request::all());
        return redirect('/requestlist');
    }
}
