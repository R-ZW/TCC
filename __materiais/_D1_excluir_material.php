<?php

    include "../_______necessarios/.conexao_bd.php";

    $id_material = $_GET['id_material'];
    $id_aula = $_GET['id_aula'];

    $sql = "SELECT * FROM materiais WHERE id_material=$id_material";
    $resultado = mysqli_query($conexao,$sql);
    $linha = mysqli_fetch_assoc($resultado);

    //obtendo e adaptando o endereço do material
        $endereco = $linha['endereco_material'];
        $endereco_m = explode("/", $endereco);
        $endereco_ma = array_reverse($endereco_m);
        $endereco_material = $endereco_ma[1] ."/". $endereco_ma[0];
    //-

    unlink($endereco_material);

    $sql_1 = "DELETE FROM materiais WHERE id_material=$id_material";
    $resultado_1 = mysqli_query($conexao,$sql_1);

    mysqli_close($conexao);

    if($resultado and $resultado_1){

        header("Location: ../index/produtor/PROD__tela_aula_produtor.php?id_aula=$id_aula");

    }

?>