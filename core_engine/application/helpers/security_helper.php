<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('toko_encrypt')) {
    function toko_encrypt($teks) {
        $bingung1 = "!\"#$%&'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_`abcdefghijklmnopqrstuvwxyz{|}~�������������������������������� �����������������������������������������������������������������������������������������������";
        $bingung2 = "!\"#$%&'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_`abcdefghijklmnopqrstuvwxyz{|}~�������������������������������� �����������������������������������������������������������������������������������������������";
        $teks = crc32($bingung1 . $teks . $bingung2);
        $teks = str_rot13($bingung1 . $teks . $bingung2);
        $teks = base64_encode($bingung1 . $teks . $bingung2);
        $teks = sha1($bingung1 . $teks . $bingung2);
        $teks = md5($bingung1 . $teks . $bingung2);
        $teks = md5($bingung1 . $teks . $bingung2) . $teks;
        $teks = base64_decode($teks);
        $teks = md5($teks);
        return $teks;
    }
}

if (!function_exists('create_returl')) {

    function create_returl($str) {
        $replace = str_replace("/", "-", $str);
        return $replace;
    }

}

if (!function_exists('decode_returl')) {

    function decode_returl($str) {
        $replace = str_replace("-", "/", $str);
        return $replace;
    }

}

if (!function_exists('cleanString')){
    function cleanString($subject, $replace='', $search=array('\'','"')){
        return str_replace($search, $replace, $subject);
    }
}

if (!function_exists('empty_folder')){
    function empty_folder($directory){
        $files = glob($directory.'*'); // get all file names ex : '_temp/captcha/*'
        foreach($files as $file){ // iterate files
          if(is_file($file))
            unlink($file); // delete all file in folder
        }
    }
}

if (!function_exists('create_gencode')){
    function create_gencode($namespace = '') {     
        static $guid = '';
        $uid = uniqid("", true);
        $data = $namespace;
        $data .= $_SERVER['REQUEST_TIME'];
        $data .= $_SERVER['HTTP_USER_AGENT'];
        //$data .= $_SERVER['LOCAL_ADDR'];
        //$data .= $_SERVER['LOCAL_PORT'];
        $data .= $_SERVER['REMOTE_ADDR'];
        $data .= $_SERVER['REMOTE_PORT'];
        $hash = strtoupper(hash('ripemd128', $uid . $guid . md5($data)));
        $guid = '' .   
                substr($hash,  0,  4) . 
                '-' .
                substr($hash,  4,  4) .
                '-' .
                substr($hash,  8,  4) .
                '-' .
                substr($hash, 12,  4);
        return $guid;
      }
}

if (!function_exists('create_twii_genid')){
    function create_twii_genid($namespace = '') {     
        static $guid = '';
        $uid = uniqid("", true);
        $data = $namespace;
        $data .= $_SERVER['REQUEST_TIME'];
        $data .= $_SERVER['HTTP_USER_AGENT'];
        //$data .= $_SERVER['LOCAL_ADDR'];
        //$data .= $_SERVER['LOCAL_PORT'];
        $data .= $_SERVER['REMOTE_ADDR'];
        $data .= $_SERVER['REMOTE_PORT'];
        $hash = strtoupper(hash('ripemd128', $uid . $guid . md5($data)));
        $guid = substr($hash,  0,  6);
        return $guid;
      }
}

?>