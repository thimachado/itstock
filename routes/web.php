<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => 'guest'], function() {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/login/ad', '\App\Http\Controllers\Auth\LoginController@login');
});

Auth::routes();
Route::post('/logout', 'Auth\LoginController@logout');
Route::group(['middleware' => 'web'], function() {
Route::get('/home', 'DashboardController@index');
//Categories
Route::get('/categories', 'Stock\CategoryController@showCategoryForm');
Route::post('/savecategoryregister', 'Stock\CategoryController@register');
Route::get ( '/editcategory/{id}',  'Stock\CategoryController@showCategoryEditForm');
Route::post('/savecategoryedit', 'Stock\CategoryController@editcategory');
//Brands
Route::get('/brands', 'Stock\BrandController@showBrandForm');
Route::post('/savebrandregister', 'Stock\BrandController@register');
Route::get ( '/editbrand/{id}',  'Stock\BrandController@showBrandEditForm');
Route::post('/savebrandedit', 'Stock\BrandController@editbrand');
////Products
Route::get('/products', 'Stock\ProductController@showProductForm');
Route::post('/saveproductregister', 'Stock\ProductController@register');
Route::get ( '/editproduct/{id}',  'Stock\ProductController@showProductEditForm');
Route::post('/saveproductedit', 'Stock\ProductController@editproduct');
//Stocks
Route::get('/stock', 'Stock\StockController@showStockForm');
Route::post('/savestockregister', 'Stock\StockController@register');
Route::get ( '/deletestock/{id}', 'Stock\StockController@delete');
Route::get ( '/editstock/{id}',  'Stock\StockController@showStockEditForm');
Route::post('/savestockedit', 'Stock\StockController@editstock');
//Projects
Route::get('/projects', 'Stock\ProjectController@showProjectForm');
Route::post('/saveprojectregister', 'Stock\ProjectController@register');
Route::get ( '/editproject/{id}',  'Stock\ProjectController@showProjectEditForm');
Route::post('/saveprojectedit', 'Stock\ProjectController@editproject');
//Business
Route::get('/business', 'Stock\BusinessController@showBusinessForm');
Route::post('/savebusinessregister', 'Stock\BusinessController@register');
Route::get ( '/editbusiness/{id}',  'Stock\BusinessController@showBusinessEditForm');
Route::post('/savebusinessedit', 'Stock\BusinessController@editbusiness');
//ClientGroups
Route::get('/clientgroup', 'Stock\ClientGroupController@showClientGroupForm');
Route::post('/saveclientgroupregister', 'Stock\ClientGroupController@register');
Route::get ( '/editclientgroup/{id}', 'Stock\ClientGroupController@showClientGroupEditForm');
Route::post('/saveclientgroupedit', 'Stock\ClientGroupController@editclientgroup');
//ResultCenter
Route::get('/resultcenter', 'Stock\ResultCenterController@showResultCenterForm');
Route::post('/saveresultcenterregister', 'Stock\ResultCenterController@register');
Route::get ( '/editresultcenter/{id}', 'Stock\ResultCenterController@showResultCenterEditForm');
Route::post('/saveresultcenteredit', 'Stock\ResultCenterController@editresultcenter');
//Areas
Route::get('/areas', 'Stock\AreaController@showAreaForm');
Route::post('/savearearegister', 'Stock\AreaController@register');
Route::get ( '/editarea/{id}', 'Stock\AreaController@showAreaEditForm');
Route::post('/saveareaedit', 'Stock\AreaController@editarea');
//Verticals
Route::get('/verticals', 'Stock\VerticalController@showVerticalForm');
Route::post('/saveverticalregister', 'Stock\VerticalController@register');
Route::get ( '/editvertical/{id}', 'Stock\VerticalController@showVerticalEditForm');
Route::post('/saveverticaledit', 'Stock\VerticalController@editvertical');
//Resellers
Route::get('/resellers', 'Stock\ResellerController@showResellerForm');
Route::post('/saveresellerregister', 'Stock\ResellerController@register');
Route::get ( '/editreseller/{id}', 'Stock\ResellerController@showResellerEditForm');
Route::post('/savereselleredit', 'Stock\ResellerController@editreseller');
//Deposits
Route::get('/deposits', 'Stock\DepositController@showDepositForm');
Route::post('/savedepositregister', 'Stock\DepositController@register');
Route::get ( '/editdeposit/{id}', 'Stock\DepositController@showDepositEditForm');
Route::post('/savedepositedit', 'Stock\DepositController@editdeposit');
//CostCenters
Route::get('/costcenter', 'Stock\CostCenterController@showCostCenterForm');
Route::post('/savecostcenterregister', 'Stock\CostCenterController@register');
Route::get ( '/editcostcenter/{id}', 'Stock\CostCenterController@showCostCenterEditForm');
Route::post('/savecostcenteredit', 'Stock\CostCenterController@editcostcenter');
//Invoices
Route::get('/invoice', 'Stock\InvoiceController@showInvoiceForm');
Route::post('/saveinvoiceregister', 'Stock\InvoiceController@register');
Route::post('/saveinvoiceedit', 'Stock\InvoiceController@editinvoice');
Route::get('selectproject/get/{id}', 'Stock\InvoiceController@getProjects');
Route::get('selectarea/get/{id}', 'Stock\InvoiceController@getAreas');
Route::get('selectbrand/get/{idcat}', 'Stock\StockController@getBrands');
Route::get('selectproduct/get/{idcat}/{idbrand}', 'Stock\StockController@getProducts');
Route::get ( '/invoicelist', 'Stock\InvoiceController@showListInvoice');
Route::get ( '/editinvoice/{id}', 'Stock\InvoiceController@showInvoiceEditForm');
Route::get ( '/showinvoice/{id}', 'Stock\InvoiceController@showInvoiceModal');
//Outgoing Requests
Route::get('/outgoingrequest', 'Stock\OutgoingRequestController@showOutgoingRequestForm');
Route::get('selectvertical/get/{owner}', 'Stock\OutgoingRequestController@getVerticals');
Route::get('selectcostcenter/get/{owner}/{vertical}', 'Stock\OutgoingRequestController@getCostCenters');
Route::get('showavgprice/get/{product}', 'Stock\OutgoingRequestController@getProductsAvgPrice');
Route::get('showproductquantity/get/{product}', 'Stock\OutgoingRequestController@getProductsQuantity');
Route::post('/saveoutgoingregister', 'Stock\OutgoingRequestController@register');
Route::get ( '/requestlist', 'Stock\OutgoingRequestController@showListRequest');
Route::get ( '/myrequestslist', 'Stock\OutgoingRequestController@showMyRequests');
Route::get ( '/showrequest/{id}', 'Stock\OutgoingRequestController@showRequestModal');
Route::get ( '/editrequest/{id}', 'Stock\OutgoingRequestController@showRequestEditForm');
Route::post('/saveoutgoingrequestedit', 'Stock\OutgoingRequestController@editrequest');
//Reports
Route::get('/inventoryreport', 'Stock\ReportController@inventoryreport');
Route::post('/selectinventory', 'Stock\ReportController@selectinventoryreport');
Route::get('/requestreport', 'Stock\ReportController@requestreport');
Route::post('/ccrequestreport', 'Stock\ReportController@ccreport');
Route::get('/keyboardreport', 'Stock\ReportController@keyboardreport');
Route::get('/machinereport', 'Stock\ReportController@machinereport');
Route::get('/mousereport', 'Stock\ReportController@mousereport');
Route::get('/headsetreport', 'Stock\ReportController@headsetreport');
Route::get('/monitorreport', 'Stock\ReportController@monitorreport');
Route::get('/contractreport', 'Stock\ReportController@contractreport');
Route::get('/domainreport', 'Stock\ReportController@domainreport');
Route::get('/certificatereport', 'Stock\ReportController@certificatereport');
//Timeline
Route::post('/savecomment', 'DashboardController@register');
Route::get('/removecomment/{id}', 'DashboardController@delete');
//Contract Categories
Route::get('/contractcategories', 'Stock\ContractCategoryController@showCategoryForm');
Route::post('/savecontractcategoryregister', 'Stock\ContractCategoryController@register');
Route::get ( '/editcontractcategory/{id}',  'Stock\ContractCategoryController@showCategoryEditForm');
Route::post('/savecontractcategoryedit', 'Stock\ContractCategoryController@editcategory');
//Index Readjusment
Route::get('/index', 'Stock\IndexReadjustController@showIndexForm');
Route::post('/saveindexregister', 'Stock\IndexReadjustController@register');
Route::get ( '/editindex/{id}',  'Stock\IndexReadjustController@showIndexEditForm');
Route::post('/saveindexedit', 'Stock\IndexReadjustController@editindex');
//Contract
Route::get('/contract', 'Stock\ContractController@showContractForm');
Route::post('/savecontractregister', 'Stock\ContractController@register');
Route::get ( '/editcontract/{id}',  'Stock\ContractController@showContractEditForm');
Route::post('/savecontractedit', 'Stock\ContractController@editcontract');
Route::get ( '/contractlist', 'Stock\ContractController@showListContract');
Route::get ( '/showcontract/{id}', 'Stock\ContractController@showContractModal');
Route::post ('/deleteattach/{id}/{name}', 'Stock\ContractController@deletecontract');
//Domain
Route::get('/domain', 'Stock\DomainController@showDomainForm');
Route::post('/savedomainregister', 'Stock\DomainController@register');
Route::get ( '/domainlist', 'Stock\DomainController@showListDomain');
Route::get ( '/editdomain/{id}', 'Stock\DomainController@showDomainEditForm');
Route::post('/savedomainedit', 'Stock\DomainController@editdomain');
//Powerbi
Route::get('/statsmonthreport', 'Stock\ReportController@statsmonthreport');
Route::get('/overviewreport', 'Stock\ReportController@overviewreport');
//Certificate
Route::get('/certificates', 'Stock\CertificateController@showCertificateForm');
Route::post('/savecertificateregister', 'Stock\CertificateController@register');
Route::get ( '/certificatelist', 'Stock\CertificateController@showListCertificate');
Route::get ( '/editcertificate/{id}', 'Stock\CertificateController@showCertificateEditForm');
Route::post('/savecertificateedit', 'Stock\CertificateController@editcertificate');
//Licenses
Route::get('/license', 'Stock\LicenseController@showLicenseForm');
Route::post('/savelicenseregister', 'Stock\LicenseController@register');
Route::get ( '/editlicense/{id}',  'Stock\LicenseController@showLicenseEditForm');
Route::post('/savelicenseedit', 'Stock\LicenseController@editlicense');
Route::get ( '/licenselist', 'Stock\LicenseController@showListLicense');
Route::get ( '/showlicense/{id}', 'Stock\LicenseController@showLicenseModal');
Route::post ('/deleteattachlicense/{id}/{name}', 'Stock\LicenseController@deletelicense');
});
