<div class="content-conteudo">
            <form class="form-addcategoria" action="" method="post" enctype="multipart/form-data">
              <div class="conteudoDoForm">
                <h2 id="titulo">Adicionar categoria</h2>
                <div class="imagem-viu">

                </div>
                    <label class="label-add" for="avatar-imagem" title="Adiciona imagem para categoria"><img class="icon-formaadd" src="<?php echo URL_BASE."assets/"?>images/recursos/botao-adicionar.png" alt="add"></label>
                    <input class="input-file" type="file" name="image" id="avatar-imagem"  accept="image/*" required>
                <div>
                    <input class="input-categoria" type="text" name="name" placeholder="Nome da Categoria" required>
                    <input class="btns004" type="submit" value="Adiciona">
                <h1>Categorias Existentes:</h1>
                <ul>
                <?php if(isset($categorias)) foreach($categorias as $ct) { ?>
                    <li>
                        <a href="<?php echo URL_BASE."explorar/categorias/$ct->category_name"?>"><?php echo $ct->category_name;?></a>
                    </li>
                <?php } ?>
                </ul>
                <!--
                    <select class="select-opt" name="" id="">
                        <option value="">Teste</option>
                        <option value="">Teste</option>
                        <option value="">Teste</option>
                        <option value="">Teste</option>
                        <option value="">Teste</option>
                    </select>
                -->
                </div>
              </div>

              
            </form>
        </div>

    </div>


    


    <script>
       const avataimagem = document.querySelector('#avatar-imagem');
      const h2avatar = document.querySelector('#titulo');
        const teste = document.querySelector('.imagem-viu')
        avataimagem.addEventListener('change', event => {
            const reader = new FileReader();

    reader.onload = function(event) {
        const existingPreview = document.querySelector('#preview-image');
        if (existingPreview) {
            existingPreview.remove();
        }

        const previewImagem = document.createElement('img');
        previewImagem.width = 115;
        previewImagem.height = 100;
        previewImagem.id = 'preview-image';
        previewImagem.src = event.target.result;
        teste.appendChild(previewImagem);
    };

    reader.readAsDataURL(avataimagem.files[0]);
});
    </script>