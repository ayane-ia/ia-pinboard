

<h1 class="titulo-upload">Upload de Imagem</h1>

<div class="container">
  

  <form id="upload-form" method="post" enctype="multipart/form-data">
    <div>
      <label for="image-upload">Selecione uma imagem:</label>
      <input class="btns004 style-display-block input-file" type="file" name="image_file" id="image-upload" accept="image/*">
    </div>
    <div>
        <div id="image-preview"></div>
      <label for="image-title">Título:</label>
      <input type="text" id="image-title" name="image_title">
    </div>
    <div>
      <label for="image-description">Descrição:</label>
      <textarea id="image-description" name="image_description"></textarea>
    </div>
    <div>
      <label for="image-category">Categoria:</label>
      <select id="image-category" name="image_category">
        <?php if($categorias){ 
              foreach($categorias as $ct){
          ?>
        <option value="<?php echo $ct->category_id;?>"><?php echo $ct->category_name;?></option>

        <?php }}else die("error");?>
        <option value="null" selected >Escolha</option>
      </select>
    </div>
    <div>
      <button class="btns005" type="submit">Enviar</button>
    </div>
  </form>
  
</div>

<script src="<?php echo URL_BASE."assets/"?>scripts/criar.js"></script>