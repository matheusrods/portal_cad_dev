<?php
$str = "recursos manual.pptx";

// Converte tudo para minúsculas
$result = strtolower($str);
$result = preg_replace_callback ('/(^|[^a-z0-9.]+?)[a-z0-9]/i', function ($matches) {
    if (strlen($matches[0]) === 1) {
        // O primeiro caractere
        return strtoupper($matches[0]);
    }
    // Caractere após caractere especial
    return strtoupper($matches[0][1]);
}, $result);

echo $result;
?>
