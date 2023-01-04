<?php
require 'jwt/jwt.php';

$jwt = new jwt();

echo $jwt->create();

echo "<hr>";

if ($jwt->validate("eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZF91c2VyIjoxMjN9.0ye9wYHYgrvV-k1EmE7-XSOCKKCDgs74BOS7mCqIwZM")) {

    echo "Token Válido!<br><br>";
    print_r($jwt->validate("eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZF91c2VyIjoxMjN9.0ye9wYHYgrvV-k1EmE7-XSOCKKCDgs74BOS7mCqIwZM"));
} else {
    echo "Token Inválido!";
}

echo "<hr>";

$jason =  ['1' => 'teste1', '2' => 'teste2', '3' => 'teste3', '4' => 'teste4'];

$jason = json_encode($jason);

print_r($jason);

echo "<hr>";

$jason = json_decode($jason, true);

print_r($jason);

echo "<hr>";

echo $_SERVER['HTTP_HOST'];
