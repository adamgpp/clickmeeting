<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Service\FilenameMakerService;
use App\Service\FileResizerService;
use SplFileInfo;

final class FileUploadService
{
    private $file_resizer;
    private $filename_maker;
    private $local_directory;

    public function __construct(FileResizerService $file_resizer, FilenameMakerService $filename_maker, string $local_directory)
    {
        $this->file_resizer = $file_resizer;
        $this->filename_maker = $filename_maker;
        $this->local_directory = $local_directory;
    }

    public function upload(UploadedFile $file, int $upload_destination): SplFileInfo
    {
        $filename = $this->filename_maker->make($file);
        $resized_file = $this->file_resizer->resize($file);
        $filepath = $this->local_directory . '/' . $filename;
        if (!is_dir($this->local_directory) && !file_exists($this->local_directory)) {
            mkdir($this->local_directory, 0755);
        }
        $resized_file->save($filepath);
        return new SplFileInfo($filepath);
    }
}
