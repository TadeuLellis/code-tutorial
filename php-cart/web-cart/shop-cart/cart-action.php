<?php

// inicie uma sessão
@session_start();

// interface é uma classe especial que serve aqui para o controle de inversão
interface ActionCartIterface {
    // método não implementável
    public function action();
}

// classe responsável por adicionar item e que implementa a interface ActionCartInterface
class AddItem implements ActionCartIterface {
    // método obrigatório da interface que deve ser implementado para o controle de inversão
    public function action() {
        // se $_SESSION['cart'] não definido
        if(!isset($_SESSION['cart'])) { // então
            // inicializa um ['cart'] da SESSÃO como uma matriz (vetor de vetores)
            $_SESSION['cart'] = array();
        }
        // se item ainda não introduzido
        if(!isset($_SESSION['cart'][$_GET['id']])) {    // então
            $_SESSION['cart'][$_GET['id']] = 1; // introduz (atribui) um produto
        }   // senão
        else {
            $_SESSION['cart'][$_GET['id']]++;   // incrementa (introduz) mais 1 quantia de produto
        }    
    }
}

// classe responsável em remover items
class RemoveItem implements ActionCartIterface {
    public function action() {
        // se for o item a remover
        if(isset($_SESSION['cart'][$_GET['id']]))   // então
            unset($_SESSION['cart'][$_GET['id']]);  // remova o item
    }
}
?>