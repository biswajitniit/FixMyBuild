<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\TradespersonFile;


class DownloadController extends Controller
{
    public function downloadTraderFile(Request $request, $id)
    {
        try {
            $file = TradespersonFile::where('id', Hashids_decode($id))->first();
            $content_type = get_headers($file->url, 1)["Content-Type"];
            $headers = [
                'Content-Disposition' => 'attachment; filename="' . $file->file_name . '";',
                'Content-Type' => $content_type,
            ];

            return Response::make(file_get_contents($file->url), 200, $headers);
        } catch (\Exception $e) {
            return abort(404, 'File not found.');
        }
    }
}
