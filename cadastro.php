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
    <title>Cadastrar</title>
</head>

<body>
    <div id="corpo-form">
        <h1>Cadastrar</h1>
        <form method="POST">
            <input type="text" name="usuario" placeholder="Usuário" maxlength="10">
            <input type="text" name="nome" placeholder="Nome completo" maxlength="30">
            <input type="password" name="senha" placeholder="Senha" maxlength="12">
            <input type="password" name="confsenha" placeholder="Confirmar senha" maxlength="12">
            <input type="submit" value="Confirmar" name='button'>
            <a href="index.php"><strong>Tela de login</strong></a>
        </form>
    </div>
    <div>
        <?php
        if (isset($_POST['usuario'])) {
            $usuario = addslashes($_POST['usuario']);
            $nome = addslashes($_POST['nome']);
            $senha = addslashes($_POST['senha']);
            $confsenha = addslashes($_POST['confsenha']);

            //Verifica preenchimento dos campos
            if (!empty($usuario) && !empty($nome) && !empty($senha) && !empty($confsenha)) {
                if ($senha == $confsenha) {
                    $dadosOK = true;
                } else {
                    ?>
                    <div class="msg">
                        Senhas não correspondem!
                    </div>
                    <?php
                    $dadosOK = false;
                }
            } else {
                ?>
                <div class="msg">
                    Preencha todos os campos!
                </div>
                <?php
                $dadosOK = false;
            }

            if ($dadosOK == true) {
                $us->conectar();
                echo $us->msgErro;
                $us->cadastrar($usuario, $nome, $senha);
            }
        }
        ?>
    </div>
</body>

</html>