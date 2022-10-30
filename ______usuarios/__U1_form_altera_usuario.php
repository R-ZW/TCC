<?php

$sql = "SELECT * FROM usuarios WHERE id_usuario='" . $_SESSION['id_usuario']."'";
$resultado = mysqli_query($conexao, $sql);
$linha = mysqli_fetch_assoc($resultado);

?>

        <form action="../../______usuarios/__U2_altera_usuario.php" method="post" enctype="multipart/form-data" id="edicao_usuario" onsubmit="return validarSenha();">

            <h4 class="center-align">Editar Conta</h4><br>

            <h6 class='bold'>Nome:<i class="material-icons right">person</i></h6>
            <input id="field" name="nome_usuario" type="text" value="<?php echo $linha['nome_usuario']; ?>" placeholder="insira seu nome" required><br>

            <br>
            <br>

            <h6 class='bold'>Imagem de Perfil (1x1):<i class="material-icons right">image</i></h6>
            
                <div style="display: block !important; text-align: -webkit-center !important;">
                    <img src="<?=$endereco_imagem_usuario;?>" id="imagem_usuario" style="text-align: -webkit-center; border-radius: 100%; width: 240px; height: 240px;">
                </div>

                <br>

                <div class="file-field">
                    <div class="waves-effect waves-light btn grey darken-4" style="margin-left:39%;">
                        <span class="bold"><i class="material-icons left">upload</i> Selecionar Arquivo</span>
                        <input name="endereco_imagem_usuario" type="file" style="text-align: -webkit-center;" accept="image/*" form="edicao_usuario" onchange="previewImagem()">
                    </div>
                </div>
            
            <br>
            <br>
            <br>
            <br>

            <h6 class='bold'>Senha:<i class="material-icons right">lock_outline</i></h6>
            <div class="input-field">
                <div class="text-align: -webkit-center"><i class="material-icons postfix right-align" style="font-size:1.3rem; margin-top:6px;" onclick="mostrar()">remove_red_eye</i></div>
                <input id="senha" class="field" name="senha" type="password" placeholder="caso deseje, insira uma nova senha"><br>
            </div>
            
            <br>

            <h6 class='bold'>Confirmar senha:<i class="material-icons right">lock_open</i></h6>
            <div class="input-field">
                <div class="text-align: -webkit-center"><i class="material-icons postfix right-align" style="font-size:1.3rem; margin-top:6px;" onclick="mostrar_confirmacao()">remove_red_eye</i></div>
                <input id="confirmar_senha" class="field" type="password" onblur="validarSenha()" placeholder="confirme a nova senha"><br>
            </div>
            
            <br>
            <br>

            <input type="hidden" name="senha_antiga" value="<?php echo $linha['senha'];?>">
            <input type="hidden" name="endereco_imagem_usuario_pre_alteracao" value="<?php echo $linha['endereco_imagem_usuario'];?>">

            <div class="left">
                <a href="#excluir" class="modal-trigger waves-effect waves-light btn bold"
                style="background-color: #e53935 !important;">DELETAR CONTA<i class="material-icons right">delete</i>
                </a>
            </div>
            <div class="right">

                <a href="#!" class="modal-close waves-effect waves-light btn bold"
                style="background-color: #212121 !important;">cancelar<i class="material-icons right">close</i>
                </a>

                <button type="submit" class="waves-effect waves-light btn bold"
                style="background-color: #212121 !important;">ENVIAR<i class="material-icons right">check</i>
                </button>

            </div>

            <br>
            <br>

        </form>