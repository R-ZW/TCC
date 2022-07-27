<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Alterar Módulo</title>
    
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!--Another Icon Font-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../_.materialize/css/materialize.min.css"  media="screen,projection"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!--Link with configs-->
    <link rel="stylesheet" type="text/css" href="../_.materialize/css/configs.css">
    
</head>

<body class="container">
    
    <center><h3 class="bold">Alterar Módulo</h3></center>	
    <br>

    <?php
    
        include_once "../_______necessarios/.conexao_bd.php";

        $id_modulo= $_GET['id_modulo'];

        //obtenção do id_curso
        $sq = "SELECT id_curso FROM modulos WHERE id_modulo=$id_modulo";
        $res = mysqli_query($conexao,$sq);
        $li = mysqli_fetch_assoc($res);

        $id_curso = $li['id_curso'];
        //obtido o id_curso


        //obtenção dos dados do módulo
        $sql = "SELECT * FROM modulos WHERE id_modulo=$id_modulo";
        $resultado = mysqli_query($conexao,$sql);

        $linha = mysqli_fetch_array($resultado);

        mysqli_close($conexao);
        //obtidos os dados do módulo

    ?>

    <form action="__U2_altera_modulo.php" method="post" enctype="multipart/form-data">

        <big>Nome do módulo:</big><input type="text" name="nome_modulo" value="<?php echo $linha['nome_modulo']?>" required><br>

        <br>

        <big>Descrição do módulo:</big> <input type="text" name="descricao_modulo" value="<?php echo $linha['descricao_modulo']?>"><br>

        <br>

        <big>Imagem do módulo:</big><br><br><input type="file" name="endereco_imagem_modulo" accept="image/*"><br>

        <br>
        <br>

        <big>Visibilidade do módulo:</big><br><br>
        
        <div class="switch">
            
            <label>

            <big>Visível</big>

            <?php
            
                if($linha['visibilidade_modulo'] == "visível"){

                    echo "<input type='checkbox' id='visibilidade_modulo' name='visibilidade_modulo' value='1'>";

                } else {

                    echo "<input type='checkbox' id='visibilidade_modulo' name='visibilidade_modulo' value='1' checked>";

                }
            
            ?>

            <span class="lever"></span>

            <big>Não visível</big>

            </label>
            
        </div>

        <br>
        <br>

        <input type="hidden" name="endereco_imagem_modulo_pre_alteracao" value="<?php echo $linha['endereco_imagem_modulo'];?>">
        <input type="hidden" name="id_modulo" value="<?php echo $id_modulo;?>">

        <center>
        <button type="submit" class="waves-effect waves-light btn bold">ENVIAR<i class="material-icons right">check</i></button>
        <button type="reset" class="waves-effect waves-light btn bold">REDEFINIR<i class="material-icons right">refresh</i></button>   
        <a href="../index/produtor/PROD___tela_curso_produtor.php?id_curso=<?php echo $id_curso; ?>" class='waves-effect waves-light btn bold'> Cancelar <i class='material-icons right'>close</i></a>
        </center>
    
    </form>

    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="../_.materialize/js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="../_.materialize/js/materialize.min.js"></script>
    
</body>

</html>