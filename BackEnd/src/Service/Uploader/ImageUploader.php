<?php

namespace App\Service\Uploader;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Entity\Entity;

class ImageUploader extends AbstractUploader {

    protected $ext = ['jpg', 'jpeg', 'png', 'gif'];
    private $defaultImage;

    public function __construct(string $targetDir, string $defaultImage = '') {
        parent::__construct($targetDir);
        $this->defaultImage = $defaultImage;
    }

    /**
     * @param type UploadedFile
     * @return boolean
     */
    public function uploadOrSetDefault($file): bool {
        
        if ($image = $file) {
            if ($this->isValid($image)) {
                $this->upload($image);
                return true;
            }
        } else {
            $this->fileName = $this->defaultImage;
            return true;
        }
        return false;
        
    }

}
