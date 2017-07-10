<?php
namespace Helpers;

class FiltroString
{
    public static function substituiEspacos($string, $replace = '_')
    {
        return str_replace(" ", $replace, $string);
    }

    public static function lower($string)
    {
        return strtolower($string);
    }
}
