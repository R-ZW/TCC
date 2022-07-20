<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
</head>

<body>

    <?php
    
    include "../_______necessarios/.conexao_bd.php";

    $id_material = $_GET['id_material'];
    $id_aula = $_GET['id_aula'];

    $sql = "DELETE FROM materiais WHERE id_material=$id_material";
    $resultado = mysqli_query($conexao,$sql);

    mysqli_close($conexao);

    if($resultado){

        header("Location: ../index/produtor/PROD__tela_aula_produtor.php?id_aula=$id_aula");

    }

?>


</body>

</html>
