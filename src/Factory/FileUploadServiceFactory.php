<?php

declare(strict_types=1);

namespace App\Factory;

use App\Service\UploadServiceInterface;
use App\Dictionary\FileUploadDictionary;
use App\Service\LocalUploadService;
use App\Service\AmazonUploadService;
use App\Service\DropboxUploadService;

final class FileUploadServiceFactory
{
    public function __construct(
        LocalUploadService $local_upload_service,
        AmazonUploadService $amazon_upload_service,
        DropboxUploadService $dropbox_upload_service
    ) {
        $this->local_upload_service = $local_upload_service;
        $this->amazon_upload_service = $amazon_upload_service;
        $this->dropbox_upload_service = $dropbox_upload_service;
    }

    public function getService(string $upload_destination): UploadServiceInterface
    {
        switch ($upload_destination) {
            case FileUploadDictionary::DESTINATION_LOCAL:
                return $this->local_upload_service;
            case FileUploadDictionary::DESTINATION_AMAZON:
                return $this->amazon_upload_service;
            case FileUploadDictionary::DESTINATION_DROPBOX:
                return $this->dropbox_upload_service;
        }
    }
}
