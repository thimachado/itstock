<?php

namespace App\Http\Controllers\Stock;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use App\Models\CostCenter;
use App\Models\Brand;
use App\Models\Stock;
use App\Models\Deposit;
use App\Models\Category;
use Carbon\Carbon;
use Request;
use DB;

class ReportController extends Controller
{
    public function inventoryreport()
    {
        $datacategory = Category::all ();
        $databrand = Brand::all ();
        $data= DB::table('stocks')
       ->join('categories', 'categories.id', '=', 'stocks.category_id')
       ->join('brands', 'brands.id', '=', 'stocks.brand_id')
       ->join('products','products.id', '=', 'stocks.product_id')
       ->select('stocks.*','categories.category_name','brands.brand_name','products.product_model')->get();
        return view ('stocks.reports.inventoryreport')->with(compact('data','datacategory','databrand'));
    }
    public function selectinventoryreport(Request $request)
    {
        $data = Request::all();
        $datacategory = Category::all ();
        $databrand = Brand::all ();
        $data= DB::table('stocks')
        ->join('categories', 'categories.id', '=', 'stocks.category_id')
        ->join('brands', 'brands.id', '=', 'stocks.brand_id')
        ->join('products', 'products.id', '=', 'stocks.product_id')
        ->where('stocks.category_id',$data['category_id'])
        ->where('stocks.brand_id',$data['brand_id'])
        ->select('stocks.*','categories.category_name','brands.brand_name','products.product_model')->get();
        return view ('stocks.reports.inventoryreport')->with(compact('data','datacategory','databrand'));
    }
    public function requestreport()
    {
        $cc = CostCenter::all ();

        $data= DB::table('invoices')
        ->select('categories.category_name','brands.brand_name','products.product_model',
         DB::raw('SUM(invoice_itemquantity) as quantity'),DB::raw('AVG(invoice_itemvalue) as avgprice'))
        ->join('categories', 'categories.id', '=', 'invoices.category_id')
        ->join('brands', 'brands.id', '=', 'invoices.brand_id')
        ->join('products','products.id', '=', 'invoices.product_id')
        ->join('costcenters','costcenters.id', '=', 'invoices.costcenter_id')
        ->where('invoices.invoice_type', 'S')
        ->whereDate('invoices.created_at', '>', Carbon::now()->subDays(30))
        ->groupBy('categories.category_name')
        ->groupBy('brands.brand_name')
        ->groupBy('products.product_model')
        ->get();

        return view ('stocks.reports.requestreport')->with(compact('data','cc'));
    }

    public function ccreport()
    {
        $cc = CostCenter::all ();
        $request = Request::all();

        $data= DB::table('invoices')
        ->select('categories.category_name','brands.brand_name','products.product_model','costcenters.costcenter_description', 'invoices.invoice_typemov',
        DB::raw('SUM(invoice_itemquantity) as quantity'),DB::raw('AVG(invoice_itemvalue) as avgprice'))
        ->join('categories', 'categories.id', '=', 'invoices.category_id')
        ->join('brands', 'brands.id', '=', 'invoices.brand_id')
        ->join('products','products.id', '=', 'invoices.product_id')
        ->join('costcenters','costcenters.id', '=', 'invoices.costcenter_id')
        ->where('invoices.invoice_type', 'S')
        ->where('invoices.costcenter_id',$request['costcenter_id'])
        ->whereDate('invoices.created_at', '>', Carbon::now()->subDays(30))
        ->groupBy('categories.category_name')
        ->groupBy('brands.brand_name')
        ->groupBy('products.product_model')
        ->groupBy('costcenters.costcenter_description')
        ->groupBy('invoices.invoice_typemov')
        ->get();

        $length = count($data);

        if($length == 0){
       return view ('stocks.reports.requestreport')->with(compact('data','cc'));

        }
        return view ('stocks.reports.ccrequestreport')->with(compact('data','cc'));
    }

    public function keyboardreport()
    {
        $data= DB::table('stocks')
       ->join('categories', 'categories.id', '=', 'stocks.category_id')
       ->join('brands', 'brands.id', '=', 'stocks.brand_id')
       ->join('products','products.id', '=', 'stocks.product_id')
       ->where('categories.category_name', 'Teclado')
       ->select('stocks.*','categories.category_name','brands.brand_name','products.product_model')->get();
        return view ('stocks.reports.keyboardreport')->with(compact('data'));
    }
    public function machinereport()
    {
        $data= DB::table('stocks')
       ->join('categories', 'categories.id', '=', 'stocks.category_id')
       ->join('brands', 'brands.id', '=', 'stocks.brand_id')
       ->join('products','products.id', '=', 'stocks.product_id')
       ->where('categories.category_name', 'Notebook')
       ->select('stocks.*','categories.category_name','brands.brand_name','products.product_model')->get();
        return view ('stocks.reports.machinereport')->with(compact('data'));
    }
    public function mousereport()
    {
        $data= DB::table('stocks')
       ->join('categories', 'categories.id', '=', 'stocks.category_id')
       ->join('brands', 'brands.id', '=', 'stocks.brand_id')
       ->join('products','products.id', '=', 'stocks.product_id')
       ->where('categories.category_name', 'Mouse')
       ->select('stocks.*','categories.category_name','brands.brand_name','products.product_model')->get();
        return view ('stocks.reports.mousereport')->with(compact('data'));
    }
    public function headsetreport()
    {
        $data= DB::table('stocks')
       ->join('categories', 'categories.id', '=', 'stocks.category_id')
       ->join('brands', 'brands.id', '=', 'stocks.brand_id')
       ->join('products','products.id', '=', 'stocks.product_id')
       ->where('categories.category_name', 'Headset')
       ->select('stocks.*','categories.category_name','brands.brand_name','products.product_model')->get();
        return view ('stocks.reports.headsetreport')->with(compact('data'));
    }
    public function monitorreport()
    {
        $data= DB::table('stocks')
       ->join('categories', 'categories.id', '=', 'stocks.category_id')
       ->join('brands', 'brands.id', '=', 'stocks.brand_id')
       ->join('products','products.id', '=', 'stocks.product_id')
       ->where('categories.category_name', 'Monitor')
       ->select('stocks.*','categories.category_name','brands.brand_name','products.product_model')->get();
        return view ('stocks.reports.monitorreport')->with(compact('data'));
    }
    public function contractreport()
    {
        $data = DB::table("contracts")
        ->join('resellers', 'resellers.id', '=', 'contracts.reseller_id')
        ->select('contracts.*','resellers.reseller_name')
        ->where('contracts.contract_status','Em vigor')
        ->whereDate('contracts.expirated_at', '<', Carbon::now()->addDays(15))->get();;
        return view ('stocks.reports.contractreport')->with(compact('data'));
    }
    public function domainreport()
    {
        $data = DB::table("domains")
        ->select('domains.*')
        ->where('domains.domain_status',"Publicado")
        ->whereDate('domains.domain_expiraem', '<', Carbon::now()->addDays(30))->get();
        return view ('stocks.reports.domainreport')->with(compact('data'));
    }

    public function certificatereport()
    {
        $data = DB::table("certificates")
        ->select('certificates.*')
        ->where('certificates.certificate_status','Publicado')
        ->whereDate('certificates.certificate_expiraem', '<', Carbon::now()->addDays(15))->get();
        return view ('stocks.reports.certificatereport')->with(compact('data'));
    }
    public function statsmonthreport() {
        return view('stocks.reports.statsmonthreport');
    }
    public function overviewreport() {
        return view('stocks.reports.overviewstock');
    }
}
