<div class="container-pai">
    <div class="container-imagem-tema">
      <img class="img-image-tema" src="<?php echo URL_BASE."userData/".$image->image_path?>" alt="">

      <!--

      -->

      <div class="sobre-img">
        <h1 class="titulo-img"><?php echo $image->image_title?></h1>

        <p class="descricao-img"><?php echo $image->image_description?></p>
      </div>
      <div class="gostou heart-btn">

      <?php if(isset($liked) && $liked == true) { ?>

        <div class="content" style="background-color: red;"> <!--DEIXOU O LIKE-->
        <a href="<?php echo URL_BASE."image/unlike/$image->image_id"?>" style="text-decoration: none;">

      <?php  }else { ?>

            <div class="content" > <!--NAO DEIXOU O LIKE-->
            <a href="<?php echo URL_BASE."image/like/$image->image_id"?>" style="text-decoration: none;">

        <?php }?>

          <span class="heart"></span>
          <span class="text"> &nbsp; </span>
          <span class="numb"><?php echo $likes?></span>
          </a>
        </div>
         
      </div>
    </div>
    <div class="usuario-que-postou">
      <div class="imagem-perfil">
       <a href=""> <img class="imagem-perfil-img" src="<?php echo URL_BASE?>assets/images/fotodeperfiluser/lontra.jpeg" alt=""></a>
       
      </div>
      <span class="nome-do-usuario"><?php echo $image->user_name?></span>
      <button class="btns005">Seguir</button>

      
    </div>

    <div class="pai-container-comentario">
      <div class="comentarios">
        <div class="titulo-comentario">
          <h3>comentarios</h3>
        </div>
  
        <div class="comentario-digitado">
          <div><a href=""><img class="imagem-do-usuario-comentario" src="<?php echo URL_BASE?>assets/images/fotodeperfiluser/perfilAyano.jpeg" alt=""></a></div>
          <div class="comentariodousuario">
            <span>Rapaz só queria uma dessa lá em casa.</span>
          </div> 
        </div>
        
  
        
  
       
        
      </div>

      <div class="digita-comentario">
        <form action="" method="post">
          <textarea class="comentario-textarea" placeholder="Deixe seu comentário aqui"></textarea>

          <input type="submit" value="Comentar" class="btns004">
        </form>
      </div>
    </div>

     <!--Começo da seção de imagem com texto-->
     <div class="scimg-section-container">
      <h3>Mais Imagem relacionadas</h3>
     <div class="scimg-section">
      <a href=""><img src="<?php echo URL_BASE?>assets/images/personagens/personagens12.png" alt="personagem"></a>
      <a href=""><img src="<?php echo URL_BASE?>assets/images/paisagens/paisagens12.png" alt="personagem"></a>
      <a href=""><img src="<?php echo URL_BASE?>assets/images/paisagens/paisagens2.png" alt="personagem"></a>
      <a href=""><img src="<?php echo URL_BASE?>assets/images/fundopc/fundoPC10.png" alt="personagem"></a>
      <a href=""><img src="<?php echo URL_BASE?>assets/images/personagens/personagens9.png" alt="personagem"></a>
      <a href=""><img src="<?php echo URL_BASE?>assets/images/personagens/personagens33.png" alt="personagem"></a>
     </div>
  </div>
  <!--Fim da seção de imagem com texto-->
  </div>