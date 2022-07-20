<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
</head>

<body>

    <?php
    
    include "../_______necessarios/.conexao_bd.php";

    $email = $_GET['email'];
    $id_curso = $_GET['id_curso'];

    $sql = "DELETE FROM relacao_usuario_curso WHERE email='$email' AND tipo_relacao='consumidor' AND id_curso=$id_curso";
    $resultado = mysqli_query($conexao,$sql);

    mysqli_close($conexao);

    if($resultado){

        header("Location: ../index/produtor/PROD___tela_curso_produtor.php?id_curso=$id_curso");

    }

?>


</body>

</html>
