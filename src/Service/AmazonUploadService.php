<?php

declare(strict_types=1);

namespace App\Service;

use Aws\S3\S3Client;

final class AmazonUploadService implements UploadServiceInterface
{
    private $bucket;
    private $args;

    public function __construct(string $bucket, array $args)
    {
        $this->bucket = $bucket;
        $this->args = $args;
    }

    public function upload(\SplFileInfo $file): void
    {
        $client = new S3Client($this->args);
        $client->upload($this->bucket, $file->getPathname(), file_get_contents($file->getPathname()));
    }
}
