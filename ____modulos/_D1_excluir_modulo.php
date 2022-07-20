<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
</head>

<body>

    <?php
    
    include "../_______necessarios/.conexao_bd.php";

    $id_modulo = $_GET['id_modulo'];

    //obtendo o id_curso
    $sql = "SELECT id_curso FROM modulos WHERE id_modulo=$id_modulo";
    $resultado = mysqli_query($conexao,$sql);
    $linha = mysqli_fetch_assoc($resultado);

    $id_curso = $linha['id_curso'];
    //obtido o id_curso


    //obtendo o id_aula
    $sql_1 = "SELECT id_aula FROM aulas WHERE id_modulo=$id_modulo";
    $resultado_1 = mysqli_query($conexao,$sql_1);

    while($linha_1 = mysqli_fetch_assoc($resultado_1))
    {

        $id_aula[]= $linha_1['id_aula']; 

    }
    //obtido o id_aula

    //deletando os materiais da aula
    if(isset($linha_1) or isset($id_aula)){

        for($i=0 ; $i<count($id_aula) ; $i++){

            $sqli[$i] = "DELETE FROM materiais WHERE id_aula=".$id_aula[$i];
            $resultadoi[$i] = mysqli_query($conexao,$sqli[$i]);

        }

    }
    //delatados os materiais


    //deletando a aula
    $sql_2 = "DELETE FROM aulas WHERE id_modulo=$id_modulo";
    $resultado_2 = mysqli_query($conexao,$sql_2);
    //delatada a aula

    
    //deletando o módulo
    $sql_3 = "DELETE FROM modulos WHERE id_modulo=$id_modulo";
    $resultado_3 = mysqli_query($conexao,$sql_3);
    //delatada o módulo


    mysqli_close($conexao);

    if($resultado and $resultado_1 and $resultado_3){

        header("Location: ../index/produtor/PROD___tela_curso_produtor.php?id_curso=$id_curso");

    }

?>


</body>

</html>
