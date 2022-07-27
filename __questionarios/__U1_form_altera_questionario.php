<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Alterar Questionário</title>
    
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!--Another Icon Font-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="**../_.materialize/css/materialize.min.css"  media="screen,projection"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!--Link with configs-->
    <link rel="stylesheet" type="text/css" href="../_.materialize/css/configs.css">
    
</head>

<body class="container">
    
    <center><h3 class="bold">Alterar Questionário</h3></center>
    <br>

    <?php
    
        include_once "../_______necessarios/.conexao_bd.php";

        $id_questionario= $_GET['id_questionario'];
        $i= $_GET['i'];


        //obtenção dos dados do questionário-
        $sql = "SELECT * FROM questionarios WHERE id_questionario=$id_questionario";
        $resultado = mysqli_query($conexao,$sql);

        $linha = mysqli_fetch_array($resultado);

        $id_aula = $linha['id_aula'];
        //-

        $tempo = explode("-",$linha['tempo_proxima_realizacao']);
        
        $tempo_numero = $tempo[0];
        $tempo_unidade = $tempo[1];

    ?>

    <form action="__U2_altera_questionario.php" method="post">
 
        <big>Nome do questionário:</big><input type="text" name="nome_questionario" value="<?php echo $linha['nome_questionario']?>" required><br>

        <br>

        <big>Distribuição das questões:</big><br><br>

        <div class="switch">
            
            <label>

            <big>Padronizada</big>

            <?php
            
                if($linha['distribuicao_questoes'] == "padronizada"){

                    echo "<input type='checkbox' id='distribuicao_questoes' name='distribuicao_questoes' value='1'>";

                } else {

                    echo "<input type='checkbox' id='distribuicao_questoes' name='distribuicao_questoes' value='1' checked>";

                }
            
            ?>

            <span class="lever"></span>

            <big>Aleatória</big>

            </label>
            
        </div>

        <br>

        <big>Tempo de espera para nova realização:</big><br>

        <input type="number" name="tempo_numero" value="<?php echo $tempo_numero?>">
        
            <select name="tempo_unidade">
                <?php
                
                    if($tempo_unidade == "M"){

                        echo "<option value='M' selected>minutos</option>
                              <option value='H'>horas</option>
                              <option value='D'>dias</option>";

                    }

                    if($tempo_unidade == "H"){

                        echo "<option value='M'>minutos</option>
                              <option value='H' selected>horas</option>
                              <option value='D'>dias</option>";

                    }

                    if($tempo_unidade == "D"){

                        echo "<option value='M'>minutos</option>
                              <option value='H'>horas</option>
                              <option value='D' selected>dias</option>";

                    }
                
                
                ?>
                
            </select>

        <br>
        <br>

        <big>Visibilidade do questionário:</big><br><br>
        
        <div class="switch">
            
            <label>

            <big>Visível</big>

            <?php
            
                if($linha['visibilidade_questionario'] == "visível"){

                    echo "<input type='checkbox' id='visibilidade_questionario' name='visibilidade_questionario' value='1'>";

                } else {

                    echo "<input type='checkbox' id='visibilidade_questionario' name='visibilidade_questionario' value='1' checked>";

                }
            
            ?>

            <span class="lever"></span>

            <big>Não visível</big>

            </label>
            
        </div>

        <br>
        <br>

        <input type="hidden" name="id_questionario" value="<?php echo $id_questionario;?>">
        <input type="hidden" name="i" value="<?php echo $i;?>">
        <input type="hidden" name="id_aula" value="<?php echo $id_aula;?>">


        <center>
        <button type="submit" class="waves-effect waves-light btn bold">ENVIAR<i class="material-icons right">check</i></button>
        <button type="reset" class="waves-effect waves-light btn bold">REDEFINIR<i class="material-icons right">refresh</i></button>
        <?php
        
        if($i==0){

            echo "<a href='../index/produtor/PROD__tela_aula_produtor.php?id_aula=$id_aula' class='waves-effect waves-light btn bold'> Cancelar <i class='material-icons right'>close</i></a>";

        } elseif($i==1) {

            echo "<a href='../index/produtor/PROD_tela_questionario_produtor.php?id_questionario=$id_questionario' class='waves-effect waves-light btn bold'>Cancelar<i class='material-icons right'>close</i></a>";

        }

        ?>
        </center>

    </form>

    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="../_.materialize/js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="../_.materialize/js/materialize.min.js"></script>
    
</body>

</html>