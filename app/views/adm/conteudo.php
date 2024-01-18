<div class="content-conteudo">
            <!--Começo da seção de imagem com texto-->
            <div class="scimg-section-container">
                <h3>Conteudo Publicados</h3>
               <div class="scimg-section">
            <?php if($imagens){ foreach($imagens as $img){ $id = $img->image_id;?>
        
                <a href="<?php echo URL_BASE."image/?id=$id"?>"><img class="lazyload"  data-src="<?php echo URL_BASE."userData/".$img->image_path?>" alt="Image" loading="lazy"></a>
 
            <?php }}?>
            
            
               </div>
            </div>
            <!--Fim da seção de imagem com texto-->                 
        </div>

    </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js" integrity="sha512-q583ppKrCRc7N5O0n2nzUiJ+suUv7Et1JGels4bXOaMFQcamPk9HjdUknZuuFjBNs7tsMuadge5k9RzdmO+1GQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>