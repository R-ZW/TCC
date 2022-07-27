<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Alterar Aula</title>
    
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
    
    <center><h3 class="bold">Alterar Aula</h3></center>	
    <br>

    <?php
    
        include_once "../_______necessarios/.conexao_bd.php";

        $id_aula= $_GET['id_aula'];
        $i= $_GET['i'];


        //obtendo o id_modulo
        $sql = "SELECT id_modulo FROM aulas WHERE id_aula=$id_aula";
        $resultado = mysqli_query($conexao, $sql);
        $linha = mysqli_fetch_assoc($resultado);

        $id_modulo = $linha['id_modulo'];
        //obtido o id_modulo


        //obtendo o id_curso
        $sql_1 = "SELECT id_curso FROM modulos WHERE id_modulo=$id_modulo";
        $resultado_1 = mysqli_query($conexao, $sql_1);
        $linha_1 = mysqli_fetch_assoc($resultado_1);

        $id_curso = $linha_1['id_curso'];
        //obtido o id_curso


        //obtenção dos dados da aula
        $sql_2 = "SELECT * FROM aulas WHERE id_aula=$id_aula";
        $resultado_2 = mysqli_query($conexao,$sql_2);

        $linha_2 = mysqli_fetch_array($resultado_2);

        mysqli_close($conexao);

    ?>

    <form action="__U2_altera_aula.php" method="post" enctype="multipart/form-data">

        <big>Nome da aula:</big> <input type="text" name="nome_aula" value="<?php echo $linha_2['nome_aula']?>" required><br>

        <br>

        <big>Descrição da aula:</big> <input type="text" name="descricao_aula" value="<?php echo $linha_2['descricao_aula']?>"><br>

        <br>

        <big>Imagem da aula:</big><br><br><input type="file" name="endereco_imagem_aula" accept="image/*"><br>

        <br>
        <br>

        <big>Visibilidade da aula:</big><br><br>
        
        <div class="switch">
            
            <label>

            <big>Visível</big>

            <?php
            
                if($linha_2['visibilidade_aula'] == "visível"){

                    echo "<input type='checkbox' id='visibilidade_aula' name='visibilidade_aula' value='1'>";

                } else {

                    echo "<input type='checkbox' id='visibilidade_aula' name='visibilidade_aula' value='1' checked>";

                }
            
            ?>

            <span class="lever"></span>

            <big>Não visível</big>

            </label>
            
        </div>

        <br>
        <br>

        <input type="hidden" name="endereco_imagem_aula_pre_alteracao" value="<?php echo $linha_2['endereco_imagem_aula'];?>">
        <input type="hidden" name="id_aula" value="<?php echo $id_aula;?>">
        <input type="hidden" name="i" value="<?php echo $i;?>">

        <center>
        <button type="submit" class="waves-effect waves-light btn bold">ENVIAR<i class="material-icons right">check</i></button>
        <button type="reset" class="waves-effect waves-light btn bold">REDEFINIR<i class="material-icons right">refresh</i></button>  
        <?php
        
            if($i==0){

                echo "<a href='../index/produtor/PROD___tela_curso_produtor.php?id_curso=$id_curso' class='waves-effect waves-light btn bold'> Cancelar <i class='material-icons right'>close</i></a>";

            } elseif($i==1) {

                echo "<a href='../index/produtor/PROD__tela_aula_produtor.php?id_aula=$id_aula' class='waves-effect waves-light btn bold'> Cancelar <i class='material-icons right'>close</i></a>";

            }

        ?>
        </center>

    </form>

    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="../_.materialize/js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="../_.materialize/js/materialize.min.js"></script>
    
</body>

</html>