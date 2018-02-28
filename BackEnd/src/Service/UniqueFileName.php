<?php
namespace App\Service;

class UniqueFileName {

    static public function generateUniqueFileName() {
        return md5(uniqid());
    }

}
