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
use App\Models\Traderworks;
use App\Rules\PhoneWithDialCode;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Notification;
use App\Models\User;
use App\Models\Buildersubcategory;

class BuilderController extends BaseController
{
    private function upload_file_and_create_record($user_id, $file, $relatedTo, $updateOrCreate = false)
    {
        $fileName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $s3FileName = Str::uuid() . '.' . $extension;
        $file_type = explode('/', mime_content_type($file->getRealPath()))[0];
        Storage::disk('s3')->put(config('const.s3FolderName') . $s3FileName, file_get_contents($file->getRealPath()));
        $path = Storage::disk('s3')->url(config('const.s3FolderName') . $s3FileName);

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


    public function get_builders(Request $request)
    {
        $data = Buildercategory::with('buildersubcategories')->where('status', 'Active')->get();
        return response()->json($data, 200);
    }


    public function save_traders_details(Request $request)
    {
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
            'bnk_account_number' => 'required|string',
            'builder_amendment' => 'required|string',
            'noti_new_quotes' => 'required|string',
            'noti_quote_accepted' => 'required|string',
            'noti_project_stopped' => 'required|string',
            'noti_quote_rejected' => 'required|string',
            'noti_project_cancelled' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    }


    public function get_company_general_information(Request $request)
    {
        try {
            if (!isTrader($request->user()->customer_or_tradesperson)) {
                return $this->error("Access denied. This route is restricted to tradespersons only.", 403);
            }

            $trader = TraderDetail::where('user_id', $request->user()->id)->first();
            $trader_files = TradespersonFile::where('tradesperson_id', $request->user()->id)->get();

            $response = [
                "trader_detail" => $trader,
                "trader_files" => $trader_files,
            ];

            return response()->json($response, 200);
        } catch (Exception $e) {
            return $this->error(['error' => $e->getMessage()], 500);
        }
    }


    public function save_company_general_information(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'comp_reg_no' => 'required',
            'comp_name' => 'required|string',
            'comp_address' => 'required|string',
            'trader_name' => 'required|string',
            'comp_description' => 'required|string',
            'company_logo' => 'sometimes|nullable|file|mimetypes:' . str_replace(' ', '', config('const.dropzone_accepted_image')),
            'public_liability_insurance_files' => 'required|array',
            'public_liability_insurance_files.*' => 'required|file|mimetypes:' . str_replace(' ', '', config('const.trader_public_liability')),
            'photo_id_proof_files' => 'required|array',
            'photo_id_proof_files.*' => 'required|file|mimetypes:' . str_replace(' ', '', config('const.dropzone_accepted_image')),
            'company_addr_id_proof_files' => 'required|array',
            'company_addr_id_proof_files.*' => 'required|file|mimetypes:' . str_replace(' ', '', config('const.company_address_proof')),
            'name' => 'required|string',
            'phone_code' => 'required|string',
            'phone_number' => 'required',
            'phone_office' => ['sometimes', 'nullable', new PhoneWithDialCode()],
            'email' => 'required|email:rfc,dns',
            'company_role' => 'required|in:Director,Tradesperson,Secretary,Other',
            'designation' => 'nullable|required_if:company_role,Other|string|max:255',
            'vat_reg' => 'required|boolean',
            'vat_no' => 'nullable|required_if:vat_reg,1|integer',
            'vat_comp_name' => 'nullable|required_if:vat_reg,1|string',
            'vat_comp_address' => 'nullable|required_if:vat_reg,1|string',
        ], [
            'comp_reg_no.required' => 'Please provide your company registration number and press the “Find” button.',
            'comp_name.required' => 'Please provide your company registration number and press the “Find” button.',
            'trader_name.required' => 'Please provide your trading name.',
            'comp_description.required' => 'Please provide a description about your company.',
            'company_role.required' => 'Please select your role in company.',
            'name.required' => 'Please enter your name.',
            'phone_code.required' => 'Please select your phone code.',
            'phone_number.required' => 'Please enter your phone number.',
            'email.required' => 'Please provide the email address to which customers can contact you.',
            'designation.required' => 'Please enter your designation.',
            'designation.max' => 'Designation shouldn\'t be longer than 255 characters.',
            'vat_reg.required' => 'Please enter your vat number and validate.',
            'vat_no.required' => 'If your company is VAT registered please provide the VAT number. If not, please click “No” on that option below.'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            DB::beginTransaction();

            $trader = TraderDetail::updateOrCreate(
                [
                    'user_id' => $request->user()->id,
                ],
                [
                    'comp_reg_no' => $request['comp_reg_no'],
                    'comp_name' => $request['comp_name'],
                    'comp_address' => $request['comp_address'],
                    'trader_name' => $request['trader_name'],
                    'comp_description' => $request['comp_description'],
                    'name' => $request['name'],
                    'phone_code' => $request['phone_code'],
                    'phone_number' => $request['phone_number'],
                    'phone_office' => $request['phone_office'],
                    'email' => $request['email'],
                    'company_role' => $request['company_role'],
                    'designation' => $request['company_role'] == 'Other' ? $request['designation'] : null,
                    'vat_reg' => $request['vat_reg'],
                    'vat_no' => $request['vat_reg'] ? $request['vat_no'] : null,
                    'vat_comp_name' => $request['vat_reg'] ? $request['vat_comp_name'] : null,
                    'vat_comp_address' => $request['vat_reg'] ? $request['vat_comp_address'] : null,
                ]
            );

            // Company Logo Upload
            $old_company_logo = TradespersonFile::where(['tradesperson_id' => $request->user()->id, 'file_related_to' => 'company_logo'])->select('id', 'url')->first();
            $file = $request['company_logo'];
            if ($file) {
                $this->upload_file_and_create_record($request->user()->id, $file, 'company_logo', true);
            }

            if ($old_company_logo) {
                Storage::disk('s3')->delete(parse_url($old_company_logo->url, PHP_URL_PATH));
                TradespersonFile::where('id', $old_company_logo->id)->delete();
            }

            $company_logo = TradespersonFile::where(['tradesperson_id' => $request->user()->id, 'file_related_to' => 'company_logo'])->value('url');
            $user = User::find($request->user()->id);
            $user->profile_image = $company_logo;
            $user->save();

            // Public Liability Insurance Upload
            $old_public_liability_insurances = TradespersonFile::where(['tradesperson_id' => $request->user()->id, 'file_related_to' => 'public_liability_insurance'])->pluck('id', 'url');
            foreach ($request['public_liability_insurance_files'] as $file) {
                $this->upload_file_and_create_record($request->user()->id, $file, 'public_liability_insurance');
            }
            $old_pli_media_paths = $old_public_liability_insurances->map(function ($id, $url) {
                return parse_url($url, PHP_URL_PATH);
            })->toArray();
            Storage::disk('s3')->delete($old_pli_media_paths);
            TradespersonFile::whereIn('id', $old_public_liability_insurances->values())->delete();

            // Photo ID Proof Upload
            $old_photo_id_proofs = TradespersonFile::where(['tradesperson_id' => $request->user()->id, 'file_related_to' => 'trader_img'])->pluck('id', 'url');
            foreach ($request['photo_id_proof_files'] as $file) {
                $this->upload_file_and_create_record($request->user()->id, $file, 'trader_img');
            }
            $old_photo_id_media_paths = $old_photo_id_proofs->map(function ($id, $url) {
                return parse_url($url, PHP_URL_PATH);
            })->toArray();
            Storage::disk('s3')->delete($old_photo_id_media_paths);
            TradespersonFile::whereIn('id', $old_photo_id_proofs->values())->delete();

            // Company Address Proof Upload
            $old_company_addr_proofs = TradespersonFile::where(['tradesperson_id' => $request->user()->id, 'file_related_to' => 'company_address'])->pluck('id', 'url');
            foreach ($request['company_addr_id_proof_files'] as $file) {
                $this->upload_file_and_create_record($request->user()->id, $file, 'company_address');
            }
            $old_company_addr_media_paths = $old_company_addr_proofs->map(function ($id, $url) {
                return parse_url($url, PHP_URL_PATH);
            })->toArray();
            Storage::disk('s3')->delete($old_company_addr_media_paths);
            TradespersonFile::whereIn('id', $old_company_addr_proofs->values())->delete();

            DB::commit();

            return response()->json(['message' => 'Information saved successfully.'], 200);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function update_company_general_information(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'comp_reg_no' => 'required',
            'comp_name' => 'required|string',
            'comp_address' => 'required|string',
            'trader_name' => 'required|string',
            'comp_description' => 'required|string',
            'company_logo' => 'sometimes|nullable|file|mimetypes:' . str_replace(' ', '', config('const.dropzone_accepted_image')),
            'public_liability_insurance_files' => 'sometimes|nullable|array',
            'public_liability_insurance_files.*' => 'sometimes|nullable|file|mimetypes:' . str_replace(' ', '', config('const.trader_public_liability')),
            'photo_id_proof_files' => 'sometimes|nullable|array',
            'photo_id_proof_files.*' => 'sometimes|nullable|file|mimetypes:' . str_replace(' ', '', config('const.dropzone_accepted_image')),
            'company_addr_id_proof_files' => 'sometimes|nullable|array',
            'company_addr_id_proof_files.*' => 'sometimes|nullable|file|mimetypes:' . str_replace(' ', '', config('const.company_address_proof')),
            'name' => 'required|string',
            'phone_code' => 'required|string',
            'phone_number' => 'required',
            'phone_office' => ['sometimes', 'nullable', new PhoneWithDialCode()],
            'email' => 'required|email:rfc,dns',
            'company_role' => 'required|in:Director,Tradesperson,Secretary,Other',
            'designation' => 'nullable|required_if:company_role,Other|string|max:255',
            'vat_reg' => 'required|boolean',
            'vat_no' => 'nullable|required_if:vat_reg,1|integer',
            'vat_comp_name' => 'nullable|required_if:vat_reg,1|string',
            'vat_comp_address' => 'nullable|required_if:vat_reg,1|string',
            'delete_image_ids' => 'nullable|string',
        ], [
            'comp_reg_no.required' => 'Please provide your company registration number and press the “Find” button.',
            'comp_name.required' => 'Please provide your company registration number and press the “Find” button.',
            'trader_name.required' => 'Please provide your trading name.',
            'comp_description.required' => 'Please provide a description about your company.',
            'company_role.required' => 'Please select your role in company.',
            'name.required' => 'Please enter your name.',
            'phone_code.required' => 'Please select your phone code.',
            'phone_number.required' => 'Please enter your phone number.',
            'email.required' => 'Please provide the email address to which customers can contact you.',
            'designation.required' => 'Please enter your designation.',
            'designation.max' => 'Designation shouldn\'t be longer than 255 characters.',
            'vat_reg.required' => 'Please enter your vat number and validate.',
            'vat_no.required' => 'If your company is VAT registered please provide the VAT number. If not, please click “No” on that option below.'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }


        try {
            $delete_image_ids = $request->delete_image_ids;
            if (gettype($delete_image_ids) != 'array') {
                $delete_image_ids = json_decode($delete_image_ids);
            }

            DB::beginTransaction();

            $trader = TraderDetail::updateOrCreate(
                [
                    'user_id' => $request->user()->id,
                ],
                [
                    'comp_reg_no' => $request['comp_reg_no'],
                    'comp_name' => $request['comp_name'],
                    'comp_address' => $request['comp_address'],
                    'trader_name' => $request['trader_name'],
                    'comp_description' => $request['comp_description'],
                    'name' => $request['name'],
                    'phone_code' => $request['phone_code'],
                    'phone_number' => $request['phone_number'],
                    'phone_office' => $request['phone_office'],
                    'email' => $request['email'],
                    'company_role' => $request['company_role'],
                    'designation' => $request['company_role'] == 'Other' ? $request['designation'] : null,
                    'vat_reg' => $request['vat_reg'],
                    'vat_no' => $request['vat_reg'] ? $request['vat_no'] : null,
                    'vat_comp_name' => $request['vat_reg'] ? $request['vat_comp_name'] : null,
                    'vat_comp_address' => $request['vat_reg'] ? $request['vat_comp_address'] : null,
                ]
            );

            // Company Logo Upload
            $old_company_logo = TradespersonFile::where(['tradesperson_id' => $request->user()->id, 'file_related_to' => 'company_logo'])->select('id', 'url')->first();
            $file = $request['company_logo'];
            if ($file) {
                $this->upload_file_and_create_record($request->user()->id, $file, 'company_logo', true);
            }

            if ($old_company_logo) {
                Storage::disk('s3')->delete(parse_url($old_company_logo->url, PHP_URL_PATH));
                TradespersonFile::where('id', $old_company_logo->id)->delete();
            }

            $company_logo = TradespersonFile::where(['tradesperson_id' => $request->user()->id, 'file_related_to' => 'company_logo'])->value('url');
            $user = User::find($request->user()->id);
            $user->profile_image = $company_logo;
            $user->save();

            // Public Liability Insurance Upload
            $old_public_liability_insurances = TradespersonFile::where(['tradesperson_id' => $request->user()->id, 'file_related_to' => 'public_liability_insurance'])->pluck('id', 'url');
            if ($request['public_liability_insurance_files']) {
                foreach ($request['public_liability_insurance_files'] as $file) {
                    $this->upload_file_and_create_record($request->user()->id, $file, 'public_liability_insurance');
                }
            }
            if ($old_public_liability_insurances && $delete_image_ids) {
                $old_pli_media_paths = $old_public_liability_insurances->map(function ($id, $url) use ($delete_image_ids) {
                    if (in_array($id, $delete_image_ids))
                        return parse_url($url, PHP_URL_PATH);
                })->toArray();
                Storage::disk('s3')->delete($old_pli_media_paths);
                TradespersonFile::whereIn('id', $delete_image_ids)->where('file_related_to', 'public_liability_insurance')->delete();
            }

            // Photo ID Proof Upload
            $old_photo_id_proofs = TradespersonFile::where(['tradesperson_id' => $request->user()->id, 'file_related_to' => 'trader_img'])->pluck('id', 'url');
            if ($request['photo_id_proof_files']) {
                foreach ($request['photo_id_proof_files'] as $file) {
                    $this->upload_file_and_create_record($request->user()->id, $file, 'trader_img');
                }
            }

            if ($old_photo_id_proofs && $delete_image_ids) {
                $old_photo_id_media_paths = $old_photo_id_proofs->map(function ($id, $url) use ($delete_image_ids) {
                    if (in_array($id, $delete_image_ids))
                        return parse_url($url, PHP_URL_PATH);
                })->toArray();
                Storage::disk('s3')->delete($old_photo_id_media_paths);
                TradespersonFile::whereIn('id', $delete_image_ids)->where('file_related_to', 'trader_img')->delete();
            }

            // Company Address Proof Upload
            $old_company_addr_proofs = TradespersonFile::where(['tradesperson_id' => $request->user()->id, 'file_related_to' => 'company_address'])->pluck('id', 'url');
            if ($request['company_addr_id_proof_files']) {
                foreach ($request['company_addr_id_proof_files'] as $file) {
                    $this->upload_file_and_create_record($request->user()->id, $file, 'company_address');
                }
            }

            if ($old_company_addr_proofs && $delete_image_ids) {
                $old_company_addr_media_paths = $old_company_addr_proofs->map(function ($id, $url) use ($delete_image_ids) {
                    if (in_array($id, $delete_image_ids))
                        return parse_url($url, PHP_URL_PATH);
                })->toArray();
                Storage::disk('s3')->delete($old_company_addr_media_paths);
                TradespersonFile::whereIn('id', $delete_image_ids)->where('file_related_to', 'company_address')->delete();
            }

            DB::commit();

            return response()->json(['message' => 'Information saved successfully.'], 200);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function get_company_additional_information(Request $request)
    {
        try {
            if (!isTrader($request->user()->customer_or_tradesperson)) {
                return $this->error("Access denied. This route is restricted to tradespersons only.", 403);
            }

            $response = TradespersonFile::where(['tradesperson_id' => $request->user()->id])
                ->whereIn('file_related_to', ['team_img', 'prev_project_img'])
                ->get();

            return response()->json($response, 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function save_company_additional_information(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'team_photos' => 'required|array',
                'team_photos.*' => 'required|file|mimetypes:' . str_replace(' ', '', config('const.dropzone_accepted_image')),
                'prev_project_photos' => 'required|array',
                'prev_project_photos.*' => 'required|file|mimetypes:' . str_replace(' ', '', config('const.dropzone_accepted_image')),
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $old_team_photos = TradespersonFile::where(['tradesperson_id' => $request->user()->id, 'file_related_to' => 'team_img'])->pluck('id');
            foreach ($request['team_photos'] as $file) {
                $this->upload_file_and_create_record($request->user()->id, $file, 'team_img');
            }
            TradespersonFile::whereIn('id', $old_team_photos)->delete();

            $old_prev_project_photos = TradespersonFile::where(['tradesperson_id' => $request->user()->id, 'file_related_to' => 'prev_project_img'])->pluck('id');
            foreach ($request['prev_project_photos'] as $file) {
                $this->upload_file_and_create_record($request->user()->id, $file, 'prev_project_img');
            }
            TradespersonFile::whereIn('id', $old_prev_project_photos)->delete();

            return response()->json(['message' => 'Information saved successfully.'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function update_company_additional_information(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'team_photos' => 'nullable|array',
                'team_photos.*' => 'nullable|file|mimetypes:' . str_replace(' ', '', config('const.dropzone_accepted_image')),
                'prev_project_photos' => 'nullable|array',
                'prev_project_photos.*' => 'nullable|file|mimetypes:' . str_replace(' ', '', config('const.dropzone_accepted_image')),
                'delete_image_ids' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $delete_image_ids = $request->delete_image_ids;
            if (gettype($delete_image_ids) != 'array') {
                $delete_image_ids = json_decode($request->delete_image_ids);
            }

            $old_team_photos = TradespersonFile::where(['tradesperson_id' => $request->user()->id, 'file_related_to' => 'team_img'])->pluck('id');

            if ($request['team_photos']) {
                foreach ($request['team_photos'] as $file) {
                    $this->upload_file_and_create_record($request->user()->id, $file, 'team_img');
                }
            }

            if ($old_team_photos && $delete_image_ids) {
                $old_team_media_paths = $old_team_photos->map(function ($id, $url) use ($delete_image_ids) {
                    if (in_array($id, $delete_image_ids))
                        return parse_url($url, PHP_URL_PATH);
                })->toArray();
                Storage::disk('s3')->delete($old_team_media_paths);
                TradespersonFile::whereIn('id', $delete_image_ids)->where('file_related_to', 'team_img')->delete();
            }

            $old_prev_project_photos = TradespersonFile::where(['tradesperson_id' => $request->user()->id, 'file_related_to' => 'prev_project_img'])->pluck('id');
            if ($request['prev_project_photos']) {
                foreach ($request['prev_project_photos'] as $file) {
                    $this->upload_file_and_create_record($request->user()->id, $file, 'prev_project_img');
                }
            }

            if ($old_prev_project_photos && $delete_image_ids) {
                $old_prev_project_media_paths = $old_prev_project_photos->map(function ($id, $url) use ($delete_image_ids) {
                    if (in_array($id, $delete_image_ids))
                        return parse_url($url, PHP_URL_PATH);
                })->toArray();
                Storage::disk('s3')->delete($old_prev_project_media_paths);
                TradespersonFile::whereIn('id', $delete_image_ids)->where('file_related_to', 'prev_project_img')->delete();
            }

            return response()->json(['message' => 'Information saved successfully.'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }


    public function get_areas()
    {
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
        } catch (Exception $e) {
            return response()->json([$e->getMessage()], 500);
        }
    }


    public function get_categories_and_sub_categories()
    {
        try {
            Buildercategory::select('id', 'builder_category_name')->where(['status' => 1])->with('buildersubcategories')->get();
            $builderCategories = Buildercategory::select('id', 'builder_category_name')
                ->where('status', 1)
                ->with([
                    'buildersubcategories' => function ($query) {
                        $query->select('id', 'builder_subcategory_name', 'builder_category_id')->where('status', 'Active');
                    }
                ])
                ->get()
                ->toArray();
            return response()->json($builderCategories, 200);
        } catch (Exception $e) {
            return response()->json([$e->getMessage()], 500);
        }
    }


    public function get_trader_areas(Request $request)
    {
        try {
            if (!isTrader($request->user()->customer_or_tradesperson)) {
                return $this->error("Access denied. This route is restricted to tradespersons only.", 403);
            }

            $response = Traderareas::where('user_id', $request->user()->id)
                    ->select('county', 'town')
                    ->orderBy('county', 'asc')
                    ->orderBy('town', 'asc')
                    ->get()
                    ->groupBy('county')

                    ->map(function ($items, $county) {
                        return [
                            "county" => $county,
                            "towns" => $items->pluck('town')->toArray(),
                            "town_count" => $items->count()
                        ];
                    })->values();

            return response()->json($response, 200);
        } catch (Exception $e) {
            return response()->json([$e->getMessage()], 500);
        }
    }


    public function save_trader_areas(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'locationData' => 'required|array',
            'locationData.*' => 'required',
            'locationData.*.county' => 'required|string',
            'locationData.*.town' => 'required|array',
            'locationData.*.town.*' => 'nullable|string',
        ], [
            'locationData.*.county' => 'Please select the areas you cover.',
            'locationData.*.town' => 'Please select the areas you cover.',
            'locationData.*.town.*' => 'Please select the areas you cover.',
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
                        'town' => $town ?? 'Others',
                    ]);
                }
            }
            Traderareas::whereIn('id', $old_trader_areas)->delete();
            User::where('id', $request->user()->id)->update(['steps_completed' => "2"]);

            return response()->json(['message' => 'Information saved successfully.'], 200);
        } catch (Exception $e) {
            return response()->json([$e->getMessage()], 500);
        }
    }


    public function get_trader_works(Request $request)
    {
        try {
            if (!isTrader($request->user()->customer_or_tradesperson)) {
                return $this->error("Access denied. This route is restricted to tradespersons only.", 403);
            }

            $sub_category_id = Traderworks::where('user_id', $request->user()->id)->pluck('buildersubcategory_id');

            $categories_list = Buildersubcategory::select('builder_category_id', DB::raw('GROUP_CONCAT(id) as builder_subcategory_ids'), DB::raw('COUNT(id) as builder_subcategory_id_count'))
            ->whereIn('id', $sub_category_id)
            ->groupBy('builder_category_id')
            ->get();

            foreach ($categories_list as $item) {
                $item->builder_subcategory_ids = array_map('intval', explode(',', $item->builder_subcategory_ids));
            }

            return response()->json($categories_list, 200);
        } catch (Exception $e) {
            return response()->json([$e->getMessage()], 500);
        }
    }


    public function save_trader_works(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'works' => 'required|array',
            'works.*' => 'required|integer'
        ], [
            'works' => 'Please select the works you do.',
            'works.*.required' => 'Please select the works you do.',
            'works.*.integer' => 'Please send the sub category id.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $old_trader_works = Traderworks::where('user_id', $request->user()->id)->pluck('id');
            foreach ($request['works'] as $work) {
                Traderworks::create([
                    'user_id' => $request->user()->id,
                    'buildersubcategory_id' => $work,
                ]);
            }
            Traderworks::whereIn('id', $old_trader_works)->delete();
            return response()->json(['message' => 'Information saved successfully.'], 200);
        } catch (Exception $e) {
            return response()->json([$e->getMessage()], 500);
        }
    }


    public function get_default_contingency(Request $request)
    {
        try {
            if (!isTrader($request->user()->customer_or_tradesperson)) {
                return $this->error("Access denied. This route is restricted to tradespersons only.", 403);
            }

            $contingency = TraderDetail::where('user_id', $request->user()->id)->value('contingency');

            return response()->json(['contingency' => $contingency], 200);
        } catch (Exception $e) {
            return response()->json([$e->getMessage()], 500);
        }
    }


    public function save_default_contingency(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'contingency' => 'required|numeric|between:0,100',
        ], [
            'contingency.required' => 'Please enter contingency.',
            'contingency.between' => 'The amount of contingency can be between 0% and 100%.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            DB::beginTransaction();

            TraderDetail::where('user_id', $request->user()->id)->update(['contingency' => $request->contingency]);

            $user = User::where('id', $request->user()->id)->firstOrFail();
            $user->steps_completed = 2;
            $user->save();

            DB::commit();

            return response()->json(['message' => 'Information saved successfully.'], 200);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json([$e->getMessage()], 500);
        }
    }


    public function get_bank_details(Request $request)
    {
        try {
            if (!isTrader($request->user()->customer_or_tradesperson)) {
                return $this->error("Access denied. This route is restricted to tradespersons only.", 403);
            }

            $bank_details = TraderDetail::where('user_id', $request->user()->id)
                ->select(
                    'bnk_account_type',
                    'bnk_account_name',
                    'bnk_sort_code',
                    'bnk_account_number',
                    'builder_amendment'
                )
                ->first();
            return response()->json($bank_details, 200);
        } catch (Exception $e) {
            return response()->json([$e->getMessage()], 500);
        }

    }


    public function save_bank_details(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'bnk_account_type' => 'required|string',
            'bnk_account_name' => 'required|string',
            'bnk_sort_code' => 'required|integer|digits:6',
            'bnk_account_number' => 'required|integer|digits:8',
            'builder_amendment' => 'required|boolean'
        ], [
            'bnk_account_type.required' => 'Please select your bank account type.',
            'bnk_account_name.required' => 'Please enter your account holder name.',
            'bnk_sort_code.required' => 'Please enter your bank sort code.',
            'bnk_sort_code.integer' => 'Invalid bank sort code.',
            'bnk_sort_code.digits' => 'Bank sort code must be 6 digits in length.',
            'bnk_account_number.required' => 'Please enter your bank account number.',
            'bnk_account_number.digits' => 'We support UK bank account numbers that are 8 digits in length. If you have a shorter account number, please check with your bank if the number can be padded with 0s in front and be 8 digits in length.',
            'bnk_account_number.integer' => 'We support UK bank account numbers that are 8 digits in length. If you have a shorter account number, please check with your bank if the number can be padded with 0s in front and be 8 digits in length.',
            'builder_amendment.required' => 'Please confirm that the account belongs to you / your company and the details provided are correct.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            DB::beginTransaction();

            $traderdetails = TraderDetail::where('user_id', $request->user()->id)->first();
            $traderdetails->bnk_account_type = $request->bnk_account_type;
            $traderdetails->bnk_account_name = $request->bnk_account_name;
            $traderdetails->bnk_sort_code = $request->bnk_sort_code;
            $traderdetails->bnk_account_number = $request->bnk_account_number;
            $traderdetails->builder_amendment = $request->builder_amendment ?? 0;
            $traderdetails->save();

            $user = User::where('id', $request->user()->id)->firstOrFail();
            $user->steps_completed = 3;
            $user->save();

            DB::commit();

            return response()->json(['message' => 'Information saved successfully.'], 200);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json([$e->getMessage()], 500);
        }

    }



    public function save_notification_settings(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'noti_new_quotes' => 'required|boolean',
            'noti_quote_accepted' => 'required|boolean',
            'noti_project_stopped' => 'required|boolean',
            'noti_quote_rejected' => 'required|boolean',
            'noti_project_cancelled' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $notification = [
                // Receive these notifications as a Tradesperson
                'noti_new_quotes' => $request->noti_new_quotes,
                'noti_quote_accepted' => $request->noti_quote_accepted,
                'noti_project_stopped' => $request->noti_project_stopped,
                'noti_quote_rejected' => $request->noti_quote_rejected,
                'noti_project_cancelled' => $request->noti_project_cancelled,
                'noti_share_contact_info' => config('const.trader_notification_share_contact_info'),
                'noti_new_message' => config('const.trader_notification_trader_new_message'),

                // Receive these notifications as a Customer
                'reviewed' => config('const.trader_notification_reviewed'),
                'paused' => config('const.trader_notification_paused'),
                'project_milestone_complete' => config('const.trader_notification_project_milestone_complete'),
                'project_complete' => config('const.trader_notification_project_complete'),
                'project_new_message' => config('const.trader_notification_project_new_message'),
            ];
            Notification::updateOrCreate(['user_id' => $request->user()->id], ['settings' => $notification]);

            User::where('id', $request->user()->id)->update(['steps_completed' => "3"]);

            return response()->json(['message' => 'Information saved successfully.'], 200);
        } catch (Exception $e) {
            return response()->json([$e->getMessage()], 500);
        }
    }


    public function save_settings(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'noti_new_quotes' => 'required|boolean',
            'noti_quote_accepted' => 'required|boolean',
            'noti_project_stopped' => 'required|boolean',
            'noti_quote_rejected' => 'required|boolean',
            'noti_project_cancelled' => 'required|boolean',
            'reviewed' => 'required|boolean',
            'paused' => 'required|boolean',
            'project_milestone_complete' => 'required|boolean',
            'project_complete' => 'required|boolean',
            'project_new_message' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            if (!isTrader($request->user()->customer_or_tradesperson)) {
                return $this->error(['message' => 'You are not a trader'], 403);
            }

            $notification = [
                // Receive these notifications as a Tradesperson
                'noti_new_quotes' => $request->noti_new_quotes,
                'noti_quote_accepted' => $request->noti_quote_accepted,
                'noti_project_stopped' => $request->noti_project_stopped,
                'noti_quote_rejected' => $request->noti_quote_rejected,
                'noti_project_cancelled' => $request->noti_project_cancelled,
                'noti_share_contact_info' => $request->noti_share_contact_info,
                'noti_new_message' => $request->noti_new_message,

                // Receive these notifications as a Customer
                'reviewed' => $request->reviewed,
                'paused' => $request->paused,
                'project_milestone_complete' => $request->project_milestone_complete,
                'project_complete' => $request->project_complete,
                'project_new_message' => $request->project_new_message,
            ];
            Notification::updateOrCreate(['user_id' => $request->user()->id], ['settings' => $notification]);

            User::where('id', $request->user()->id)->update(['steps_completed' => "3"]);

            return response()->json(['message' => 'Settings saved successfully.'], 200);
        } catch (Exception $e) {
            return response()->json([$e->getMessage()], 500);
        }
    }


    public function get_company_details(Request $request, $trader_id)
    {
        try {
            $trader = User::find($trader_id);
            if (!$trader) {
                return $this->error(['message' => 'Trader not found'], 404);
            }

            if (!isTrader($trader->customer_or_tradesperson)) {
                return $this->error(['message' => 'This is not a trader account'], 403);
            }

            $trader_details = TraderDetail::where('user_id', $trader_id)->first();
            $trader_files = TradespersonFile::where('tradesperson_id', $trader_id)->whereIn('file_related_to', ['team_img', 'prev_project_img'])->get();

            return $this->success([
                'trader' => $trader,
                'trader_details' => $trader_details,
                'trader_files' => $trader_files
            ]);

        } catch (Exception $e) {
            return $this->error(['errors' => $e->getMessage()], 500);
        }
    }
}
