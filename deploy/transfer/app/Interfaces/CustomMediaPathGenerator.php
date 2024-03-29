<?php

namespace App\Services;

use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator as BasePathGenerator;

class CustomMediaPathGenerator implements PathGenerator
{
    public function getPath(Media $media): string
    {
        //return 'uploads/' . $media->name . '.' . $media->extension();
        return $media->name;
    }

    public function getPathForConversions(Media $media): string
    {
        $path = $this->getPath($media);
        return "conversions/$path"; // اضافه کردن زیرپوشه "conversions" برای فایل های تبدیل شده
    }
}
