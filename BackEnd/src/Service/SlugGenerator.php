<?php
namespace App\Service;

class SlugGenerator {

    static public function simpleSlug($string) {
        return trim(preg_replace('/[^a-z0-9]+/', '-', strtolower(strip_tags($string))), '-');
    }

    static public function TokenizenSlug() {
        return md5(uniqid(rand(0, 999999), true));
    }

}
