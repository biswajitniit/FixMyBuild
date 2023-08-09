<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Str;
use App\Models\TraderDetail;
use App\Models\TradespersonFile;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\Buildercategory;
use App\Rules\PhoneWithDialCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BuilderController extends Controller
{
    public function get_builders(Request $request){
        $data = Buildercategory::with('buildersubcategories')->where('status', 'Active')->get();
        return response()->json($data,200);
    }

    public function save_traders_details(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
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
            'user_id'                                   => 'required|integer',
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

        // $errors = new MessageBag();
        // if ($request->phone_office) {
        //     $phone_office = str_replace('-', '', str_replace(' ', '', substr($request->phone_office,1,-1)));
        //     if (!is_numeric($phone_office) || $request->phone_office[0] != '+')
        //         $errors->add('phone_office', 'Invalid office phone number provided.');
        // }

        // if ($validator->fails() || count($errors) != 0) {
            // $errors->merge($validator->errors());
            // return response()->json(['errors' => $errors], 422);
        // }

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try{
            $trader = TraderDetail::updateOrCreate(
                [
                    'user_id' => $request['user_id']
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
                $fileName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $s3FileName = Str::uuid().'.'.$extension;
                Storage::disk('s3')->put('Testfolder/'.$s3FileName, file_get_contents($file->getRealPath()));
                $path = Storage::disk('s3')->url('Testfolder/'.$s3FileName);

                TradespersonFile::updateOrCreate(
                    [
                        'tradesperson_id' => $request['user_id'],
                        'file_related_to' => 'company_logo',
                    ],
                    [
                        'tradesperson_id' => $request['user_id'],
                        'file_related_to' => 'company_logo',
                        'file_type'       => 'image',
                        'file_name'       => $fileName,
                        'file_extension'  => $extension,
                        'url'             => $path,
                    ]
                );
            }

            // Public Liability Insurance Upload
            $old_public_liability_insurances = TradespersonFile::where(['tradesperson_id' => $request['user_id'], 'file_related_to' => 'public_liability_insurance'])->get();
            foreach($request['public_liability_insurance_files'] as $file) {
                $fileName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $s3FileName = Str::uuid().'.'.$extension;
                $file_type = explode('/',mime_content_type($file->getRealPath()))[0];
                Storage::disk('s3')->put('Testfolder/'.$s3FileName, file_get_contents($file->getRealPath()));
                $path = Storage::disk('s3')->url('Testfolder/'.$s3FileName);

                TradespersonFile::create([
                    'tradesperson_id' => $request['user_id'],
                    'file_related_to' => 'public_liability_insurance',
                    'file_type'       => $file_type == 'image' ? 'image' : 'document',
                    'file_name'       => $fileName,
                    'file_extension'  => $extension,
                    'url'             => $path,
                ]);
            }
            foreach($old_public_liability_insurances as $file) {
                TradespersonFile::where('id', $file->id)->delete();
            }

            // Photo ID Proof Upload
            $old_photo_id_proof = TradespersonFile::where(['tradesperson_id' => $request['user_id'], 'file_related_to' => 'trader_img'])->get();
            foreach($request['photo_id_proof_files'] as $file) {
                $fileName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $s3FileName = Str::uuid().'.'.$extension;
                $file_type = explode('/',mime_content_type($file->getRealPath()))[0];
                Storage::disk('s3')->put('Testfolder/'.$s3FileName, file_get_contents($file->getRealPath()));
                $path = Storage::disk('s3')->url('Testfolder/'.$s3FileName);

                TradespersonFile::create([
                    'tradesperson_id' => $request['user_id'],
                    'file_related_to' => 'trader_img',
                    'file_type'       => $file_type == 'image' ? 'image' : 'document',
                    'file_name'       => $fileName,
                    'file_extension'  => $extension,
                    'url'             => $path,
                ]);
            }
            foreach($old_photo_id_proof as $file) {
                TradespersonFile::where('id', $file->id)->delete();
            }

            // Company Address Proof Upload
            $old_photo_id_proof = TradespersonFile::where(['tradesperson_id' => $request['user_id'], 'file_related_to' => 'company_address'])->get();
            foreach($request['company_addr_id_proof_files'] as $file) {
                $fileName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $s3FileName = Str::uuid().'.'.$extension;
                $file_type = explode('/',mime_content_type($file->getRealPath()))[0];
                Storage::disk('s3')->put('Testfolder/'.$s3FileName, file_get_contents($file->getRealPath()));
                $path = Storage::disk('s3')->url('Testfolder/'.$s3FileName);

                TradespersonFile::create([
                    'tradesperson_id' => $request['user_id'],
                    'file_related_to' => 'company_address',
                    'file_type'       => $file_type == 'image' ? 'image' : 'document',
                    'file_name'       => $fileName,
                    'file_extension'  => $extension,
                    'url'             => $path,
                ]);
            }
            foreach($old_photo_id_proof as $file) {
                TradespersonFile::where('id', $file->id)->delete();
            }

            return response()->json($trader, 200);
        } catch (\Exception $e) {
            return response()->json([$e->getMessage()],500);
        }
    }
}
