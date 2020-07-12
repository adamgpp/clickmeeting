<?php

declare(strict_types=1);

namespace App\Dictionary;

abstract class FileUploadDictionary
{
    public const DESTINATION_LOCAL = '1';

    public const DESTINATION_TYPES = [
        self::DESTINATION_LOCAL => 'lokalnie',
    ];
}
