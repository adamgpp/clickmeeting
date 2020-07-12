<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Service\FilenameMakerService;
use App\Service\FileResizerService;
use App\Factory\FileUploadServiceFactory;
use SplFileInfo;

final class FileUploadService
{
    private $file_resizer;
    private $filename_maker;
    private $local_directory;
    private $upload_service_factory;

    public function __construct(
        FileResizerService $file_resizer,
        FilenameMakerService $filename_maker,
        FileUploadServiceFactory $upload_service_factory,
        string $local_directory
    ) {
        $this->file_resizer = $file_resizer;
        $this->filename_maker = $filename_maker;
        $this->local_directory = $local_directory;
        $this->upload_service_factory = $upload_service_factory;
    }

    public function upload(UploadedFile $file, string $upload_destination): SplFileInfo
    {
        $filename = $this->filename_maker->make($file);
        $resized_file = $this->file_resizer->resize($file);
        $filepath = $this->local_directory . '/' . $filename;
        if (!is_dir($this->local_directory) && !file_exists($this->local_directory)) {
            mkdir($this->local_directory, 0755);
        }
        $resized_file->save($filepath);
        $file = new SplFileInfo($filepath);
        $this->upload_service_factory->getService($upload_destination)->upload($file);
        return $file;
    }
}
