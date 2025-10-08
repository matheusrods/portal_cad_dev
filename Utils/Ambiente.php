<?php
if (!function_exists('getAmbiente')) {
    function getAmbiente(): string
    {
        $host = $_SERVER['HTTP_HOST'] ?? '';

        if (str_contains($host, 'localhost')) {
            return 'local';
        } elseif (str_contains($host, 'cad.desenv.bb.com.br')) {
            return 'homologacao';
        } elseif (str_contains($host, 'cad.bb.com.br')) {
            return 'producao';
        }

        return 'desconhecido';
    }

    function getBaseUrl(): string
    {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
        return "{$protocol}://{$host}";
    }
}