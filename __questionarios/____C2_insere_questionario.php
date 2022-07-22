<?php

    include_once "../_______necessarios/.conexao_bd.php";

    $id_aula = $_POST['id_aula'];
    $nome_questionario = $_POST['nome_questionario'];

    if(isset($_POST['distribuicao_questoes'])){

        $distribuicao_questoes = "aleatoria";

    } else {

        $distribuicao_questoes = "padronizada";

    }
    

    date_default_timezone_set('America/Sao_Paulo');
    $data = date("Y-m-d H:i:s");


    //obtendo o id_modulo-
    $sql = "SELECT id_modulo FROM aulas WHERE id_aula=$id_aula";
    $resultado = mysqli_query($conexao, $sql);
    $linha = mysqli_fetch_assoc($resultado);

    $id_modulo = $linha['id_modulo'];
    //-


    //obtendo o id_curso-
    $sql_1 = "SELECT id_curso FROM modulos WHERE id_modulo=$id_modulo";
    $resultado_1 = mysqli_query($conexao, $sql_1);
    $linha_1 = mysqli_fetch_assoc($resultado_1);

    $id_curso = $linha_1['id_curso'];
    //-


    //obtendo os usuários associados ao curso-
    $sql_2 = "SELECT email FROM relacao_usuario_curso WHERE id_curso=$id_curso AND tipo_relacao='consumidor'";
    $resultado_2 = mysqli_query($conexao, $sql_2);

    while ($linha_2 = mysqli_fetch_assoc($resultado_2))
    {

        $email[] = $linha_2['email'];

    }
    //-


    //inserindo os dados do questionario-
    $sql_3 = "INSERT INTO questionarios(id_aula, nome_questionario, distribuicao_questoes, data_criacao_questionario) 
    VALUES ('$id_aula', '$nome_questionario', '$distribuicao_questoes', '$data')";

    $resultado_3 = mysqli_query($conexao,$sql_3);
    //-


    // pegar o id gerado-
    $id_questionario = mysqli_insert_id($conexao);
    //-


    //inserir os usuários do curso na relação-
    if(isset($email) or isset($linha_2)){

        for($a=0 ; $a<count($email) ; $a++){

            $sqla[$a] = "INSERT INTO relacao_usuario_questionario(email, id_questionario, id_curso, nota_usuario) 
            VALUES ('". $email[$a] ."', '$id_questionario', '$id_curso', 'não-realizado')";

            $resultadoa[$a] = mysqli_query($conexao, $sqla[$a]);

        }

    }
    //-


    if($resultado)
    {

	    header("Location: ../index/produtor/PROD_tela_questionario_produtor.php?id_questionario=$id_questionario");

    }

    mysqli_close($conexao);

?>
