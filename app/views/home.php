<?php if(isset($banned)) echo "<script>alert('Voce foi banido ! segue o que voce nao pode fazer : \n salve')</script>";?>
<div class="titulo-mobile">
      <h1 class="titulo-m styleb-text-center styleb-mt-3">Tudo</h1>
    </div>
    <div class="container-mae">
      
    <div class="grid-container">
      <?php if($imagens){ foreach($imagens as $img){ $id = $img->image_id;?>
        <div class="grid-item">
            <a href="<?php echo URL_BASE."image/?id=$id"?>"><img class="lazyload"  data-src="<?php echo URL_BASE."userData/".$img->image_path?>" alt="Image" loading="lazy"></a>
  
          </div>
        <?php }}?>
        <!-- Adicione mais itens de grade conforme necessário  <img src="../../userData/user142/user142image1.jpg" alt="">-->
      </div>
    </div>
        <!-- Adicione mais itens de grade conforme necessário -->
      </div>
    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js" integrity="sha512-q583ppKrCRc7N5O0n2nzUiJ+suUv7Et1JGels4bXOaMFQcamPk9HjdUknZuuFjBNs7tsMuadge5k9RzdmO+1GQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php ?>