<?php

declare(strict_types=1);

namespace App\Service;

use BadMethodCallException;

final class DropboxUploadService implements UploadServiceInterface
{
    public function upload(\SplFileInfo $file): void
    {
        throw new BadMethodCallException('Not implemented yet!');
    }
}
