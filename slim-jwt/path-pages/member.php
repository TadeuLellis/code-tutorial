<?php

use \Firebase\JWT\JWT;

// se session definida ou não vazia
if(isset($_SESSION['token'])) { // então
    $secret = "example_key"; // atribui o segredo para a decodificação (descriptografia)
    // obtem as três partes (header, payload, signature) e separa com explode pelo delimitador '.'
    $token_parts = explode('.', $_SESSION['token']);
    $part = base64_decode($token_parts[1]); // decodifica com base64_decode
    $part = json_decode($part); // decodifica com json_decode para obter o objeto json

    // try do bloco de instrução
    try {
        // decodifica com JWT::decode com o segredo usado para codificar anteriormente
        // HS256 é o algoritmo de codificação
        $decoded = JWT::decode($_SESSION['token'], $secret, array('HS256'));
        echo '<h3>Você está logado como: '.$decoded->dta->user. '</h3>';   // ecoa a credencial do usuário (username) 
    }
    catch(Exception $e) {   // catch para o tratamento da exceção (erro) caso haja
        unset($_SESSION['token']);  // destrói a $_SESSION['token] desvinculando da memória
        unset($_SESSION['form-submitted']); // destrói a $_SESSION['form-submitted]
        echo '<h1>Token expirou!</h1>'; // ecoa mensagem Token expirou!
    }
    // se time() for menor que o tempo de validade do token
    if(time() < $part->exp) // então
        require_once('public/member/index.php');    // requira e exiba a página de membro
}
else {  // senão
    echo '<h1>Página protegida! Somente para membros.</h1>';    // ecoa mensagem página protegida
}
