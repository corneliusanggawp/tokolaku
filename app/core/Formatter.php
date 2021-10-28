<?php

class Formatter {
    public static function rupiah($value)
    {
        $rupiah = "IDR " . number_format($value, '2', ',', '.');
        return $rupiah;
    }
}