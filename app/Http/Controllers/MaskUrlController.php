<?php

namespace App\Http\Controllers;

use App\Models\TradespersonFile;
use Illuminate\Http\Request;
use Storage;

class MaskUrlController extends Controller
{
    public function trader_file(Request $request, $id)
    {
        try {
            $file = TradespersonFile::where('id',Hashids_decode($id))->first();
            $path = implode('/', array_slice(explode('/', $file->url), -2));

            if (!Storage::disk('s3')->exists($path)) {
                abort(404);
            }

            $fileContent = Storage::disk('s3')->get($path);

            $mimeType = Storage::disk('s3')->mimeType($path);

            return response($fileContent)->header('Content-Type', $mimeType);
        } catch (\Exception $e) {
            return abort(404);
        }
    }
}
