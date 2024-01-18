<?php if(!$categories) echo "Categories Not Found!";?>
<div class="container-conteudo">
     <div class="container-filho">

<?php foreach($categories as $ct) { ?>
  <a class="card-link" href="explorar/categorias/<?php echo $ct->category_name?>"> 
        <div class="card fundo-0">
           <h2><?php echo $ct->category_name?></h2>
         </div>
  </a>
<?php } ?>

     </div>
</div>

 
 