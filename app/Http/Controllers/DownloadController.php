<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function download()
    {
        $file = public_path('carval.apk');
        $headers = [
            'Content-Type' => 'application/vnd.android.package-archive',
        ];

        return response()->download($file, 'carval.apk', $headers);
    }
}
