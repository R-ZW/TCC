<?php
session_start();
require_once ".conexao_bd.php";

$id_usuario= $_SESSION['id_usuario'];

$s = "SELECT * FROM usuarios WHERE id_usuario=$id_usuario";
$r = mysqli_query($conexao, $s);
$l = mysqli_fetch_assoc($r);

$email = $l['email'];


$sq = "SELECT * FROM relacao_usuario_curso WHERE email='$email' AND tipo_relacao='produtor'";
$res = mysqli_query($conexao, $sq);
$p=0;
while ($li[$p]= mysqli_fetch_assoc($res)){

    $p++;

}

if($p>0){

    $_SESSION['mensagem'] = "Você possui $p cursos associados à sua conta como produtor. Para ser possível encerrar a conta, é necessário que não haja nenhum curso associado à ela como produtor.";

    header("Location: 1_____home_produtor.php");

    die;

} else {

    $sql = "DELETE FROM usuarios WHERE id_usuario=$id_usuario";
    $resultado = mysqli_query($conexao,$sql);

    $sql_1 = "DELETE FROM relacao_usuario_curso WHERE email='$email' AND tipo_relacao='consumidor'";
    $resultado_1 = mysqli_query($conexao,$sql_1);
    
    mysqli_close($conexao);
    
    if($resultado){
        header("Location: 00___entrada.php");
    }

    session_destroy();

}

?>
</body>
</html>