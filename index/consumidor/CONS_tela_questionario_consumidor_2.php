<?php
    session_start();
?>
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
    <link type="text/css" rel="stylesheet" href="../../_.materialize/css/materialize.min.css"  media="screen,projection"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!--Link with configs-->
    <link rel="stylesheet" type="text/css" href="../../_.materialize/css/configs.css">
    
</head>
<body class="container">
    
    <?php

        include_once "../../_______necessarios/.conexao_bd.php";

        $questoes = $_SESSION['questoes'];
        $email = $_SESSION['email'];


        $acertos=0;

    

        for($a=0 ; $a<count($questoes) ; $a++){

            $x = $questoes[$a]['id_questao'];


            if($_POST[$x] == "correta"){

                $acertos++;

            }

        }

        $per = ($acertos/count($questoes))*100;


        for($b=0 ; $b<count($questoes) ; $b++){


            echo "<input type='radio'";

        }

        echo $per;
        
    ?>
</body>
</html>