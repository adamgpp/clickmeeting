<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;


final class FilenameMakerService
{
    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function make(UploadedFile $file): string
    {
        $original_filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safe_filename = $this->slugger->slug($original_filename);
        return $safe_filename . '-' . uniqid() . '.' . $file->guessExtension();
    }
}
