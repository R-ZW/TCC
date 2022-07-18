<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
</head>

<body>

    <?php
    
    include ".conexao_bd.php";

    $id_aula = $_GET['id_aula'];

    //obtendo o id_modulo para obter o id_curso
    $sql = "SELECT id_modulo FROM aulas WHERE id_aula=$id_aula";
    $resultado = mysqli_query($conexao,$sql);
    $linha = mysqli_fetch_assoc($resultado);

    $id_modulo = $linha['id_modulo'];
    //obtido o id_modulo


    //obtendo o id_curso
    $sql_1 = "SELECT id_curso FROM modulos WHERE id_modulo=$id_modulo";
    $resultado_1 = mysqli_query($conexao,$sql_1);
    $linha_1 = mysqli_fetch_assoc($resultado_1);

    $id_curso = $linha_1['id_curso'];
    //obtido o id_curso


    //deletando os materiais da aula
    $sql_2 = "DELETE FROM materiais WHERE id_aula=$id_aula";
    $resultado_2 = mysqli_query($conexao,$sql_2);
    //delatados os materiais

    //deletando a aula
    $sql_3 = "DELETE FROM aulas WHERE id_aula=$id_aula";
    $resultado_3 = mysqli_query($conexao,$sql_3);
    //delatada a aula

    mysqli_close($conexao);

    if($resultado and $resultado_1 and $resultado_2 and $resultado_3){

        header("Location: 1____modificacao_curso.php?id_curso=$id_curso");

    }

?>


</body>

</html>
