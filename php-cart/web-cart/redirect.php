<?php
// função de redirecionamento
function my_redirect() {
    // header responsável pelas informações ou ações adicionais as páginas web
    header('Location: http://localhost/web-cart/add-item-cart.php?action=add&id='. $_GET['id'] .'&submitted=no');
}
?>