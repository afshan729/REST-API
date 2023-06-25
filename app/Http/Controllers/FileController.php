<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\File;

class FileController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'fileName' => 'required',
            'file' => 'required|file|max:' . config('app.MAX_FILE_SIZE'),
        ]);

        $fileName = $request->input('fileName');
        $file = $request->file('file');

        $filePath = $file->store(config('app.UPLOAD_DIR'));

        $existingFile = File::where('fileName', $fileName)->first();
        if ($existingFile) {
            Storage::delete($existingFile->filePath);
            $existingFile->update(['filePath' => $filePath]);
        } else {
            File::create(['fileName' => $fileName, 'filePath' => $filePath]);
        }

        return response()->json('File uploaded successfully', 201);
    }

    public function download($fileName)
    {
        $file = File::where('fileName', $fileName)->first();

        if (!$file) {
            return response()->json('File not found', 404);
        }

        return response()->download(storage_path('app/' . $file->filePath));
    }
}
