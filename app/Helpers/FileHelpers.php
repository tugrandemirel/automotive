<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FileHelpers
{
    public static function upload($file, $folder, $fileName)
    {
        if ($file->isValid()) {
            if (substr($folder, -1) === "/")
                $folder = substr($folder, 0, -1);

            // Yeni dosyayı yükle
            $fileName = date("Y-m-d"). '-' . time() . '-' . $fileName;

            $filePath = Storage::disk('public')->putFileAs($folder, $file, $fileName);
            return 'storage/'.$filePath;
        }
        return null;
    }

    public static function deleteFile($filePath)
    {
        if (File::exists(public_path($filePath))) {
            File::delete(public_path($filePath));
        }
    }
}
