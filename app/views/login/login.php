<?php if($error) echo "<script>alert('CREDENCIAIS ERRADAS !')</script>";?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AI Pinboard - Login</title>
  <link rel="stylesheet" href="<?php echo URL_BASE."assets/"?>src/css/menu.css">
  <link rel="stylesheet" href="<?php echo URL_BASE."assets/"?>src/css/cadastro_login.css">
</head>
<body>
  <div class="container">

    <div class="form">

        <img class="logo style-display-block styleb-m-auto styleb-mb-2 styleb-mt-2"  src="<?php echo URL_BASE."assets/"?>images/logo/logo.png" alt="">

        <h2 class="styleb-text-center">Bem-vindo(a) ao AI Pinboard</h2>
        <p class="p-form styleb-m-auto styleb-mt-2 styleb-text-center styleb-w-1-3 ">Bem vindo(a) de volta</p>
        <form action="" method="post">
           <div class="container-inputs">
            <label for="email">E-mail</label>
            <input class="input-cadastro" type="email" name="user_email" id="email" placeholder="E-mail">

            <label for="senha">Palavra-passe</label>
            <input class="input-cadastro" type="password" name="user_password" id="senha" placeholder="Palavra-passe">
           </div>

           <a class="styleb-m-auto style-display-block styleb-text-center styleb-mt-2 styleb-mb-2 styleb-w-1-1" href="">Esqueceste a palavra-passe?</a>

           <button class="styleb-m-auto btns004 style-display-block styleb-mt-2" type="submit">Iniciar sessão</button>

           <a class="styleb-m-auto style-display-block styleb-text-center styleb-mt-3 styleb-w-1-1" href="<?php echo URL_BASE."cadastro"?>">Fazer cadastro</a>
        </form>

    </div>

  </div>
</body>
</html>