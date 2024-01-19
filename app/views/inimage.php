<?php 
if(isset($error) && isset($error["notLogged"])){ ?>
<!--SE O USUARIO NAO ESTIVER LOGADO E MANDOU UM COMENTARIO-->
<script>alert('Faca Login para comentar')</script>
<?php } ?>
<div class="container-pai">
    <div class="container-imagem-tema">
      <img class="img-image-tema" src="<?php echo URL_BASE."userData/".$image->image_path?>" alt="">

      <div class="sobre-img">
        <h1 class="titulo-img"><?php echo $image->image_title?></h1>

        <p class="descricao-img"><?php echo $image->image_description?></p>
      </div>
      <div class="gostou heart-btn">

          <div class="container-like">
            <button id="likeButton" onclick="like()" class="heartButton">
              <i id="heartIcon" class="far fa-heart"></i>
            </button>
            <span id="likeCount"><?php echo $likes?></span>
          </div>


        </div>
         
      </div>
    </div>
    <div class="usuario-que-postou">
      <div class="imagem-perfil">
       <a href="<?php echo URL_BASE."profile/?user=$image->image_authorId"?>"> <img class="imagem-perfil-img" src="<?php echo URL_BASE?>assets/images/fotodeperfiluser/lontra.jpeg" alt=""></a>
       
      </div>
      <span class="nome-do-usuario"><?php echo $image->user_name?></span>

      <?php if(!isset($itsMe) || !$itsMe) { ?>

        
        <?php if($following || $following == true) { ?>  
          <!--Se o user estiver seguindo o user do perfil que postou a foto-->
        <a href="<?php echo URL_BASE?>image/unfollow/<?php echo $image->image_authorId?>/<?php echo $image->image_id?>">
          <button class="btns005">Deixar de Seguir</button>
        </a>
      
      
          <?php }elseif(!$following || $following == false) {  ?> <!--Se o user nao estiver seguindo o user do perfil que postou a foto-->
            <a href="<?php echo URL_BASE?>image/follow/<?php echo $image->image_authorId?>/<?php echo $image->image_id?>">
              <button class="btns005">Seguir</button>
            </a>
          <?php }?>

      

      <?php } ?>
    </div>

    <div class="pai-container-comentario">
      <div class="comentarios">
        <div class="titulo-comentario">
          <h3>comentarios</h3>
        </div>
        <?php if(isset($comments)) foreach($comments as $cmt){?>
        <div class="comentario-digitado">
          <div><a href="<?php echo URL_BASE."profile/?user=$cmt->user_id"?>"><img class="imagem-do-usuario-comentario" src="<?php echo URL_BASE?>assets/images/fotodeperfiluser/perfilAyano.jpeg" alt=""></a></div>
          <div class="comentariodousuario">
            <div class="comentariodousuario1">
            <span><?php echo $cmt->comment_content?> </span>
            </div>
            <button class="button-reset font-icon"><i class="fa-regular fa-circle-xmark"></i></button>
          </div> 
        </div>
        <?php }?>
  
      </div>

      <div class="digita-comentario">
        <form action="" method="post">
          <textarea  id="campoTexto"  class="comentario-textarea" placeholder="Deixe seu comentário aqui" name="comment"></textarea>

          <input id="botao" type="submit" value="Comentar" disabled>
        </form>
      </div>
    </div>

     <!--Começo da seção de imagem com texto-->
     <div class="scimg-section-container">
      <h3>Mais Imagem relacionadas</h3>
     <div class="scimg-section">
          <?php if(isset($moreImages) && !is_bool($moreImages) || $moreImages != false) { foreach($moreImages as $img) { $id = $img->image_id;?>
            <a href="<?php echo URL_BASE."image/?id=$id"?>"><img class=" ls-is-cached lazyloaded" data-src="<?php echo URL_BASE."userData/".$img->image_path?>" alt="" loading="lazy" src="<?php echo URL_BASE."userData/".$img->image_path?>"></a>
          <?php } } ?>

     </div>
  </div>
  <!--Fim da seção de imagem com texto-->
  </div>
  
  <script defer  src="https://kit.fontawesome.com/33bc29f5e8.js" crossorigin="anonymous"></script>

  <script>
      const campoTexto = document.getElementById('campoTexto');
  const botao = document.getElementById('botao');

  campoTexto.addEventListener('input', function() {
    if (campoTexto.value.trim() !== '') {
      botao.disabled = false;
      botao.classList.add('btns004')
      botao.classList.remove('desativado')
      
    } else {
      botao.disabled = true;
      botao.classList.remove('btns004')
      botao.classList.add('desativado')
    }
  });

      let count = 0;
    const likeButton = document.getElementById("likeButton");
   
    const heartIcon = document.getElementById("heartIcon");

    function like() {
      heartIcon.classList.toggle("fas");
      heartIcon.classList.toggle("far");
    }
  </script>