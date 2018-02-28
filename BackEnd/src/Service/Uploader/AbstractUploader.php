<?php

namespace App\Service\Uploader;

use Symfony\Component\HttpFoundation\File\UploadedFile;

abstract class AbstractUploader {

    protected $targetDir;
    protected $ext = array();
    protected $isValid = false;
    protected $fileName;

    public function __construct($targetDir) {
        $this->targetDir = $targetDir;
    }

    public function upload(UploadedFile $file): void {
        $fileName = md5(uniqid()) . '.' . $file->guessExtension();
        $file->move($this->getTargetDir(), $fileName);
        $this->fileName = $fileName;
    }

    public function isValid(UploadedFile $file): bool {
        if (in_array($file->guessExtension(), $this->ext)) {
            return $this->isValid = true;
        }
        return $this->isValid = false;
    }

    public function validateAndUpload(UploadedFile $file): bool {
        if ($this->isValid($file)) {
            $this->upload($file);
            return true;
        }
        return false;
    }

    public function getExt(): array {
        return $this->ext;
    }

    public function getFileName(): string {
        return $this->fileName;
    }

    public function getTargetDir(): string {
        return $this->targetDir;
    }

}
