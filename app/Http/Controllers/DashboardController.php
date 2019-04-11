<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Inventory;
use App\Models\Timeline;
use Carbon\Carbon;
use Request;
use Auth;
use DB;
class DashboardController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $keyboard = $this->keyboard();
        $notebook = $this->notebook();
        $mouse = $this->mouse();
        $headset = $this->headset();
        $monitor = $this->monitor();
        $line = $this->line();
        $contracts = $this->contract();
        $certificates = $this->certificate();
        $domains = $this->domain();
        $inventorykeyboard = $this->keyboard();
        $inventorynotebook = $this->notebook();
        $inventorymouse = $this->mouse();
        $inventoryheadset = $this->headset();
        $inventorymonitor = $this->monitor();
        $e1 = $this->e1();
        $e3 = $this->e3();
        $comments =$this->comments();
        $loans = $this->loans();
        return view('dashboard')->with(compact('keyboard', 'notebook', 'mouse', 'headset', 'monitor', 'line','certificates','contracts', 'domains','comments','messages',
        'inventorykeyboard', 'inventorymachine', 'inventorymouse', 'inventoryheadset', 'inventorymonitor','e1','e3','loans'));
    }

    protected function loans(){
      $data = DB::table('invoices')->join('resellers', 'resellers.id', '=', 'invoices.reseller_id')
      ->join('costcenters', 'costcenters.id', '=', 'invoices.costcenter_id')
      ->join('projects', 'projects.id', '=', 'invoices.project_id')
      ->join('areas', 'areas.id', '=', 'invoices.area_id')
      ->join('outgoingrequests', 'outgoingrequests.request_number', '=', 'invoices.invoice_number')
      ->where('invoices.invoice_loanstatus', '=', 'Emprestado')
      ->select('invoices.invoice_number', 'invoices.invoice_owner', 'invoices.invoice_billingdate','invoice_typemov',
       'invoices.invoice_duedate', 'resellers.reseller_name', 'costcenters.*', 'projects.*', 'areas.*','outgoingrequests.request_user')->distinct()->get();
       return $data;
    }

    protected function comments(){
        $comments = DB::table("timelines")
        ->select('timelines.*')
        ->whereDate('timelines.created_at', '>', Carbon::now()->subDays(3))->get();
        $length = count($comments);
        if($length==0){
        $comments = DB::table("timelines")
        ->select('timelines.*')
        ->where('timelines.timeline_user', 'Liza')->get();
        }
        return $comments;
    }
    protected function contract() {

        $contract = DB::table("contracts")
        ->select('contracts.*')
        ->where('contracts.contract_status','Em vigor')
        ->whereDate('contracts.expirated_at', '<', Carbon::now()->addDays(15))->count();
        return $contract;
    }
    protected function domain() {
        $domain = DB::table("domains")
        ->select('domains.*')
       ->where('domains.domain_status',"Publicado")
        ->whereDate('domains.domain_expiraem', '<', Carbon::now()->addDays(30))->count();
        return $domain;
    }
    protected function certificate() {
        $domain = DB::table("certificates")
        ->select('certificates.*')
        ->where('certificates.certificate_status','Publicado')
        ->whereDate('certificates.certificate_expiraem', '<', Carbon::now()->addDays(15))->count();
        return $domain;
    }
    protected function e1() {
          $e1in = DB::table('inventories')
          ->join('categories', 'categories.id', '=', 'inventories.category_id')
          ->join('products', 'products.id', '=', 'inventories.product_id')
          ->where("product_model", "Office 365 Enterprise E1")
          ->where("inventory_typemov", "E")
          ->sum('inventory_itemquantity');
          $e1out = DB::table('inventories')
          ->join('categories', 'categories.id', '=', 'inventories.category_id')
          ->join('products', 'products.id', '=', 'inventories.product_id')
          ->where("product_model", "Office 365 Enterprise E1")
          ->where("inventory_typemov", "S")
          ->sum('inventory_itemquantity');
          $e1 = $e1in - $e1out;
          return $e1;
   }
   protected function e3() {
         $e3in = DB::table('inventories')
         ->join('categories', 'categories.id', '=', 'inventories.category_id')
         ->join('products', 'products.id', '=', 'inventories.product_id')
         ->where("product_model", "Office 365 Enterprise E3")
         ->where("inventory_typemov", "E")
         ->sum('inventory_itemquantity');
         $e3out = DB::table('inventories')
         ->join('categories', 'categories.id', '=', 'inventories.category_id')
         ->join('products', 'products.id', '=', 'inventories.product_id')
         ->where("product_model", "Office 365 Enterprise E3")
         ->where("inventory_typemov", "S")
         ->sum('inventory_itemquantity');
         $e3 = $e3in - $e3out;
         return $e3;
  }
    protected function keyboard() {
        $keyboardin = DB::table('inventories')->join('categories', 'categories.id', '=', 'inventories.category_id')->where("category_name", "Teclado")->where("inventory_typemov", "E")->sum('inventory_itemquantity');
        $keyboardout = DB::table('inventories')->join('categories', 'categories.id', '=', 'inventories.category_id')->where("category_name", "Teclado")->where("inventory_typemov", "S")->sum('inventory_itemquantity');
        $keyboard = $keyboardin - $keyboardout;
        return $keyboard;
    }

    protected function line() {
        $linein = DB::table('inventories')->join('products', 'products.id', '=', 'inventories.product_id')->where("products.product_model", "Linhas-Vivo")->where("inventory_typemov", "E")->sum('inventory_itemquantity');
        $lineout = DB::table('inventories')->join('products', 'products.id', '=', 'inventories.product_id')->where("products.product_model", "Linhas-Vivo") ->where("inventory_typemov", "S")->sum('inventory_itemquantity');
        $line = $linein - $lineout;
        return $line;
    }
    protected function notebook() {
        $notebookin = DB::table('inventories')->join('categories', 'categories.id', '=', 'inventories.category_id')->where("category_name", "Notebook")->where("inventory_typemov", "E")->sum('inventory_itemquantity');
        $notebookout = DB::table('inventories')->join('categories', 'categories.id', '=', 'inventories.category_id')->where("category_name", "Notebook")->where("inventory_typemov", "S")->sum('inventory_itemquantity');
        $notebook = ($notebookin - $notebookout);
        return $notebook;
    }
    protected function mouse() {
        $mousein = DB::table('inventories')->join('categories', 'categories.id', '=', 'inventories.category_id')->where("category_name", "Mouse")->where("inventory_typemov", "E")->sum('inventory_itemquantity');
        $mouseout = DB::table('inventories')->join('categories', 'categories.id', '=', 'inventories.category_id')->where("category_name", "Mouse")->where("inventory_typemov", "S")->sum('inventory_itemquantity');
        $mouse = $mousein - $mouseout;
        return $mouse;
    }
    protected function headset() {
        $headsetin = DB::table('inventories')->join('categories', 'categories.id', '=', 'inventories.category_id')->where("category_name", "Headset")->where("inventory_typemov", "E")->sum('inventory_itemquantity');
        $headsetout = DB::table('inventories')
        ->join('categories', 'categories.id', '=', 'inventories.category_id')
        ->where("category_name", "Headset")
        ->where("inventory_typemov", "S")->sum('inventory_itemquantity');
        $headset = $headsetin - $headsetout;
        return $headset;
    }
    protected function monitor() {
        $monitorin = DB::table('inventories')->join('categories', 'categories.id', '=', 'inventories.category_id')->where("category_name", "Monitor")->where("inventory_typemov", "E")->sum('inventory_itemquantity');
        $monitorout = DB::table('inventories')->join('categories', 'categories.id', '=', 'inventories.category_id')->where("category_name", "Monitor")->where("inventory_typemov", "S")->sum('inventory_itemquantity');
        $monitor = ($monitorin - $monitorout);
        return $monitor;
    }
    protected function inventorykeyboard() {
        $inventorykeyboard = DB::table('inventories')->join('categories', 'categories.id', '=', 'inventories.category_id')->join('brands', 'brands.id', '=', 'inventories.brand_id')->join('products', 'products.id', '=', 'inventories.product_id')->where("category_name", "Teclado")->select('products.product_model', 'brands.brand_name', 'categories.category_name', 'inventories.inventory_itemquantity')->get();
        return $inventorykeyboard;
    }
    protected function inventorymachine() {
        $inventorymachine = DB::table('inventories')->join('categories', 'categories.id', '=', 'inventories.category_id')->join('brands', 'brands.id', '=', 'inventories.brand_id')->join('products', 'products.id', '=', 'inventories.product_id')->where("category_name", "Notebook")->select('products.product_model', 'brands.brand_name', 'categories.category_name')->distinct()->get();
        return $inventorymachine;
    }
    protected function inventorymouse() {
        $inventorymouse = DB::table('inventories')->join('categories', 'categories.id', '=', 'inventories.category_id')->join('brands', 'brands.id', '=', 'inventories.brand_id')->join('products', 'products.id', '=', 'inventories.product_id')->where("category_name", "Mouse")->select('products.product_model', 'brands.brand_name', 'categories.category_name')->distinct()->get();
        return $inventorymouse;
    }
    protected function inventoryheadset() {
        $inventoryheadset = DB::table('inventories')->join('categories', 'categories.id', '=', 'inventories.category_id')->join('brands', 'brands.id', '=', 'inventories.brand_id')->join('products', 'products.id', '=', 'inventories.product_id')->where("category_name", "Headset")->select('products.product_model', 'brands.brand_name', 'categories.category_name')->distinct()->get();
        return $inventoryheadset;
    }
    protected function inventorymonitor() {
        $inventorymonitor = DB::table('inventories')->join('categories', 'categories.id', '=', 'inventories.category_id')->join('brands', 'brands.id', '=', 'inventories.brand_id')->join('products', 'products.id', '=', 'inventories.product_id')->where("category_name", "Monitor")->select('products.product_model', 'brands.brand_name', 'categories.category_name')->distinct()->get();
        return $inventorymonitor;
    }

    public function register(Request $request) {
        //Validar data
        //Criar servidor no banco de dados
        $data = $this->create(Request::all());
        return Redirect::back();
    }
    protected function create(array $data) {
        $user = auth::user()->name;
        $date = Carbon::now();
        $hour=$date->toTimeString();
        $date =$date->format('d-m-Y');
        return Timeline::create
        (['timeline_user' => $user,
          'timeline_body' => $data['timeline_body'],
          'timeline_date' =>$date,
          'timeline_hour' =>$hour,
        ]);
    }
    public function delete($id){

        $user = auth::user()->name;
        $comments = DB::table("timelines")
        ->where('id','=', $id)
        ->select('timelines.timeline_user')->get();

        if($comments[0]->timeline_user == $user){
            $delete = DB::table("timelines")
            ->where('id','=', $id)
            ->select('timelines.timeline_user')->delete();
            return Redirect::back();
        }else{
            $messages = 'Você não pode apagar o comentário de outra pessoa.';

         return redirect('home')->with('status', $messages);
        }
    }
}
