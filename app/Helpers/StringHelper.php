<?php

if (!function_exists('turkishToEnglishChars')) {
    function turkishToEnglishChars($text)
    {
        $search = ['ç', 'ğ', 'ı', 'i', 'ö', 'ş', 'ü', 'Ç', 'Ğ', 'İ', 'I', 'Ö', 'Ş', 'Ü'];
        $replace = ['c', 'g', 'i', 'i', 'o', 's', 'u', 'C', 'G', 'I', 'I', 'O', 'S', 'U'];
        $text = str_replace($search, $replace, $text);
        return $text;
    }
}
