    <form action="../../_____cursos/____C2_insere_curso.php" method="post" id="criar_curso" enctype="multipart/form-data">

        <h4 class="center-align">Criar Curso</h4><br>

        <h6 class="bold">Nome do curso:<i class="material-icons right">border_color</i></h6>
        <input id="field" type="text" name="nome_curso" placeholder="insira o nome do curso" required>

        <br>
        <br>

        <h6 class="bold">Descrição do curso:<i class="material-icons right">subject</i></h6>
        <div class="input-field col s12">
        <textarea id="field" type="text" name="descricao_curso" placeholder="insira a descrição do curso" class="materialize-textarea" style="text-align:justify" required></textarea>
        </div>

        <h6 class="bold">Imagem do curso (16x9):<i class="material-icons right">image</i></h6>

        <div class="file-field">
            <div class="waves-effect waves-light btn grey darken-4" style="margin-left:39%;">
                <span class="bold"><i class="material-icons left">upload</i> Selecionar Arquivo</span>
                <input id="endereco_imagem_curso_cadastro" name="endereco_imagem_curso" type="file" style="text-align: -webkit-center;" accept="image/*" onchange="previewImagemCurso()">
            </div>
        </div>

        <br>
        <br>
        <br>
        <h6 class="bold center-align" style="font-style:italic;">preview da home:</h6>
        <div class="card-panel hoverable">
            <div class="row">
                <div class="col s5">
                
                    <br>
                    <img id="imagem_curso_cadastro" src="../../_.imgs_default/sem_imagem.png" width="300em" height="169em" style="border-radius:4%;">
            
                </div>
            
                <div class="col s7">

                    <h5 class="bold center-align">[*nome do curso*]</h5>
                    <br>
                    <h6 style="text-align:justify; font-size:1.3em;">[*descrição do curso*].</h6>

                </div> 
            </div>
        </div>

        <br>

        <h6 class='bold center-align' style='font-style:italic;'>preview da tela de curso:</h6>
        <div class='col s12' style='padding:0px;'>
            <div class='card meddium'>

                <div class='card-image'>
                    <img id='imagem_curso_cadastro_1' src="../../_.imgs_default/sem_imagem.png" style='filter: brightness(80%);' width='900em' height='506.25em'>
                    <div class='card-title' style='width:100%; font-weight:400; font-size:2em; text-align: -webkit-center; backdrop-filter: brightness(70%)'>
                        [*nome do curso*]
                    </div>
                </div>

                <div class='card-content'>
                    <h6 style='text-align: justify; font-size:1.5em;'>[*descrição do curso*]</h6>
                </div>

            </div>
        </div>

        <br>

        <h6 class="bold">Visibilidade do curso: <i class="material-icons right">remove_red_eye</i></h6><br>

        <div class="switch">
            
            <label>

            <h6 class="bold">Não visível

            <input type="checkbox" id="visibilidade_curso" name="visibilidade_curso" value="1" checked>

            <span class="lever"></span>

            Visível</h6>

            </label>
            
        </div>

        <br>
        <br>

        <div class="right">

            <a href="#!" class="modal-close waves-effect waves-light btn bold"
            style="background-color: #212121 !important;">cancelar<i class="material-icons right">close</i>
            </a>

            <button type="submit" class="waves-effect waves-light btn bold"
            style="background-color: #212121 !important;">ENVIAR<i class="material-icons right">check</i>
            </button>

            <br>
            <br>

        </div> 
    </form>