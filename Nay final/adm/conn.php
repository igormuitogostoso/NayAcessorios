<?php

$hostname = "localhost";
$bancodedados = "loja";
$usuario = "root";
$senha = "";

$mysqli = new mysqli($hostname, $usuario, $senha, $bancodedados);

if ($mysqli->connect_error) {
    echo "Conexão falhou: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
} else {
    echo "Conectado";
}

?>
