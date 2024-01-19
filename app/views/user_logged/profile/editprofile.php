
<form id="form-edita-perfil" action="" method="post" enctype="multipart/form-data">
    <div class="div-container">
        <div class="div-container-conteudo">
            <div class="div-editar-perfil">
                <h1>Editar Perfil</h1>
            </div>

            <div class="div-container-conteudo-imagem-de-perfil">
                <div class="container-imagem-editar">
                    <?php if(isset($userData["user_image"])) { ?>
                        <img id="preview" class="editar-imagem-perfil" src="<?php echo URL_BASE?>userData/user<?php echo $userData["user_id"]?>/profile/<?php echo $userData["user_image"]?>" alt="">
                    <?php }else { ?>
                        <img id="preview" class="editar-imagem-perfil" src="<?php echo URL_BASE?>assets/images/recursos/perfilNull.jpg" alt="">
                    <?php }?>
                    
                </div>

                <label for="input-file" class="span-edita-perfil btns005">Alterar foto</label>

                <input class="input-img-edita-perfil" type="file" name="profile" id="input-file" onchange="previewImage(event)" accept="image/*">

               
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
   <script>
    function previewImage(event) {
        var input = event.target;
        var preview = document.getElementById('preview');
        
        var reader = new FileReader();
        reader.onload = function(){
            preview.src = reader.result;
        };
        reader.readAsDataURL(input.files[0]);
}
</script>