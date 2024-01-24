<?php if(isset($error)){
  switch ($error) {
    case 'notSend':
      # code...
      echo "<script>alert('1ERRO AO ENVIAR!')</script>";
    break;
  
    case 'notDir':
        # code...
        echo "<script>alert('2ERRO AO ENVIAR!')</script>";
    break;
  
    case 'fatalError':
      # code...
      echo "<script>alert('3ERRO AO ENVIAR!')</script>";
    break;
  
    case 'mime':
      # extensao invalida
      echo "<script>alert('EXTENSAO DA IMAGEM ERRADA !')</script>";
    break;
  
    case 'size':
      # arquivo muito grande
      echo "<script>alert('A IMAGEM EH MUITO GRANDE!')</script>";
    break;
  }
}?>
<div class="container">
    <h1 class="titulo-upload">Upload de Imagem</h1>

    <form id="upload-form" method="post" enctype="multipart/form-data">
      <div>
        <label for="image-upload" class="label-upload-de-image label-pinboard">Adiciona imagem<img class="image-adiciona" src="<?php echo URL_BASE."assets/"?>images/menu/adicionar.png" alt=""></label>
        <input class="input-file" name="image_file" type="file" id="image-upload" accept="image/*" required>
      </div>
      <div>
          <div id="image-preview"></div>
        <label for="image-title" class="label-pinboard">Título:</label>
        <input class="border-inputs" name="image_title" type="text" id="image-title" required>
      </div>
      <div>
        <label for="image-description" class="label-pinboard">Descrição:</label>
        <textarea class="border-inputs" name="image_description" id="image-description" required></textarea>
      </div>
      <div>
        <label for="image-category" class="label-pinboard">Categoria:</label>
        <select class="select-pinboard" name="image_category" id="image-category">
        <?php if($categorias){ 
              foreach($categorias as $ct){
          ?>
        <option value="<?php echo $ct->category_id;?>"><?php echo $ct->category_name;?></option>

        <?php }}?>
        <option value="default" selected >Escolha</option>
        </select>
      </div>
      <div>
        <button class="btns005" type="submit">Enviar</button>
        <a class="btns005" href="https://poe.com/AI_Pinboard" target="_blank">Criar imagem com IA</a>
      </div>
    </form>
    
  </div>

  <script src="<?php echo URL_BASE."assets/"?>scripts/criar.js"></script>