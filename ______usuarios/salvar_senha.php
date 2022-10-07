<?php
session_start();
require_once "../_______necessarios/.conexao_bd.php";
require_once "../_______necessarios/.funcoes.php";

$email = $_POST['email'];
$token = $_POST['token'];
$senha = $_POST['senha'];

$sql = "SELECT * FROM password_reset WHERE email='$email' AND token='$token'";
$resultado = mysqli_query($conexao, $sql);
$reset = mysqli_fetch_assoc($resultado);

if(!is_null($reset)) {

    $hoje = new DateTime();
    $dataExpiracao = new DateTime($reset['data_expiracao']);

    if ($hoje < $dataExpiracao) {

        if($reset['usado'] == 0){
            
            $senhaMD5 = md5($senha);
            $sql_1 = "UPDATE usuarios SET senha='$senhaMD5' WHERE email='$email'";
            $resultado_1 = mysqli_query($conexao, $sql_1);

            if($resultado_1){

                $sql_2 = "UPDATE password_reset SET usado=1 WHERE email='$email' AND token='$token'";
                $resultado_2 = mysqli_query($conexao, $sql_2);

                if($resultado_2){

                    $_SESSION['mensagem'] = "Nova senha foi redefinida com sucesso!";
                    header("Location: ../index/entrada.php");

                    die;

                } else {

                    $_SESSION['mensagem'] = "Erro ao gravar a nova senha no banco de dados. Erro:" . mysqli_errno($conexao) . ": " . mysqli_error($conexao);

                }

            } else {

                $_SESSION['mensagem'] = "Erro ao gravar a nova senha no banco de dados. Erro:" . mysqli_errno($conexao) . ": " . mysqli_error($conexao);
                
            }

        } else {
            
            $_SESSION['mensagem'] = "Pedido de recuperação de senha já foi usado! Realize o pedido de recuperação de senha novamente se deseja alterar a senha.";
        
        }

    } else {
        
        $_SESSION['mensagem'] = "Pedido de recuperação de senha expirado! Realize o pedido de recuperação de senha novamente";

    }

} else {
    
    $_SESSION['mensagem'] = "Pedido de recuperação de senha inválido";

}

header("Location: ../index/entrada.php");

?>