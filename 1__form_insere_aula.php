<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Criação de Aula</title>
    
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!--Another Icon Font-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="materialize/css/materialize.min.css"  media="screen,projection"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!--Link with configs-->
    <link rel="stylesheet" type="text/css" href="materialize/css/configs.css">
    
</head>

<body class="container">

    <?php
    
    require_once ".conexao_bd.php";
    
    $id_modulo = $_GET['id_modulo'];

    //obtenção do id_curso
    $sq = "SELECT id_curso FROM modulos WHERE id_modulo=$id_modulo";
    $res = mysqli_query($conexao,$sq);
    $li = mysqli_fetch_assoc($res);

    $id_curso = $li['id_curso'];
    //obtido o id_curso

    ?>

    <center><h3 class="bold">Criação de Aula</h3></center>

    <br>

    <form action="1__insere_aula.php" method="post" enctype="multipart/form-data">

        <big>Nome da aula:</big> <input type="text" name="nome_aula" required><br>

        <br>

        <big>Descrição da aula:</big> <input type="text" name="descricao_aula" required><br>

        <br>

        <big>Imagem da aula:</big><br><br><input type="file" name="endereco_imagem_aula" accept="image/*"><br>

        <br>
        <br>

        <input type="hidden" name="id_modulo" value="<?php echo $id_modulo; ?>">

        <center>
        <button type="submit" class="waves-effect waves-light btn bold">ENVIAR<i class="material-icons right">check</i></button>
        <button type="reset" class="waves-effect waves-light btn bold">REDEFINIR<i class="material-icons right">refresh</i></button>   
        <a href="1____modificacao_curso.php?id_curso=<?php echo $id_curso; ?>" class='waves-effect waves-light btn bold'> Cancelar <i class='material-icons right'>close</i></a>
        </center>
 
    </form>

    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    
</body>

</html>
