<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Alterar Alternativa</title>
    
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
    
    <center><h3 class="bold">Alterar Alternativa</h3></center>
    <br>

    <?php
    
        include_once "../_______necessarios/.conexao_bd.php";

        $id_alternativa= $_GET['id_alternativa'];
        $id_questionario= $_GET['id_questionario'];

        //obtenção dos dados da alternativa
        $sql = "SELECT * FROM alternativas WHERE id_alternativa=$id_alternativa";
        $resultado = mysqli_query($conexao,$sql);

        $linha = mysqli_fetch_array($resultado);

        mysqli_close($conexao);

    ?>

    <form action="__U2_altera_alternativa.php" method="post">
 
        <big>Desenvolvimento da alternativa:</big><input type="text" name="desenvolvimento_alternativa" value="<?php echo $linha['desenvolvimento_alternativa']?>" required><br>

        <br>

        <big>Validade da alternativa:</big><br><br>

        <div class="switch">
            <label>

            <big>Incorreta</big>

            <?php
            
                if($linha['validade_alternativa'] == "incorreta"){

                    echo "<input type='checkbox' id='validade_alternativa' name='validade_alternativa' value='1'>";

                } else {

                    echo "<input type='checkbox' id='validade_alternativa' name='validade_alternativa' value='1' checked>";

                }
            
            ?>

            <span class="lever"></span>

            <big>Correta</big>

            </label>
            
        </div>


        <br>
        <br>

        <input type="hidden" name="id_alternativa" value="<?php echo $id_alternativa;?>">
        <input type="hidden" name="id_questionario" value="<?php echo $id_questionario;?>">

        <center>
        <button type="submit" class="waves-effect waves-light btn bold">ENVIAR<i class="material-icons right">check</i></button>
        <button type="reset" class="waves-effect waves-light btn bold">REDEFINIR<i class="material-icons right">refresh</i></button>
        <a href='../index/produtor/PROD_tela_questionario_produtor.php?id_questionario=<?php echo $id_questionario; ?>' class='waves-effect waves-light btn bold'>Cancelar<i class='material-icons right'>close</i></a>
        </center>

    </form>

    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="../_.materialize/js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="../_.materialize/js/materialize.min.js"></script>
    
</body>

</html>