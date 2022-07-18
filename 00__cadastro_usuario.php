<?php
session_start();
    require_once "conexao_bd.php";

    $nome_usuario = $_POST['nome_usuario'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $senhaMD5 = md5($senha);

    $s = "SELECT * FROM usuarios WHERE email='$email'";
    $r = mysqli_query($conexao, $s);
    $linha = mysqli_fetch_assoc($r);

    if(isset($linha['email'])){

        $_SESSION['mensagem'] = 'Este email já está cadastrado no sistema!';
        
        header("Location: 00___entrada.php");

    } else {

        $sql = "INSERT INTO usuarios (nome_usuario, email, senha) " . "VALUES ('$nome_usuario', '$email', '$senhaMD5')";
        $resultado = mysqli_query($conexao, $sql);

        if ($resultado) {

            // pegar o id gerado
            $id_usuario = mysqli_insert_id($conexao);

            // colocar na sessão
            $_SESSION['id_usuario'] = $id_usuario;

            // redirecionar para a página principal
            header("Location: 01_capa.php");

        } else {

            $_SESSION['mensagem'] = 'Erro ao salvar o usuário no banco de dados! '.mysqli_errno($conexao) . ": " . mysqli_error($conexao);
            
            header("Location: 00__form_cadastro_usuario.php");

        }
    }
?>