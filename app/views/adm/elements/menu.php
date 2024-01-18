<?php if(!isset($_SESSION["adm"])) header("location: ".URL_BASE);?>

<div class="container-componentes">
        <div class="menu-vestical">
            <div class="logo-do-site">
                <a href="adm.html"><img src="<?php echo URL_BASE."assets/"?>images/logo/logo.png" alt=""></a>
            </div>
            <ul class="liste-menu">

                <li class="link-menu"><a href="adm.html" title="Tela inicial adm"><img class="icon-menu" src="<?php echo URL_BASE."assets/"?>images/recursos/casa.png"  alt=""></a></li>

                <li class="link-menu"><a href="paginas/addcategoria.html" title="Adiciona categoria"><img class="icon-menu" src="<?php echo URL_BASE."assets/"?>images/recursos/botao-adicionar.png"  alt=""></a></li>

                <li class="link-menu"><a href="adm/users/<?php echo $_SESSION["adm"]->adm_id?>" title="Ver usuarios"><img class="icon-menu" src="<?php echo URL_BASE."assets/"?>images/recursos/usuarios.png"  alt=""></a></li>
                
                <li class="link-menu"><a href="paginas/conteudos.html" title="ver conteudo"><img class="icon-menu" src="<?php echo URL_BASE."assets/"?>images/recursos/imagens.png"  alt=""></a></li>
                
            </ul>
        </div>