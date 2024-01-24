
<?php 

//if(empty($_SESSION))session_start();

if(isset($_SESSION["error"]["unfollow"])){
  echo "<script>alert('Erro ao deixar de seguir')</script>";
  unset($_SESSION["error"]["unfollow"]);
}
  if(isset($_SESSION["error"]) && $_SESSION["error"]["exists"] == true){
  echo "<script>alert('Erro ao seguir')</script>";
  unset($_SESSION["error"]);
}

?>

<main>
    <div class="profile">
      
    <?php if(isset($profileImage)) { ?>

                        <img id="preview"   src="<?php echo URL_BASE?>userData/user<?php echo $userId?>/profile/<?php echo $profileImage?>" alt="">
                    <?php }else { ?>
                        <img id="preview"    src="<?php echo URL_BASE?>assets/images/recursos/perfilNull.jpg" alt="">

      <?php }?>
 
      <h2><?php echo $user_name?></h2>
      <p><?php echo $user_bio?></p>
      <ul>
        <li><strong>Seguidores:</strong> <?php echo $followers?></li>
        <li><strong>Seguindo:</strong> <?php echo $following?></li>
        <li><strong>Publicações:</strong> <?php echo $publications?></li>
      </ul>

        <?php if(isset($edit)) { // A variavael $edit carrega o id do usuario?>
        <!--Foi verificado que o usuario esta vendo seu perfil, então o botao e editar aparecera!-->

        <a href="<?php echo URL_BASE."user/edit"?>"><button class="btns005">Editar perfil</button></a>
          <?php if(!isset($_SESSION)) session_start(); $user_id = $_SESSION["user_id"];?>
        <a href="<?php echo URL_BASE."user/benutzerEntfernen/$user_id"?>"><button class="btns001">Excluir perfil</button></a>
        
        <?php  } elseif (isset($visiting)) { ?>

        <a href="<?php echo URL_BASE."login"?>"><button class="btns005">Login para seguir</button></a>
        
        <?php } elseif(isset($Isfollowing)) { ?>

        <a href="<?php echo URL_BASE."profile/unfollow/$user_name"?>"><button class="btns005">Deixar de seguir</button></a>
        

        <?php  } elseif(!isset($Isfollowing)){ ?>

        <a href="<?php echo URL_BASE."profile/follow/$user_name"?>"><button class="btns005">Seguir</button></a>

        <?php   }?>
    </div>
  </main>

  <!--Começo da seção de imagem com texto-->
  <div class="scimg-section-container">
    <h3>Publicações</h3>
   <div class="scimg-section">
    
    <?php if($image){ foreach($image as $img){ $id = $img->image_id; ?>
      <a href="<?php echo URL_BASE."image/?id=$id"?>"><img src="<?php echo URL_BASE."userData/".$img->image_path?>" alt="imagem"></a>
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