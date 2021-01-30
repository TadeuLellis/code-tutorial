<?php
// requira data-courses.php e redirect.php só uma vez (once)
require_once('data-base/courses-data.php');
require_once('./redirect.php');

// classe que representa o carrinho de compras
class Cart {
    private $send;  // responsável pelo envio
    private $coursesData;   // responsável pela manipulação de dados

    // construtor responsável pela injeção de dependência + inversão de controle (ActionCartInterface)
    public function __construct(ActionCartIterface $send) {
        $this->send = $send;    // recebe $send da instanciação de objeto
        $this->coursesData = new CoursesData(); // instancia novo objeto DataCourses
    }

    // método responsável pela ação
    public function handle() {
        // se $_GET['action] igual a add & $_GET['submitted'] igual a yes
        if($_GET['action'] == 'add' && $_GET['submitted'] == 'yes') {   // então
            $this->send->action();  // faz a ação adicionar de envio de ActionCartInterface
            my_redirect();  // redireciona
        }
        // se $_GET['action'] igual a remove
        if($_GET['action'] == 'remove') {   // então
            $this->send->action();  // faz a ação remover de envio de ActionCartInterface
            my_redirect();  // redireciona
        }
    }

    // método responsável pelo preço total
    public function totalPrice() {
        return $this->coursesData->totalPrice(); // retorne preço total
    }

    // método responsável pelo subtotal por id courseid
    public function subTotal($id) {
        return $this->coursesData->subTotal($id);   // retorne subtotal por id
    }

    // método responsável pelo total de items
    public function totalItems() {
        return $this->coursesData->totalItems();    // retorne total de items
    }
}
?>