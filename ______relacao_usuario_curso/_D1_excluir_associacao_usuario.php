<?php
session_start();
include "../_______necessarios/.conexao_bd.php";

if (!isset($_SESSION['id_usuario'])) {
    $_SESSION['mensagem'] = "Você deve primeiro realizar o login!";
    header("Location: ../nebula.php");
    die;
}

    $email = mysqli_real_escape_string($conexao,$_GET['email']);
    $id_curso = mysqli_real_escape_string($conexao,$_GET['id_curso']);

    //excluindo a relação do usuário com o curso-
    $sql = "DELETE FROM relacao_usuario_curso WHERE email='$email' AND tipo_relacao='consumidor' AND id_curso=$id_curso";
    $resultado = mysqli_query($conexao,$sql);
    //-

    //excluindo a relação do usuário com os questionários-
    $sql_1 = "DELETE FROM relacao_usuario_questionario WHERE email='$email' AND id_curso=$id_curso";
    $resultado_1 = mysqli_query($conexao,$sql_1);
    //-

    //excluindo o favorito do usuário com o curso-
    $sql_2 = "DELETE FROM favoritos_curso WHERE email='$email' AND id_curso=$id_curso";
    $resultado_2 = mysqli_query($conexao,$sql_2);
    //-

    //selecionando os módulos que pertencem ao curso-
    $sql_3 = "SELECT id_modulo FROM modulos WHERE id_curso=$id_curso";
    $resultado_3 = mysqli_query($conexao, $sql_3);

    while ($linha_3 = mysqli_fetch_assoc($resultado_3)){

        $id_modulo[] = $linha_3['id_modulo'];

    }
    //-

    if (!is_null($id_modulo)){
        for($a=0 ; $a<count($id_modulo) ; $a++){

            //excluindo o favorito do usuário com os módulos do curso-
            $sqla[$a] = "DELETE FROM favoritos_modulo WHERE email='$email' AND id_modulo=".$id_modulo[$a];
            $resultadoa[$a] = mysqli_query($conexao, $sqla[$a]);
            //-


            //selecionando as aulas dos módulos do curso-
            $sqla_2[$a] = "SELECT id_aula FROM aulas WHERE id_modulo=".$id_modulo[$a];
            $resultadoa_2[$a] = mysqli_query($conexao, $sqla_2[$a]);

            while ($linhaa_2 = mysqli_fetch_assoc($resultadoa_2[$a])){

                $id_aula[] = $linhaa_2['id_aula'];

            }
            //-

        }
    }

    if(!is_null($id_aula)){
        for($b=0 ; $b<count($id_aula) ; $b++){

            //excluindo o favorito do usuário com as aulas do curso-
            $sqlb[$b] = "DELETE FROM favoritos_aula WHERE email='$email' AND id_aula=".$id_aula[$b];
            $resultadob[$b] = mysqli_query($conexao, $sqlb[$b]);
            //-

        }
    }

    if($resultado){

        $_SESSION['mensagem'] = "Usuário desassociado com sucesso!";
        header("Location: ../index/produtor/PROD___tela_curso_produtor.php?id_curso=$id_curso");

    }

?>