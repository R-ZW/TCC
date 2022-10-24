<?php
    session_start();

    $id_curso= $_GET['id_curso'];

    //obtendo o email do produtor-
    $sq = "SELECT email FROM relacao_usuario_curso WHERE id_curso=$id_curso AND tipo_relacao='produtor'";
    $res = mysqli_query($conexao,$sq);

    $li = mysqli_fetch_assoc($res);

    $email = $li['email'];
    //-


    //obtenção dos dados do curso
    $sql = "SELECT * FROM cursos WHERE id_curso=$id_curso";
    $resultado = mysqli_query($conexao,$sql);

    $linha = mysqli_fetch_array($resultado);

    mysqli_close($conexao);
    //-

?>

<form action="../../_____cursos/__U2_altera_curso.php" method="post" enctype="multipart/form-data">

    <big>Nome do curso:</big> <input type="text" name="nome_curso" value="<?php echo $linha['nome_curso']?>" required><br>

    <br>

    <big>Descrição do curso:</big><input type="text" name="descricao_curso" value="<?php echo $linha['descricao_curso']?>"><br>

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

        <?php
        
            if($linha['visibilidade_curso'] == "visível"){

                echo "<input type='checkbox' id='visibilidade_curso' name='visibilidade_curso' value='1'>";

            } else {

                echo "<input type='checkbox' id='visibilidade_curso' name='visibilidade_curso' value='1' checked>";

            }
        
        ?>

        <span class="lever"></span>

        <big>Não visível</big>

        </label>
        
    </div>

    <br>
    <br>

    <input type="hidden" name="endereco_imagem_curso_pre_alteracao" value="<?php echo $linha['endereco_imagem_curso'];?>">
    <input type="hidden" name="endereco_certificado_curso_pre_alteracao" value="<?php echo $linha['endereco_certificado_curso'];?>">
    <input type="hidden" name="id_curso" value="<?php echo $id_curso;?>">
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