<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Criação de Curso</title>
    
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

    <?php
    
    require_once "../_______necessarios/.conexao_bd.php";
    
    $email = $_SESSION['email'];

    ?>

    <center><h3 class="bold">Criação de Curso</h3></center>

    <br>

    <form action="____C2_insere_curso.php" method="post" enctype="multipart/form-data" id="insere_curso">

        <big>Nome do curso:</big> <input type="text" name="nome_curso" required><br>

        <br>

        <big>Descrição do curso:</big><input type="text" name="descricao_curso" required><br>

        <br>

        <big>Imagem do curso:</big><br><br><input type="file" name="endereco_imagem_curso" accept="image/*"><br>

        <br>

        <big>Certificado de conclusão do curso (só disponível caso haja questionários válidos):</big><br><br><input type="file" name="endereco_certificado_curso" accept="image/*,.pdf"><br>

        <br>
        <br>

        <big>Visibilidade do curso:</big><br><br>
        
        <div class="switch">
            
            <label>

            <big>Visível</big>

            <input type="checkbox" id="visibilidade_curso" name="visibilidade_curso" value="1">

            <span class="lever"></span>

            <big>Não visível</big>

            </label>
        </div>
        
        <br>
        <br>

        <input type="hidden" name="email" value="<?php echo $email; ?>">

        <center>
        <button type="submit" class="waves-effect waves-light btn bold">ENVIAR<i class="material-icons right">check</i></button>
        <button type="reset" class="waves-effect waves-light btn bold">REDEFINIR<i class="material-icons right">refresh</i></button>
        <a href="../index/produtor/PROD____home_produtor.php?email=<?php echo $email; ?>" class="waves-effect waves-light btn bold">Cancelar <i class="material-icons right">close</i></a>
        </center>

    </form>

    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="../_.materialize/js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="../_.materialize/js/materialize.min.js"></script>
    
</body>

</html>
