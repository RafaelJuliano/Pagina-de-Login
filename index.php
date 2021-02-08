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
    <div id="corpo-form">
        <h1>Entrar</h1>
        <form method="POST">
            <input type="text" name="usuario" placeholder="Usuário" maxlength="10">
            <input type="password" name="senha" placeholder="Senha" maxlength="12">
            <input type="submit" value="Acessar">
            <a href="cadastro.php"><strong>Novo cadastro</a>
        </form>
    </div>
    <div>
    <?php
    if (isset($_POST['usuario'])) {
        $usuario = addslashes($_POST['usuario']);
        $senha = addslashes($_POST['senha']);

        if (!empty($usuario) && !empty($senha)) {
          $dadosOk = true;
        } else {
            $dadosOk = false;
            ?><div class="msg">Preencha todos os campos!</div><?php
        }

        if ($dadosOk){
            $us->conectar();
            echo $us->msgErro;
            if ($us->logar($usuario, $senha)){
                echo "sucesso";
                header("location: areaPrivada.php");
            } else {
             ?><div class="msg">Usuário e/ou senha estão incorretos</div><?php
            } 
        }        
    }

    ?>
    </div>
</body>

</html>