
<form id="form-edita-perfil" action="" method="post">
    <div class="div-container">
        <div class="div-container-conteudo">
            <div class="div-editar-perfil">
                <h1>Editar Perfil</h1>
            </div>

            <div class="div-container-conteudo-imagem-de-perfil">
                <div class="container-imagem-editar">
                    <img class="editar-imagem-perfil" src="<?php echo URL_BASE?>assets/images/logo/logo.png" alt="">

                </div>

                <span class="span-edita-perfil btns005">Alterar foto</span>
            </div>
            
            <div class="div-edita-biografia">
                <span class="biografia-titulo">Editar nome</span>
                <input class="editar-nome" name="name" type="text" placeholder="Editar nome" value="<?php if(isset($name)) echo $name;?>">
            </div>

            <div class="div-edita-biografia">
                <span class="biografia-titulo">Biografia</span>

                <textarea name="bio" id="biografia-textarea" cols="1" rows="1" placeholder="Biografia">
                <?php if(isset($bio)) echo $bio;?>
                </textarea>
            </div>

            <span id="salva" class="btns004 salva">Salva</span>

            
        </div>
    </div>

    <div id="alert-personalizado" class="alert-personalizado">
        <p>Salva Alterações?</p>
        <div class="buttons-div">
            <span id="cancelar-editar" class="btns001 cancalar">Cancelar</span>
            <input class="btns001 alertbutton" type="submit" value="Confirmar">
        </div>
       
    </div>
   </form>

   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   <script src="<?php echo URL_BASE?>assets/scripts/alert.js"></script>