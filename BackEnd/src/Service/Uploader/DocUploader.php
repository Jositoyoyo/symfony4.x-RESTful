<?php

namespace App\Service\Uploader;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class DocUploader extends AbstractUploader {

    protected $ext = ['pdf', 'text', 'doc', 'html'];
  
}
