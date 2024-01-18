<?php if(!isset($_SESSION["adm"])) header("location: ".URL_BASE);?>

<div class="container-componentes">
        <div class="menu-vestical">
            <div class="logo-do-site">
                <a href="adm.html"><img src="<?php echo URL_BASE."assets/"?>images/logo/logo.png" alt=""></a>
            </div>
            <ul class="liste-menu">

                <li class="link-menu"><a href="<?php echo URL_BASE?>adm" title="Tela inicial adm"><img class="icon-menu" src="<?php echo URL_BASE."assets/"?>images/recursos/casa.png"  alt=""></a></li>

                <li class="link-menu"><a href="<?php echo URL_BASE?>adm/categorias/<?php echo $_SESSION["adm"]->adm_id?>" title="Adiciona categoria"><img class="icon-menu" src="<?php echo URL_BASE."assets/"?>images/recursos/botao-adicionar.png"  alt=""></a></li>

                <li class="link-menu"><a href="<?php echo URL_BASE?>adm/users/<?php echo $_SESSION["adm"]->adm_id?>" title="Ver usuarios"><img class="icon-menu" src="<?php echo URL_BASE."assets/"?>images/recursos/usuarios.png"  alt=""></a></li>
                
                <li class="link-menu"><a href="<?php echo URL_BASE?>adm/conteudo/<?php echo $_SESSION["adm"]->adm_id?>" title="ver conteudo"><img class="icon-menu" src="<?php echo URL_BASE."assets/"?>images/recursos/imagens.png"  alt=""></a></li>
                
            </ul>
        </div>