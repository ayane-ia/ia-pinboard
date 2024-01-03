 <?php if($error){echo "<script>alert('O MESMO EMAIL JA ESTA CADASTRADO!')</script>";}?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AI Pinboard - Cadastro</title>
  <link rel="stylesheet" href="<?php echo URL_BASE."assets/"?>src/css/menu.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.css">
  <link rel="stylesheet" href="<?php echo URL_BASE."assets/"?>src/css/cadastro_login.css">
</head>
<body>


  <div class="container">

    <div class="form">

        <img class="logo style-display-block styleb-m-auto styleb-mb-2 styleb-mt-2"  src="<?php echo URL_BASE."assets/"?>images/logo/logo.png" alt="">

        <h2 class="styleb-text-center">Bem-vindo(a) ao AI Pinboard</h2>
        <p class="p-form styleb-m-auto styleb-mt-2 styleb-text-center styleb-w-1-3 ">Encontra novas ideias para experimentares</p>

        <form action="" method="post" enctype="multipart/form-data">
           <div class="container-inputs">
            <label for="email">Nome</label>
            <input class="input-cadastro" type="text" name="user_name" id="email" placeholder="Seu nome" required>

            <label for="email">E-mail</label>
            <input class="input-cadastro" type="email" name="user_email" id="email" placeholder="E-mail" required>

            <label for="senha">Palavra-passe</label>
            <input class="input-cadastro" type="password" name="user_password" id="senha" placeholder="crie uma Palavra-passe" required>

            <label for="dataNascimento">Data de nascimento</label>
            <input class="input-cadastro" type="date" name="user_age" id="dataNascimento" required>
            
           </div>

           <button class="styleb-m-auto btns004 style-display-block styleb-mt-2 btn-upload-imagem" type="submit">Continuar</button>

           <a class="styleb-m-auto style-display-block styleb-text-center styleb-mt-3 styleb-w-1-1" href="login.html">Fazer login</a>
        </form>

    </div>

  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>

  <script src="<?php echo URL_BASE."assets/"?>scripts/upload-imagePerfil.js"></script>
</body>
</html>