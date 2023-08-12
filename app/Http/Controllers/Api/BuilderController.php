<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Str;
use App\Models\TraderDetail;
use App\Models\TradespersonFile;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\Buildercategory;
use App\Models\Traderareas;
use App\Rules\PhoneWithDialCode;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class BuilderController extends Controller
{
    private function uploadFileAndCreateRecord($user_id, $file, $relatedTo, $updateOrCreate = false){
        $fileName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $s3FileName = Str::uuid().'.'.$extension;
        $file_type = explode('/', mime_content_type($file->getRealPath()))[0];
        Storage::disk('s3')->put('Testfolder/'.$s3FileName, file_get_contents($file->getRealPath()));
        $path = Storage::disk('s3')->url('Testfolder/'.$s3FileName);

        $data = [
            'tradesperson_id' => $user_id,
            'file_related_to' => $relatedTo,
            'file_type' => $file_type == 'image' ? 'image' : 'document',
            'file_name' => $fileName,
            'file_extension' => $extension,
            'url' => $path,
        ];

        if ($updateOrCreate) {
            TradespersonFile::updateOrCreate(
                [
                    'tradesperson_id' => $user_id,
                    'file_related_to' => $relatedTo,
                ],
                $data
            );
        } else {
            TradespersonFile::create($data);
        }
    }


    public function get_builders(Request $request){
        $data = Buildercategory::with('buildersubcategories')->where('status', 'Active')->get();
        return response()->json($data,200);
    }


    public function save_traders_details(Request $request){
        $validator = Validator::make($request->all(), [
            'comp_reg_no' => 'required',
            'comp_name' => 'required',
            'comp_address' => 'required',
            'trader_name' => 'required|string',
            'comp_description' => 'required',
            'name' => 'required',
            'phone_code' => 'required',
            'phone_number' => 'required',
            'phone_office' => 'required|string',
            'email' => 'required',
            'designation' => 'required',
            'vat_reg' => 'required',
            'vat_no' => 'required',
            'vat_comp_name' => 'required|string',
            'vat_comp_address' => 'required',
            'contingency' => 'required',
            'bnk_account_type' => 'required',
            'bnk_account_name' => 'required',
            'bnk_sort_code' => 'required|string',
            'bnk_account_number'=> 'required|string',
            'builder_amendment'=> 'required|string',
            'noti_new_quotes'=> 'required|string',
            'noti_quote_accepted'=> 'required|string',
            'noti_project_stopped'=> 'required|string',
            'noti_quote_rejected'=> 'required|string',
            'noti_project_cancelled'=> 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    }


    public function save_company_general_information(Request $request){
        $validator = Validator::make($request->all(), [
            'comp_reg_no'                               => 'required',
            'comp_name'                                 => 'required|string',
            'comp_address'                              => 'required|string',
            'trader_name'                               => 'required|string',
            'comp_description'                          => 'required|string',
            'company_logo'                              => 'sometimes|nullable|file|mimetypes:'.str_replace(' ', '', config('const.dropzone_accepted_image')),
            'public_liability_insurance_files'          => 'required|array',
            'public_liability_insurance_files.*'        => 'required|file|mimetypes:'.str_replace(' ', '', config('const.trader_public_liability')),
            'photo_id_proof_files'                      => 'required|array',
            'photo_id_proof_files.*'                    => 'required|file|mimetypes:'.str_replace(' ', '', config('const.dropzone_accepted_image')),
            'company_addr_id_proof_files'               => 'required|array',
            'company_addr_id_proof_files.*'             => 'required|file|mimetypes:'.str_replace(' ', '', config('const.company_address_proof')),
            'name'                                      => 'required|string',
            'phone_code'                                => 'required|string',
            'phone_number'                              => 'required',
            'phone_office'                              => ['sometimes','nullable', new PhoneWithDialCode()],
            'email'                                     => 'required|email:rfc,dns',
            'company_role'                              => 'required|in:Director,Tradesperson,Secretary,Other',
            'designation'                               => 'nullable|required_if:company_role,Other|string|max:255',
            'vat_reg'                                   => 'required|boolean',
            'vat_no'                                    => 'nullable|required_if:vat_reg,1|integer',
            'vat_comp_name'                             => 'nullable|required_if:vat_reg,1|string',
            'vat_comp_address'                          => 'nullable|required_if:vat_reg,1|string',
        ], [
            'comp_reg_no.required'                      => 'Please provide your company registration number and press the “Find” button.',
            'comp_name.required'                        => 'Please provide your company registration number and press the “Find” button.',
            'trader_name.required'                      => 'Please provide your trading name.',
            'comp_description.required'                 => 'Please provide a description about your company.',
            'company_role.required'                     => 'Please select your role in company.',
            'name.required'                             => 'Please enter your name.',
            'phone_code.required'                       => 'Please select your phone code.',
            'phone_number.required'                     => 'Please enter your phone number.',
            'email.required'                            => 'Please provide the email address to which customers can contact you.',
            'designation.required'                      => 'Please enter your designation.',
            'designation.max'                           => 'Designation shouldn\'t be longer than 255 characters.',
            'vat_reg.required'                          => 'Please enter your vat number and validate.',
            'vat_no.required'                           => 'If your company is VAT registered please provide the VAT number. If not, please click “No” on that option below.'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try{
            $trader = TraderDetail::updateOrCreate(
                [
                    'user_id' => $request->user()->id,
                ],
                [
                    'comp_reg_no'       => $request['comp_reg_no'],
                    'comp_name'         => $request['comp_name'],
                    'comp_address'      => $request['comp_address'],
                    'trader_name'       => $request['trader_name'],
                    'comp_description'  => $request['comp_description'],
                    'name'              => $request['name'],
                    'phone_code'        => $request['phone_code'],
                    'phone_number'      => $request['phone_number'],
                    'phone_office'      => $request['phone_office'],
                    'email'             => $request['email'],
                    'company_role'      => $request['company_role'],
                    'designation'       => $request['designation'],
                    'vat_reg'           => $request['vat_reg'],
                    'vat_no'            => $request['vat_no'],
                    'vat_comp_name'     => $request['vat_comp_name'],
                    'vat_comp_address'  => $request['vat_comp_address'],
                ]
            );

            // Company Logo Upload
            if ($request['company_logo']) {
                $file = $request['company_logo'];
                $this->uploadFileAndCreateRecord($request->user()->id, $file, 'company_logo', true);
            }

            // Public Liability Insurance Upload
            $old_public_liability_insurances = TradespersonFile::where(['tradesperson_id' => $request->user()->id, 'file_related_to' => 'public_liability_insurance'])->pluck('id');
            foreach ($request['public_liability_insurance_files'] as $file) {
                $this->uploadFileAndCreateRecord($request->user()->id, $file, 'public_liability_insurance');
            }
            TradespersonFile::whereIn('id', $old_public_liability_insurances)->delete();

            // Photo ID Proof Upload
            $old_photo_id_proofs = TradespersonFile::where(['tradesperson_id' => $request->user()->id, 'file_related_to' => 'trader_img'])->pluck('id');
            foreach ($request['photo_id_proof_files'] as $file) {
                $this->uploadFileAndCreateRecord($request->user()->id, $file, 'trader_img');
            }
            TradespersonFile::whereIn('id', $old_photo_id_proofs)->delete();

            // Company Address Proof Upload
            $old_company_addr_proofs = TradespersonFile::where(['tradesperson_id' => $request->user()->id, 'file_related_to' => 'company_address'])->pluck('id');
            foreach($request['company_addr_id_proof_files'] as $file) {
                $this->uploadFileAndCreateRecord($request->user()->id, $file, 'company_address');
            }
            TradespersonFile::whereIn('id', $old_company_addr_proofs)->delete();

            return response()->json($trader, 200);
        } catch (Exception $e) {
            return response()->json([$e->getMessage()],500);
        }
    }


    public function save_company_additional_information(Request $request){
        $validator = Validator::make($request->all(), [
            'team_photos'                               => 'required|array',
            'team_photos.*'                             => 'required|file|mimetypes:'.str_replace(' ', '', config('const.dropzone_accepted_image')),
            'prev_project_photos'                       => 'required|array',
            'prev_project_photos.*'                     => 'required|file|mimetypes:'.str_replace(' ', '', config('const.dropzone_accepted_image')),
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $old_team_photos = TradespersonFile::where(['tradesperson_id' => $request->user()->id, 'file_related_to' => 'team_img'])->pluck('id');
        foreach($request['team_photos'] as $file) {
            $this->uploadFileAndCreateRecord($request->user()->id, $file, 'team_img');
        }
        TradespersonFile::whereIn('id', $old_team_photos)->delete();

        $old_prev_project_photos = TradespersonFile::where(['tradesperson_id' => $request->user()->id, 'file_related_to' => 'team_img'])->pluck('id');
        foreach($request['prev_project_photos'] as $file) {
            $this->uploadFileAndCreateRecord($request->user()->id, $file, 'prev_project_img');
        }
        TradespersonFile::whereIn('id', $old_prev_project_photos)->delete();
    }


    public function get_areas(){
        try {
            $areas = DB::table('county_towns')
                        ->orderBy('county')
                        ->get()
                        ->groupBy('county')
                        ->map(function ($items, $county) {
                            $subAreas = $items->pluck('town')->sortBy(function ($town) {
                                return ($town === '' || $town === null) ? PHP_INT_MAX : $town;
                            })->values()->toArray();

                            return [
                                'county' => $county,
                                'town' => $subAreas
                            ];
                        })
                        ->values()
                        ->toArray();

          return response()->json($areas, 200);
        } catch(Exception $e) {
            return response()->json([$e->getMessage()], 500);
        }
    }


    public function get_categories_and_sub_categories(){
        try {
            Buildercategory::select('id', 'builder_category_name')->where(['status' => 1])->with('buildersubcategories')->get();
            $builderCategories = Buildercategory::select('id', 'builder_category_name')
                                                ->where('status', 1)
                                                ->with(['buildersubcategories' => function ($query) {
                                                    $query->select('id', 'builder_subcategory_name', 'builder_category_id')->where('status', 'Active');
                                                }])
                                                ->get()
                                                ->toArray();
            return response()->json($builderCategories, 200);
        } catch(Exception $e) {
            return response()->json([$e->getMessage()], 500);
        }
    }


    public function save_trader_areas(Request $request){
        $validator = Validator::make($request->all(), [
            'locationData'                 => 'required|array',
            'locationData.*'               => 'required',
            'locationData.*.county'        => 'required|string',
            'locationData.*.town'         => 'required|array',
            'locationData.*.town.*'       => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $old_trader_areas = Traderareas::where('user_id', $request->user()->id)->pluck('id');
            $user_id = $request->user()->id;
            foreach ($request['locationData'] as $entry) {
                $county = $entry['county'];
                foreach ($entry['town'] as $town) {
                    Traderareas::create([
                        'user_id' => $user_id,
                        'county' => $county,
                        'town' => $town,
                    ]);
                }
            }
            Traderareas::whereIn('id', $old_trader_areas)->delete();
        } catch (Exception $e) {
            return response()->json([$e->getMessage()],500);
        }
    }


    public function save_trader_works(){

    }
}
