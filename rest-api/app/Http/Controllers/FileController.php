<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;


use App\Models\File;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function upload(Request $request)
    {
        $fileName = $request->input('fileName');
        $file = $request->file('file');

        if ($file) {
            $file->storeAs(config('app.upload_dir'), $fileName);
            return response()->json([], 201);
        }

        return response()->json(['error' => 'File not found'], 400);
    }


    public function download($fileName)
{
    $filePath = Storage::path(config('app.upload_dir') . '/' . $fileName);

    if (Storage::exists(config('app.upload_dir') . '/' . $fileName)) {
        return Response::download($filePath, $fileName, [], 'inline');
    }

    return response()->json(['error' => 'File not found'], 404);
}
}
