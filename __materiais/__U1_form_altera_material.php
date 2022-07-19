<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Alterar Material</title>
    
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
    
    <center><h3 class="bold">Alterar Material</h3></center>
    <br>

    <?php
    
        include_once ".conexao_bd.php";

        $id_material= $_GET['id_material'];
        $id_aula= $_GET['id_aula'];


        //obtenção dos dados do material
        $sql = "SELECT nome_material, endereco_material FROM materiais WHERE id_material=$id_material";
        $resultado = mysqli_query($conexao,$sql);

        $linha = mysqli_fetch_array($resultado);

        mysqli_close($conexao);

    ?>

    <form action="1_altera_material.php" method="post" enctype="multipart/form-data">
 
        <big>Nome do material:</big><input type="text" name="nome_material" value="<?php echo $linha['nome_material']?>" required><br>

        <br>

        <big>Inserir material:</big><br><br><input type="file" name="endereco_material" accept="image/*, video/*, audio/*, .pdf, .docx, .ppt, .odt., .odf, .txt"><br>

        <br>
        <br>

        <input type="hidden" name="id_material" value="<?php echo $id_material;?>">
        <input type="hidden" name="id_aula" value="<?php echo $id_aula;?>">
        <input type="hidden" name="endereco_material_pre_alteracao" value="<?php echo $linha['endereco_material'];?>">

        <center>
        <button type="submit" class="waves-effect waves-light btn bold">ENVIAR<i class="material-icons right">check</i></button>
        <button type="reset" class="waves-effect waves-light btn bold">REDEFINIR<i class="material-icons right">refresh</i></button>
        <a href='1__modificacao_aula.php?id_aula=<?php echo $id_aula; ?>' class='waves-effect waves-light btn bold'>Cancelar<i class='material-icons right'>close</i></a>
        </center>

    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    
</body>

</html>