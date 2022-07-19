<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Tela de Aula</title>
    
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
    
        include_once ".conexao_bd.php";

        $id_aula= $_GET['id_aula'];
        $email= $_GET['email'];

        
        //obtenção do id_modulo
        $s = "SELECT id_modulo FROM aulas WHERE id_aula=$id_aula";
        $r = mysqli_query($conexao,$s);
        $l = mysqli_fetch_assoc($r);
        $id_modulo = $l['id_modulo'];
        //obtido o id_modulo


        //obtenção do id_curso
        $sq = "SELECT id_curso FROM modulos WHERE id_modulo=$id_modulo";
        $re = mysqli_query($conexao,$sq);
        $li = mysqli_fetch_assoc($re);
        $id_curso = $li['id_curso'];
        //obtido o id_curso


        //obtenção dos dados da aula
        $sql = "SELECT nome_aula, descricao_aula, endereco_imagem_aula FROM aulas WHERE id_aula=$id_aula";
        $resultado = mysqli_query($conexao,$sql); 

        while($linha = mysqli_fetch_assoc($resultado))
        {

            $nome_aula= $linha['nome_aula'];
	        $descricao_aula = $linha['descricao_aula'];
	        $endereco_imagem_aula = $linha['endereco_imagem_aula'];

        } 
        //fim da obtenção dos dados da aula


        //obtenção dos dados dos materiais
        $sql_1 = "SELECT id_material, nome_material, endereco_material FROM materiais WHERE id_aula=$id_aula";
        $resultado_1 = mysqli_query($conexao,$sql_1); 

        while($linha_1 = mysqli_fetch_assoc($resultado_1))
        {

            $id_material[] = $linha_1['id_material'];
            $nome_material[] = $linha_1['nome_material'];
            $endereco_material[] = $linha_1['endereco_material'];

        }

        echo "<h2 class='center-align bold'>$nome_aula</h2><br>"; 
        echo "<center><img  class='materialboxed' src='$endereco_imagem_aula'></center><br><br>";
        echo "<h5>$descricao_aula</h5><br><br>";

        if(isset($id_material)){
            for($i=0 ; $i<count($id_material) ; $i++){

                $arq= explode(".",$endereco_material[$i]);
                $ext= $arq[count($arq)-1];
        
                if($ext == "mp4"){

                    echo "<h5><center>".$nome_material[$i]."</center></h5><video src='".$endereco_material[$i]."' controls width='100%'></video><br><br>";

                } elseif($ext == "jpg" or $ext == "jpeg" or $ext == "png" or $ext == "gif" or $ext == "webp" or $ext == "psd"){

                    echo "<h5><center>".$nome_material[$i]."</center></h5><img src='".$endereco_material[$i]."' width='100%' download></img><br><br>";

                } else {
            
                    echo "<h5>".$nome_material[$i]." <a href='".$endereco_material[$i]."' download class='white-text'><div class='waves-effect waves-light btn btn-floating'><i class='material-icons right'>download</i></div></a></h5><br>";

                }

            }
        } else {

            echo "- Não existem materiais cadastrados nesta aula.<br><br>";

        }

        echo "<br><center><a href='0__tela_curso.php?email=$email&id_curso=$id_curso'class='white-text'><div class='waves-effect waves-light btn bold'>Voltar<i class='material-icons left'>keyboard_backspace</i></div></a></center><br><br>";
    ?>
    
    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    
</body>

</html>