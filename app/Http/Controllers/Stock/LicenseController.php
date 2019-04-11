<?php

namespace App\Http\Controllers\Stock;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Models\ContractCategory;
use App\Models\AttachmentLicense;
use App\Models\License;
use App\Models\Area;
use App\Models\Brand;
use Carbon\Carbon;
use Request;
use DB;

class LicenseController extends Controller
{
  public function __construct() {
      $this->middleware('auth');
  }

  public function showLicenseForm() {
      $dataarea = Area::all();
      $databrand = Brand::all();

  return view('stocks.licenses.license')->with(compact('dataarea','databrand'));
  }
  public function register(Request $request) {

      //Validar data
      $this->validator(Request::all())->validate();
      //Criar servidor no banco de dados
      $this->create(Request::all());
  return redirect('/licenselist');
  }

  protected function validator(array $data) {
      $rules = [
          'license_name' => 'required|string|max:30|unique:licenses',
          'brand_id' => 'required',
          'license_version' => 'required|string',
          'license_usage' => 'required|string',
          'area_id' => 'required',
          'license_keyuser' => 'required|string',
          'license_maintainer' => 'required|string',
          'license_qty' => 'required|numeric',
          'license_type' => 'required',
          'license_totalvalue' => 'required|numeric',
          'license_supportcontact' => 'required|string',
      ];

      $messages = [
          'required'=>'Este campo é obrigatório.',
          'string'=> 'Este campo deve ser do tipo texto.',
          'numeric'=> 'Este campo aceita apenas numerais.',
          'license_name.max'=>'O nome da licença deve conter no máximo 30 caracteres.',
          'license_name.unique'=>'O nome desta licença já existe.',
          ];
  return Validator::make($data, $rules, $messages);
      }

      protected function create(array $data) {

          //dd($date);
          License::create([
              'license_name' => $data['license_name'],
              'brand_id' => $data['brand_id'],
              'license_usage' => $data['license_usage'],
              'license_version' => $data['license_version'],
              'area_id' => $data['area_id'],
              'license_keyuser' => $data['license_keyuser'],
              'license_maintainer' => $data['license_maintainer'],
              'license_integration' => $data['license_integration'],
              'license_dbaccess' => $data['license_dbaccess'],
              'license_qty' => $data['license_qty'],
              'license_type' => $data['license_type'],
              'license_server' => $data['license_server'],
              'license_totalvalue' => $data['license_totalvalue'],
              'license_supportcontact' => $data['license_supportcontact'],
              'license_observation' => $data['license_observation'],
          ]);
          $lastinsert = DB::table("licenses")
          ->orderBy('id', 'desc')
          ->select('licenses.id')->first();

          if(Request::hasFile('attachments')) {
              $file = Request::file('attachments');
              $length= count($file);
          for ($i = 0; $i < $length; $i++) {
              $filename = $file[$i]->getClientOriginalName();
              $exists = Storage::exists('public/contracts/'.$filename);

           if($exists == true){
              $filename = rand(0, 999).'-'.$filename;
           }
              AttachmentLicense::create([
                  'attachment_name' => $filename,
                  'attachment_path' => '/storage/contracts',
                  'license_id' => $lastinsert->id,
              ]);
              $file[$i]->storeAs('public/contracts',  $filename);
          }
      }
      return;
      }

      public function showListLicense() {
          $lastlicense = DB::table('licenses')
          ->join('brands', 'brands.id', '=', 'licenses.brand_id')
          ->join('areas', 'areas.id', '=', 'licenses.area_id')
          ->orderby('licenses.updated_at', 'desc')
          ->select('licenses.*','brands.brand_name','areas.area_name')->first();
          $data =  DB::table('licenses')
          ->join('brands', 'brands.id', '=', 'licenses.brand_id')
          ->join('areas', 'areas.id', '=', 'licenses.area_id')
          ->orderby('licenses.updated_at', 'desc')
          ->select('licenses.*','brands.brand_name','areas.area_name')->get();
      return view('stocks.licenses.list-license')->with(compact('lastlicense', 'data'));
      }

      public function showLicenseEditForm($id) {
        $dataarea = Area::all();
        $databrand = Brand::all();
        $data =  DB::table('licenses')
        ->join('brands', 'brands.id', '=', 'licenses.brand_id')
        ->join('areas', 'areas.id', '=', 'licenses.area_id')
        ->orderby('licenses.updated_at', 'desc')
        ->where('licenses.id', '=', $id)
        ->select('licenses.*','brands.brand_name','areas.area_name')->get();

          $attachments = DB::table('attachment_licenses')
          ->where('attachment_licenses.license_id', '=', $id)
          ->select('attachment_licenses.*')->get();
      return view('stocks.licenses.edit-license')->with(compact('data','dataarea','databrand','attachments'));
      }

      public function editlicense(Request $request) {
         $this->validatorEdit(Request::all())->validate();
          //Criar servidor no banco de dados
          $data = $this->edit(Request::all());
          return redirect('/licenselist');
      }
      protected function validatorEdit(array $data) {
        $rules = [
            'license_name' => 'required|string|max:30',
            'brand_id' => 'required',
            'license_version' => 'required|string',
            'license_usage' => 'required|string',
            'area_id' => 'required',
            'license_keyuser' => 'required|string',
            'license_maintainer' => 'required|string',
            'license_qty' => 'required|numeric',
            'license_type' => 'required',
            'license_totalvalue' => 'required|numeric',
            'license_supportcontact' => 'required|string',
        ];

        $messages = [
            'required'=>'Este campo é obrigatório.',
            'string'=> 'Este campo deve ser do tipo texto.',
            'numeric'=> 'Este campo aceita apenas numerais.',
            'license_name.max'=>'O nome da licença deve conter no máximo 30 caracteres.',
            ];
            return Validator::make($data, $rules, $messages);
          }

          public function edit() {
              $data = Request::all();
             // dd($date);
              $edit = License::where('id', $data['id'])->first();
              $edit->license_name = $data['license_name'];
              $edit->brand_id = $data['brand_id'];
              $edit->license_usage = $data['license_usage'];
              $edit->license_version = $data['license_version'];
              $edit->area_id = $data['area_id'];
              $edit->license_keyuser = $data['license_keyuser'];
              $edit->license_maintainer = $data['license_maintainer'];
              $edit->license_integration = $data['license_integration'];
              $edit->license_dbaccess = $data['license_dbaccess'];
              $edit->license_qty = $data['license_qty'];
              $edit->license_type = $data['license_type'];
              $edit->license_server = $data['license_server'];
              $edit->license_totalvalue = $data['license_totalvalue'];
              $edit->license_supportcontact = $data['license_supportcontact'];
              $edit->license_observation = $data['license_observation'];

              $edit->save();
              if(Request::hasFile('attachments')) {
              $file = Request::file('attachments');
              $length= count($file);
          for ($i = 0; $i < $length; $i++) {
              $filename = $file[$i]->getClientOriginalName();
              $exists = Storage::exists('public/licenses/'.$filename);

           if($exists == true){
              $filename = rand(0, 999).'-'.$filename;
           }

              AttachmentLicense::create([
                  'attachment_name' => $filename,
                  'attachment_path' =>  '/storage/contracts',
                  'license_id' =>$data['id'],
              ]);

              $file[$i]->storeAs('public/contracts',  $filename);
          }
      }
    return Redirect::back();
  }
  public function deletelicense($id,$name) {
      $name = "public/contracts/$name";
      $delete = AttachmentLicense::where('id', $id)->delete();
      Storage::delete($name);
  return response(['id'=>$id]);
  }

  public function showLicenseModal($id) {

    $data =  DB::table('licenses')
    ->join('brands', 'brands.id', '=', 'licenses.brand_id')
    ->join('areas', 'areas.id', '=', 'licenses.area_id')
    ->orderby('licenses.updated_at', 'desc')
    ->where('licenses.id', '=', $id)
    ->select('licenses.*','brands.brand_name','areas.area_name')->get();

    $attachments = DB::table('attachment_licenses')
    ->where('attachment_licenses.license_id', '=', $id)
    ->select('attachment_licenses.*')->get();

    return view('stocks.licenses.show-license')->with(compact('data','attachments'));
  }

}
