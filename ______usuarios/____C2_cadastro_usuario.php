<?php
session_start();
    require_once ".conexao_bd.php";

    $nome_usuario = $_POST['nome_usuario'];
    if(isset($_FILES['endereco_imagem_usuario'])){

        $ext = strrchr($_FILES['endereco_imagem_usuario']['name'], '.');
        $nome = md5(time()).$ext;
        $dir = "arquivos/imgs_usuarios/";
    
        move_uploaded_file($_FILES['endereco_imagem_usuario']['tmp_name'], $dir.$nome);
    
    }
    if($ext != ""){
    
        $endereco_imagem_usuario= $dir.$nome;
    
    }else{
    
        $endereco_imagem_usuario= "arquivos/_imgs_default/sem_imagem_usuario.png";
    
    }

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

        $sql = "INSERT INTO usuarios (email, nome_usuario, senha, endereco_imagem_usuario) " . "VALUES ('$email', '$nome_usuario', '$senhaMD5', '$endereco_imagem_usuario')";
        $resultado = mysqli_query($conexao, $sql);

        if ($resultado) {

             // pegar o id gerado
            $id_usuario = mysqli_insert_id($conexao);

            // colocar na sessão
            $_SESSION['id_usuario'] = $id_usuario;
            $_SESSION['email'] = $email;

            // redirecionar o usuário
            header("Location: 0___home_consumidor.php");

        } else {

            $_SESSION['mensagem'] = 'Erro ao salvar o usuário no banco de dados! '.mysqli_errno($conexao) . ": " . mysqli_error($conexao);
            
            header("Location: 00__form_cadastro_usuario.php");

        }
    }
?>