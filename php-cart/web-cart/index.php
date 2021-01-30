<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses List</title>
    <style>
        /* CSS (Folha de Estilo em Cascata) */

        *{
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: rgb(3, 6, 10);
        }
        .container {
            position: relative;
            width: 350px;
            margin: 0 auto;
            padding-top: 50px;
        }
        #submit {
            width: 100%;
            height: 35px;
            color: #FFF;
            cursor: pointer;
            border: 0px solid #000;
            background-color: rgb(11, 137, 211);
        }
        p.course {
            color: #FFF;
            font-size: 25px;
            text-align: center;
        }
        .div-submit span {
            position: absolute;
            color: #FFF;
            margin: 0 auto;
            padding: 8px 7px 9px 7px;
            background-color: rgb(11, 137, 211);
        }
        .top {
            position: fixed;
            width: 100%;
            text-align: right;
            padding: 10px 0 10px 0;
            z-index: 2;
            background-color: rgb(11, 137, 211);
        }
        .top a {
            color: #FFF;
            padding-right: 15px;
            text-decoration: none;
        }
    </style>
</head>

<!-- Corpo da Página -->
<body>
    <div class="top">
        <a href="http://localhost/web-cart/add-item-cart.php">carrinho</a>
    </div>

    <!-- DIV Container para Abrigar Elementos Tag HTML -->
    <div class="container">
        <?php   // Começo do Script PHP
        @session_start();

        // requira connect.php só uma vez (once)
        require_once('data-base/connect.php');

        $url = $_SERVER['REQUEST_URI']; // uri local

        // obter conexão ao banco de dados
        function getConnect() {
            $pdo = new PDOConnect();
            return $pdo->connect();
        }

        // obter conexão
        $pdo = getConnect();

        // faz consulta a tabela courses
        $consulta = $pdo->query("SELECT * FROM `courses`");

        // enquanto obtém dados da consulta e faz loop entre os dados
        while($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {    // faça
            // ecoar HTML para o navegador
            echo '
            <div><img style="width: 350px; height: 200px" src="'. $linha['img'] .'"></div>
            <div style="padding: 0 0 30px 0;">
                <p class="course">Curso: '. $linha['course'] .'<p>
                <p class="course">Preço: R$ '. str_replace('.', ',', $linha['price']) .'</p>
                <form method="GET" action="'. $url .'/add-item-cart.php">
                    <input type="hidden" name="action" value="add">
                    <input type="hidden" name="id" value="'. $linha['courseid'] .'">
                    <input type="hidden" name="submitted" value="yes">
                    <div class="div-submit">
                        <span>'. ((!@$_SESSION['cart'][$linha['courseid']]) ? 0 : @$_SESSION['cart'][$linha['courseid']]) .'</span>
                        <input type="submit" id="submit" value="ADICIONAR AO CARRINHO">
                    </div>
                </form>
            </div>
            ';
        }

        ?>
        <!-- end div .container -->
    </div>
    <!-- end body -->
</body>
</html>