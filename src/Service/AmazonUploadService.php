<?php

declare(strict_types=1);

namespace App\Service;

use Aws\S3\S3Client;
use League\Flysystem\AwsS3v3\AwsS3Adapter;
use League\Flysystem\Filesystem;

final class AmazonUploadService implements UploadServiceInterface
{
    private $bucket;
    private $credentials;
    private $region;
    private $version;
    private $amazon_uploads_directory;

    public function __construct(string $bucket, array $credentials, string $region, string $version, string $amazon_uploads_directory)
    {
        $this->bucket = $bucket;
        $this->credentials = $credentials;
        $this->region = $region;
        $this->version = $version;
        $this->amazon_uploads_directory = $amazon_uploads_directory;
    }

    public function upload(\SplFileInfo $file): void
    {
        $client = new S3Client([
            'credentials' => $this->credentials,
            'region' => $this->region,
            'version' => $this->version,
        ]);
        $adapter = new AwsS3Adapter($client, $this->bucket);
        $filesystem = new Filesystem($adapter);
        $filesystem->write($this->amazon_uploads_directory . '/' . $file->getFilename(), file_get_contents($file->getPathname()));
    }
}
