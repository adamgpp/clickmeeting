<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Gumlet\ImageResize;


final class FileResizerService
{
    private const MAX_HEIGHT_OR_WIDTH = 150;

    public function resize(UploadedFile $file): ImageResize
    {
        $image = new ImageResize($file->getPathname());
        $image->resizeToLongSide(self::MAX_HEIGHT_OR_WIDTH);
        return $image;
    }
}
