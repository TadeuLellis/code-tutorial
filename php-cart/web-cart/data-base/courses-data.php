<?php
// inicie uma sessão
@session_start();

// requira connect.php só uma vez (once)
require_once('connect.php');

// classe DataCourses responsável pelos dados do carrinho
class CoursesData {
    // obter conexão ao banco de dados
    public function getConnect() {
        $this->pdo = new PDOConnect();  // instancia da classe PDOConnect
        return $this->pdo->connect();   // retorne
    }

    // obter o preço total
    public function totalPrice() {
        $this->total = 0;   // introduz 0 a variavel total
        $this->pdo = $this->getConnect();   // obtem conexão

        // faz loop para obter o preço total
        foreach($_SESSION['cart'] as $id => $quant) {
            // faz consulta por ID courseid do que consultar tudo de uma só vez sem a cláusula WHERE
            $this->consulta = $this->pdo->query("SELECT `price` FROM `courses` WHERE `courseid`= $id");
            // obtém os dados com FETCH_ASSOC
            $this->consulta = $this->consulta->fetch(PDO::FETCH_ASSOC);
            $this->total += $this->consulta['price'] * $quant;  // cálculo do preço total
        }
        return $this->total;    // retorne
    }

    // obter o subtotal
    public function subTotal($id) {
        $this->subtotal = 0;    // introduz 0 a variável subtotal
        $this->pdo = $this->getConnect();   // obtém conexão
        
        // faz consulta na tabela courses pelo ID courseid na cláusula WHERE
        $this->consulta = $this->pdo->query("SELECT `price` FROM `courses` WHERE `courseid`= $id");
        
        // faz loop para obter o subtotal
        while ($linha = $this->consulta->fetch(PDO::FETCH_ASSOC)) {
            $this->subtotal += $linha['price'] * $_SESSION['cart'][$id];    // calcula subtotal
        }
        return $this->subtotal; // retorne
    }

    // obter o total de items
    public function totalItems() {
        $this->totalitems = 0;  // introduz 0 a variável totalitems

        // faz loop para obter o total de items
        foreach(@$_SESSION['cart'] as $id => $quant) {
            $this->totalitems += $quant;    // calcula o total de items
        }
        return $this->totalitems;   // retorne
    }
}
?>