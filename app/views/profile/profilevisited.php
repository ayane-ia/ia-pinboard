<?php if(!$_SESSION){session_start();} print_r($_SESION);?>
<main>
    <div class="profile">
      <img src="<?php echo URL_BASE?>assets/images/logo/logo.png" alt="Foto de Perfil">
      <h2><?php echo $user_name?></h2>
      <p><?php echo $user_bio?></p>
      <ul>
        <li><strong>Seguidores:</strong> <?php echo $user_followers?></li>
        <li><strong>Seguindo:</strong> <?php echo $user_following?></li>
        <li><strong>Publicações:</strong> <?php echo $user_publications?></li>
      </ul>
      <?php if(isset($edit)) { // A variavael $edit carrega o id do usuario?>
        <!--Foi verificado que o usuario esta vendo seu perfil, então o botao e editar aparecera!-->
        <a href="<?php echo URL_BASE."user/edit"?>"><button class="btns005">Editar perfil</button></a>
      <?php }else { ?>
        <a href="<?php echo URL_BASE."profile/follow/$user_name"?>"><button class="btns005">Seguir</button></a>
      <?php   }?>

    </div>
  </main>

  <!--Começo da seção de imagem com texto-->
  <div class="scimg-section-container">
    <h3>Publicações</h3>
   <div class="scimg-section">
    
    <?php if($image){ foreach($image as $img){?>
          <a href="#"><img src="<?php echo URL_BASE."userData/".$img->image_path?>" alt="imagem"></a>
    <?php }}?>
      <?php if(!$image) { ?>
       <p style="color: white;">Não há publicações por aqui ;-;</p>
      <?php }?>
   </div>
  </div>
<!--Fim da seção de imagem com texto-->    
  <footer>
    <p>&copy; 2022 AI Pinboard. Todos os direitos reservados.</p>
  </footer>