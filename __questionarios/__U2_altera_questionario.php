<?php
    echo '<meta charset="UTF-8">';

    include "../_______necessarios/.conexao_bd.php";

    $id_questionario = $_POST['id_questionario'];
    $i = $_POST['i'];
    $id_aula = $_POST['id_aula'];
    $nome_questionario = $_POST['nome_questionario'];

    if(isset($_POST['distribuicao_questoes'])){

        $distribuicao_questoes = "aleatoria";

    } else {

        $distribuicao_questoes = "padronizada";

    }

    $tempo_numero = $_POST['tempo_numero'];
    $tempo_unidade = $_POST['tempo_unidade'];

    $tempo_proxima_realizacao = $tempo_numero."-".$tempo_unidade;


    $sql = "UPDATE questionarios SET nome_questionario='$nome_questionario', distribuicao_questoes='$distribuicao_questoes', tempo_proxima_realizacao='$tempo_proxima_realizacao' WHERE id_questionario=$id_questionario"; 
    $resultado = mysqli_query($conexao,$sql);

    mysqli_close($conexao);

    if($resultado and $i==1){

        header("Location: ../index/produtor/PROD_tela_questionario_produtor.php?id_questionario=$id_questionario");

    } else {

        header("Location: ../index/produtor/PROD__tela_aula_produtor.php?id_aula=$id_aula");

    }
?>