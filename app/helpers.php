<?php

function hideMiddleDigits($number) {
    $maskedNumber = "";
    if (strlen($number) >= 10) {
        $prefix = substr($number, 0, 7);
        $suffix = substr($number, -3);
        return $prefix . '****' . $suffix;
    } else {
        return $number;
    }
}