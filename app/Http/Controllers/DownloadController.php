<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{
    Response,
    Storage
};
use App\Models\TradespersonFile;


class DownloadController extends Controller
{
    public function downloadFile(Request $request, $id)
    {
        $file = TradespersonFile::where('id', Hashids_decode($id))->first();

        $content_type = get_headers($file->url, 1)["Content-Type"];
        header('Content-Disposition: attachment; filename="'.$file->file_name.'";');
        header('Content-Type: ' . $content_type);
        echo file_get_contents($file->url);
    }

}
