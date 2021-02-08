<?php
require_once 'classes/usuarios.php';
$us = new Usuario;
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/estilo.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <form method="POST">
        <input type="submit" value="Acessar" name="button">
    </form>

    <div>
        <?php

        if(isset($_POST['button'])){
            $usuario = "teste";
            try {
                $pdo = new PDO('mysql:dbname=bd_ant;host=localhost', 'root', '');                               
            } catch (PDOException $e) {
                $msgErro = $e->getMessage();
            }
            $sql = $pdo->prepare("SELECT id FROM usuarios WHERE usuario = :u");
            $sql->bindValue(":u", $usuario);
            $sql->execute();
            echo $sql->rowCount();
        }           
        
        ?>
    </div>
</body>

</html>