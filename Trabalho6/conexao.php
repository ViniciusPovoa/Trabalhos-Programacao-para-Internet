<?php
class Conexao {
    public $conexao;
 
    function __construct() {
        if (!isset($this->conexao)) {
            try {
                $this->conexao = new PDO('mysql:host=db_vpdeveloper.mysql.dbaas.com.br;dbname=db_vpdeveloper', 'db_vpdeveloper', 'Papai1968!');
                
                
            } catch (PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }
    }
 
    function fecharConexao(){
        if (isset($this->conexao)) {
            $this->conexao = null;
        }
    }
}
?>