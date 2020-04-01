<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
include_once APPPATH . '/third_party/phpqrcode-master/qrlib.php';

class Phpqr {

    public function __construct() {
        
    }

    public function createcode($text, $file) {
        $this->$text = $text;
        $this->$file = $file;
        QRcode::png($text, $file, "L", "10", "5");
    }

    public function showcode($text) {
        return QRcode::svg($text);
    }

}

?>