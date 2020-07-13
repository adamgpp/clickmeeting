<?php

declare(strict_types=1);

namespace App\Service;

use League\Flysystem\Filesystem;
use Spatie\Dropbox\Client;
use Spatie\FlysystemDropbox\DropboxAdapter;

final class DropboxUploadService implements UploadServiceInterface
{
    private $authorization_token;
    private $dropbox_uploads_directory;

    public function __construct(string $authorization_token, string $dropbox_uploads_directory)
    {
        $this->authorization_token = $authorization_token;
        $this->dropbox_uploads_directory = $dropbox_uploads_directory;
    }

    public function upload(\SplFileInfo $file): void
    {
        $client = new Client($this->authorization_token);
        $adapter = new DropboxAdapter($client);
        $filesystem = new Filesystem($adapter, ['case_sensitive' => false]);
        $filesystem->write($this->dropbox_uploads_directory . '/' . $file->getFilename(), file_get_contents($file->getPathname()));
    }
}
