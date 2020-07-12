<?php

declare(strict_types=1);

namespace App\Dictionary;

abstract class FileUploadDictionary
{
    public const DESTINATION_LOCAL = 'local';
    public const DESTINATION_AMAZON = 'amazon';
    public const DESTINATION_DROPBOX = 'dropbox';

    public const DESTINATION_TYPES = [
        self::DESTINATION_LOCAL => 'lokalny dysk',
        self::DESTINATION_AMAZON => 'Amazon S3',
        self::DESTINATION_DROPBOX => 'Dropbox',
    ];
}
