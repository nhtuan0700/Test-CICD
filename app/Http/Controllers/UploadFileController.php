<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadFileRequest;
use Illuminate\Http\Request;

class UploadFileController extends Controller
{
    public function upload(UploadFileRequest $request)
    {
        $file = $request->file('avatar');
        if ($file == null) {
            return response()->json('Can not upload', 404);
        }

        $path = $file->store('files', 'local');
        return response()->json([
            'path' => $path
        ]);
    }
}
