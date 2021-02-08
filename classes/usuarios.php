


<?php

class Usuario
{
    private $pdo;
    public $msgErro = "";

    public function conectar()
    {
        global $pdo;
        global $msgErro;
        try {
            $pdo = new PDO('mysql:dbname=bd_ant;host=localhost', 'root', '');
        } catch (PDOException $e) {
            $msgErro = $e->getMessage();
        }
    }

    public static function verificarDisponibilidade($usuario)
    {
        global $pdo;
        $sql = $pdo->prepare("SELECT id FROM usuarios WHERE usuario = :u");
        $sql->bindValue(":u", $usuario);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            return false;
        } else {
            return true;
        }
    }

    public function cadastrar($usuario, $nome, $senha)
    {
        global $pdo;
        $usuarioDisponivel = Usuario::verificarDisponibilidade($usuario);
        if($usuarioDisponivel){
            $sql = $pdo->prepare("INSERT INTO usuarios (usuario, nome, senha) VALUES (:u, :n, :s)");
            $sql->bindValue(":u", $usuario);
            $sql->bindValue(":n", $nome);
            $sql->bindValue(":s", md5($senha));
            $sql->execute();
            ?><div class="msg">Usuário cadastrado com sucesso</div><?php
        } else {
            ?><div class="msg">Usuário já cadastrado</div><?php
        }  
    }

    public function logar($usuario, $senha)
    {
        global $pdo;
        $sql = $pdo->prepare("SELECT id FROM usuarios WHERE usuario = :u AND senha = :s");
        $sql->bindValue(":u", $usuario);
        $sql->bindValue(":s", md5($senha));
        $sql->execute();

        if($sql->rowCount() > 0){
            $dados = $sql->fetch();
            session_start();
            $_SESSION['id'] = $dados['id'];
            return true;
        } else {
            return false;
        }
    }    
}
