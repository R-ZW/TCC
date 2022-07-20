<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Alterar Curso</title>
    
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
    
    <center><h3 class="bold">Alterar Curso</h3></center>
    <br>

    <?php
    
        include_once "../_______necessarios/.conexao_bd.php";

        $id_curso= $_GET['id_curso'];
        $i= $_GET['i'];

        //obtendo o email do produtor
        $sq = "SELECT email FROM relacao_usuario_curso WHERE id_curso=$id_curso AND tipo_relacao='produtor'";
        $res = mysqli_query($conexao,$sq);

        $li = mysqli_fetch_assoc($res);

        $email = $li['email'];
        //obtido o email do produtor


        //obtenção dos dados do curso
        $sql = "SELECT nome_curso, descricao_curso, endereco_imagem_curso FROM cursos WHERE id_curso=$id_curso";
        $resultado = mysqli_query($conexao,$sql);

        $linha = mysqli_fetch_array($resultado);

        mysqli_close($conexao);

    ?>

    <form action="__U2_altera_curso.php" method="post" enctype="multipart/form-data">

        <big>Nome do curso:</big> <input type="text" name="nome_curso" value="<?php echo $linha['nome_curso']?>" required><br>

        <br>

        <big>Descrição do curso:</big><input type="text" name="descricao_curso" value="<?php echo $linha['descricao_curso']?>"><br>

        <br>

        <big>Imagem do curso:</big><br><br><input type="file" name="endereco_imagem_curso" accept="image/*"><br>

        <br>
        <br>

        <input type="hidden" name="endereco_imagem_curso_pre_alteracao" value="<?php echo $linha['endereco_imagem_curso'];?>">
        <input type="hidden" name="id_curso" value="<?php echo $id_curso;?>">
        <input type="hidden" name="i" value="<?php echo $i;?>">
        <input type="hidden" name="email" value="<?php echo $email;?>">

        <center>
        <button type="submit" class="waves-effect waves-light btn bold">ENVIAR<i class="material-icons right">check</i></button>
        <button type="reset" class="waves-effect waves-light btn bold">REDEFINIR<i class="material-icons right">refresh</i></button>        
        <?php
        
            if($i==0){

                echo "<a href='../index/produtor/PROD____home_produtor.php' class='waves-effect waves-light btn bold'> Cancelar <i class='material-icons right'>close</i></a>";

            } elseif($i==1) {

                echo "<a href='../index/produtor/PROD___tela_curso_produtor.php?id_curso=$id_curso' class='waves-effect waves-light btn bold'> Cancelar <i class='material-icons right'>close</i></a>";

            }

        ?>
        </center>

    </form>

    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="../_.materialize/js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="../_.materialize/js/materialize.min.js"></script>
    
</body>

</html>