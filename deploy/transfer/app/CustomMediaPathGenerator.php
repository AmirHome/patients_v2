<?php

namespace App\Interfaces;

use Spatie\MediaLibrary\MediaCollections\Models\Media; // Import the correct Media class
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator as BasePathGenerator;

class CustomMediaPathGenerator implements BasePathGenerator
{
    public function getPath(Media $media): string
    {
        return '/';
    }

    public function getPathForConversions(Media $media): string
    {
        return "conversions/" . $this->getPath($media);
    }

    /*
     * Get the path for responsive images of the given media, relative to the root storage path.
     */
    public function getPathForResponsiveImages(Media $media): string
    {
        return "responsive-images/" . $this->getPath($media);
    }
}

