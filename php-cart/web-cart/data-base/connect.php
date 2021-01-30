<?php

// classe PDOConnect responsável pela conexão ao banco de dados
class PDOConnect {
    private $pdo = '';  // variável de conexão
    private $host = 'localhost';    // nome host para localhost (máquina local)
    private $dbname = 'coursesonline';  // nome do banco de dados
    private $username = 'root'; // nome de usuário
    private $password = ''; // senha de usuário
    
    // construtor responsável pela conexão ao banco de dados
    public function __construct() {
        // instancia novo PDO para a nova conexão ao MySQL
        $this->pdo = new PDO('mysql:host='.$this->host.';dbname='.$this->dbname, $this->username, $this->password);
        // passando argumentos ATTR_ERRMODE e ERRMODE_EXCEPTION
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    // connect, retorne conexão ao banco em PDO
    public function connect() {
        return $this->pdo;  // retorne
    }
}
?>