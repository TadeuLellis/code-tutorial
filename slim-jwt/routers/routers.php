<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Factory\AppFactory;
use Slim\Views\PhpRenderer;
use \Firebase\JWT\JWT;

// requira bootstrap.php somente uma vez (once)
require_once 'bootstrap.php';

@session_start();   // inicia session

$app = AppFactory::create();    // cria app do Slim 4 com AppFactory::create()

// require middleware.php somente uma vez (once)
require_once 'middlewares/middleware.php';

// rota principal index
// $app->get permite uma requisição sem haver uma submissão
$app->get('/index', function (Request $request, Response $response, $args) use ($app) {
    // renderiza
    $renderer = new PhpRenderer('path-pages');  // path-pages é a pasta das páginas
    return $renderer->render($response, "/index.php", $args);   // renderizar
});

// rota de membros member
// $app->get permite uma requisição sem haver uma submissão
$app->get('/member', function (Request $request, Response $response, $args) {
    $renderer = new PhpRenderer('path-pages');  // path-pages é a pasta das páginas
    return $renderer->render($response, "/member.php", $args);  // renderizar
});

// rota do formulário form do login
// $app->get permite uma requisição sem haver uma submissão
$app->get('/form', function (Request $request, Response $response, $args) use ($app) {
    $renderer = new PhpRenderer('path-pages');  // path-pages é a pasta das páginas
    return $renderer->render($response, "/form.php", $args);    // renderizar
});

// rota do token para a geração do token Firebase JWT
// $app->post permite uma requisição havendo uma submissão pelo formulário
$app->post('/token', function (Request $request, Response $response, $args) use ($app) {
    // se houve uma requisição de formulário em form.php da rota /form
    if($_POST['username'] && $_POST['password']) {  // então
        // se não definida a sessão $_SESSION['token']
        if(!isset($_SESSION['token'])) {    // então
            $secret = "example_key";   // atribui o segredo para o token
            $issuedAt = time(); // atribui o número de segundos a $issuedAt
            $now_seconds = time();  // atribui o número de segundos a $now_seconds

            // $payload é um objeto JSON com as Claims (informações) da entidade tratada
            $payload = array(
                // issuer é a declaração " iss " (emissor) que identifica o principal que emitiu o JWT 
                "iss" => "http://example.org",
                // A declaração " aud " (público) identifica os destinatários aos quais o JWT se destina
                "aud" => "http://example.com",
                "jti" => 1, // Json Token Id: um identificador único para o token
                // iat é a declaração (emitida no momento) indica quando este token de ID foi emitido
                "iat" => $issuedAt,
                // tempo de expiração (validade) do token
                "exp" => $now_seconds+(60), // (60) segundos de validade
                // identifica o tempo antes do qual o JWT NÃO DEVE ser aceito para processamento 
                "nbf" => $issuedAt,
                "dta" => [  // dta são os dados do usuário credenciado (autenticado)
                    'id' => '1',    // id de usuário no bando de dados
                    'user' => $_POST['username']    // nome de usuário (e-mail)
                ]
            );

            try {   // try do bloco de instrução
                /* 
                ** codifica (encode) $payload com o segredo ($secret)
                ** o segredo $secret tem que ser o mesmo para decodificar (decode)
                ** só você saberá do segredo, é intransferível
                ** sem o segredo não poderá decodificar (descriptografar)
                 */
                $jwt = JWT::encode($payload, $secret);
                
                $_SESSION['token'] = $jwt;  // atribui JWT a sessão

                // redireciona para a rota /member com a credencial enviada pelo token na session
                return $response
                    ->withHeader('Location', '/member')
                    ->withStatus(302);
            }
            catch (Exception $e) {  // catch para o tratamento da exceção (erro) caso haja
                echo $e->getMessage();  // ecoa mensagem de erro
            }
        }
        else
            return $response
                ->withHeader('Location', '/member')
                ->withStatus(302);
    }
    
    return $response;
});

$app->run(); // executa aplicativo Slim