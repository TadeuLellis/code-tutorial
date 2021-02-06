<?php

// adiciona ao app o middleware responsável em ficar por meio da aplicação Slim com JwtAuthentication
$app->add(new Tuupola\Middleware\JwtAuthentication([    // middleware Slim do JWTAuthentication
    "path" => "/", /* or ["/api", "/admin"] */  // caminho (path) primário "/"
    // ignore é as rotas que deverão aceitar exibição das páginas /index /member /form /token
    "ignore" => ["/index", "/member", "/form", "/token"],
    "header" => "X-Token",  // nome do cabeçalho header "X-Token"
    "attribute" => "jwt",   // tipo de atribuição ou atributo chamado "jwt"
    "relaxed" => ["192.168.50.52", "127.0.0.1", "localhost"], // endereçamentos permitidos (PROXY)
    "secret" => "example_key",  // segredo do JWT
]));