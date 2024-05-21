<?php

if (!function_exists('clean')) {
    function clean($content)
    {
        // Hapus tag <div> yang tidak diperlukan
        return preg_replace('/<div>(.*?)<\/div>/', '$1', $content);
    }
}
