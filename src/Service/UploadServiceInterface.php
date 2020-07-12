<?php

declare(strict_types=1);

namespace App\Service;

use SplFileInfo;

interface UploadServiceInterface
{
    public function upload(SplFileInfo $file): void;
}
