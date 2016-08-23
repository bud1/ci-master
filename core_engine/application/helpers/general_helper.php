<?php
if (!function_exists('rupiah')) {

    function rupiah($nominal) {
        $get_rupiah = "Rp. " . number_format($nominal, 0, ',', '.');
        return $get_rupiah . ",-";
    }

}

if (!function_exists('object_to_array')) {

    function object_to_array($object) {
        if (is_object($object)) {
            // Gets the properties of the given object with get_object_vars function
            $object = get_object_vars($object);
        }
        return (is_array($object)) ? array_map(__FUNCTION__, $object) : $object;
    }

}

?>