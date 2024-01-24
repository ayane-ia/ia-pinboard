<?php if(!isset($_SESSION)) session_start(); $user_id = $_SESSION["user_id"];?>
<header>
        <nav class="menu">
          <span>
            <div class="logo">
              <img src="<?php echo URL_BASE."assets/"?>images/logo/logo.png" alt="AI Pinboard Logo">
            </div>
          </span>
            
            <span><form class="search-form">
              <input type="text" placeholder="Pesquisar">
              <button type="submit"><img class="icon-menus" src="<?php echo URL_BASE."assets/"?>images/menu/pesquisar-arquivo.png" alt=""></button>
            </form></span>
            <ul class="menu-items">
              <li><a href="<?php echo URL_BASE?>user"><img class="icon-menus" src="<?php echo URL_BASE."assets/"?>images/menu/casa.png" alt=""><span>Inicial</span></a></li>
              <li><a href="<?php echo URL_BASE?>explorar"><img class="icon-menus" src="<?php echo URL_BASE."assets/"?>images/menu/pesquisar-arquivo.png" alt=""><span>Explorar</span></a></li>
              <li><a href="<?php echo URL_BASE."user/criar"?>"><img class="icon-menus" src="<?php echo URL_BASE."assets/"?>images/menu/adicionar.png" alt=""><span>criar</span></a></li>
              <li><a href="<?php echo URL_BASE."box"?>"><i class="fa-solid fa-message"></i></a></li>
              <li><a href="<?php echo URL_BASE."profile/?user=$user_id"?>"><i class="fa-solid fa-user icon-menus-avatar"></i></a></li>
              
              
            </ul>
          </nav>
    </header>

    <script defer  src="https://kit.fontawesome.com/33bc29f5e8.js" crossorigin="anonymous"></script>