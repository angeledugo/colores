<?php

// Funcion para
function hexToRgb($hex) {
    $hex = str_replace("#", "", $hex);
    return [
        "r" => hexdec(substr($hex, 0, 2)),
        "g" => hexdec(substr($hex, 2, 2)),
        "b" => hexdec(substr($hex, 4, 2))
    ];
}

function colorDistance($color1, $color2) {
    $rgb1 = hexToRgb($color1);
    $rgb2 = hexToRgb($color2);

    $rDiff = $rgb1["r"] - $rgb2["r"];
    $gDiff = $rgb1["g"] - $rgb2["g"];
    $bDiff = $rgb1["b"] - $rgb2["b"];

    // Calcula la distancia euclidiana
    $distance = sqrt($rDiff ** 2 + $gDiff ** 2 + $bDiff ** 2);

    // Normaliza el resultado a un valor entre 0 y 1
    $normalizedDistance = 1 - ($distance / 441.67); // 441.67 es la distancia máxima posible

    return $normalizedDistance;
}

$color1 = "#FF0000"; // Rojo
$color2 = "#00FF00"; // Verde


// Calidad inicial de la combinación
$quality = colorDistance($color1, $color2);
$context = null;
// Aplicar penalizaciones según contexto
// Ejemplo: Penalización por contexto profesional
if ($context == "profesional") {
    $quality -= 0.2;
}

$ocasion = null;
// Ejemplo: Penalización por ocasión nocturna
if ($ocasion == "noche") {
    $quality -= 0.1;
}
$coloresInapropiados = false;
// Ejemplo: Penalización por colores culturalmente inapropiados
if ($coloresInapropiados) {
    $quality -= 0.3;
}

// Asegura que la calidad esté en el rango [0, 1]
$quality = max(0, min(1, $quality));

echo "Calidad de la combinación de colores: " . round($quality, 2);
?>