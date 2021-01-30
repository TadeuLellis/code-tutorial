<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Cart</title>
    <style>
        /* CSS (Folha de Estilo em Cascata) */
        
        * { /* o asterisco pega todos os elementos de uma só vez */
            margin: 0;
            padding: 0;
        }
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: rgb(3, 6, 10);
        }
        .container {
            position: relative;
            width: 100%;
            margin: 0 auto;
            padding-bottom: 100px;
            text-align: center;
        }
        p.course {
            color: #FFF;
            font-size: 20px;
            text-align: center;
        }
        #a-remove {
            display: block;
            width: 100%;
            height: 35px;
            color: #FFF;
            border: 0px solid #000;
            padding: 12px 0 0 0;
            text-decoration: none;
            background-color: rgb(11, 137, 211);
        }
        #a-shop-return:hover {
            text-decoration: underline;
        }
        #a-shop-return {
            color: #FC0;
            text-decoration: none;
        }
        footer.foo {
            position: fixed;
            width: 100%;
            color: #FFF;
            font-size: 30px;
            text-align: center;
            bottom: 0;
            padding: 25px 0 25px 0;
            background-color: rgb(11, 137, 211);
        }
    </style>
</head>

<!-- Corpo da Página -->
<body>
    <?php
        // inicie uma sessão
        @session_start();
    ?>

    <!-- DIV Container para Abrigar Elementos Tag HTML -->
    <div class="container">
        <?php   // Começo do Script PHP

        // requira cart-action.php e cart.php e connect.php só uma vez (once)
        require_once('shop-cart/cart-action.php');
        require_once('shop-cart/cart.php');
        require_once('data-base/connect.php');

        // obter conexão ao banco de dados
        function getConnect() {
            $pdo = new PDOConnect();
            return $pdo->connect();
        }

        // obter conexão
        $pdo = getConnect();

        // se carrinho estiver vazio
        if(empty($_SESSION['cart'])) {  // então
            // ecoar que está vazio
            echo '<div style="color: #FFF; padding: 30% 0 20px 0;">Carrinho vazio.</div>';
        }

        // se ação for add (adicionar)
        if(@$_GET['action'] == 'add') { // então
            // instancia novo objeto Cart com injeção de dependência
            $cart = new Cart(new AddItem());
            $cart->handle();    // faz ação (handle) de AddItem

            // atribui preço total e total de items a sessão para mostrar no topo da página
            $_SESSION['total'] = $cart->totalPrice();
            $_SESSION['items'] = $cart->totalItems();

            // faz loop pela sessão
            foreach($_SESSION['cart'] as $id => $quant) {
                // faz consulta pela tabela courses
                $consulta = $pdo->query("SELECT * FROM `courses` WHERE courseid = $id");
                $linha = $consulta->fetch(PDO::FETCH_ASSOC);  // obtem dados da consulta
                
                // se dado da consulta existir
                if($linha) {    // então
                    // ecoa HTML ao navegador
                    echo '
                    <div><img style="width: 350px; height: 200px" src="'. $linha['img'] .'"></div>
                    <div style="padding: 0 0 30px 0;">
                        <p class="course">Curso: '. $linha['course'] .'</p>
                        <p class="course">Preço: R$ '. str_replace('.', ',', $linha['price']) .'</p>
                        <p class="course">Quantidade: '. $quant .'</p>
                        <p class="course">Subtotal: R$ '. str_replace('.', ',', $cart->subTotal($id)) .'</p>
                        <a href="http://localhost/web-cart/add-item-cart.php?action=remove&id='. $id .'&submitted=no" id="a-remove">REMOVER</a>
                    </div>
                    ';
                }
            }
        }   // se não se a ação for remove (remover)
        elseif(@$_GET['action'] == 'remove') {  // então
            // instancia novo objeto Cart com injeção de dependência
            $cart = new Cart(new RemoveItem());
            $cart->handle();    // faz ação (handle) de RemoveItem
        }
        ?>

        <!-- rodapé fixado -->
        <footer class="foo">
            <span>
                <!-- Link voltar para as compras -->
                <a id="a-shop-return" href="/web-cart">VOLTAR AS COMPRAS</a>
            </span>
            -
            <span>Preço Total: R$ <?php echo str_replace('.', ',', @$_SESSION['total']); ?></span>
            -
            <span>Total de itens: <?php echo @$_SESSION['items']; ?></span>
        </footer>
        <!-- end div .container -->
    </div>
    <!-- end body -->
</body>
</html>