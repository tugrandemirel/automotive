<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class ImageHelpers
{
public static function upload($file, $path, $oldFile = null): string
{
        if (substr($path, -1) != '/') {
            $path .= '/';
        }
        if (!file_exists(public_path('images/'.$path))) {
            mkdir(public_path('images/'.$path), 0777, true);
        }
        $fileName = Str::uuid() . '_' . $file->getClientOriginalName();
        $file->move(public_path('images/'.$path), $fileName);
        if ($oldFile) {
            self::delete('images/'.$oldFile);
        }
        return 'images/'.$path . $fileName;
    }

    public static function delete($file): void
    {
        if (file_exists(public_path($file))) {
            unlink(public_path($file));
        }
    }

    public static function multipleDelete($files): void
    {
        foreach ($files as $file) {
            if (file_exists($file->path)) {
                unlink($file->path);
            }
        }
    }

}
