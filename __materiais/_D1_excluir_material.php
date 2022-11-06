<?php
session_start();
include "../_______necessarios/.conexao_bd.php";

if (!isset($_SESSION['id_usuario'])) {
    $_SESSION['mensagem'] = "Você deve primeiro realizar o login!";
    header("Location: ../nebula.php");
    die;
}

    $id_material = mysqli_real_escape_string($conexao,$_GET['id_material']);

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

    
    if($resultado and $resultado_1){

        $_SESSION['mensagem'] = "Material excluído com sucesso!";
        echo "<script>window.history.go(-1);</script>";

    }

?>