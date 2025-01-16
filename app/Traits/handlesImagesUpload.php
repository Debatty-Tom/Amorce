<?php

namespace App\Traits;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

trait handlesImagesUpload
{
    static public function imageStoreVariant(string $string): void
    {

        $sizes = Config::get('images.sizes');
        foreach ($sizes as $size => $value) {
            if (!is_int($value)) {
                continue;
            }
            $image = Image::read(Storage::get($string));

            $image->cover($value, $value);

            $file_path = str_replace('original', $size, $string);
            $directoryPath = dirname($file_path);

            if (!Storage::exists($directoryPath)) {
                Storage::MakeDirectory($directoryPath);
            }
            Storage::put($file_path, $image->encode());
        }
    }

}
