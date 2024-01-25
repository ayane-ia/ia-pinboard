<?php if(isset($error) && $error == 1){ ?>
<script>alert('Voce precisa inserir o email de forma correta!')</script>
<?php }?>
<div class="content-conteudo">
            <div class="titulo-bemvindo-div">
                <h2 class="bem-vindos">Pagina de cadastro de ADM</h2>
            </div>
            <div class="form">
                <form action="" method="post">
                    <label for="#nome">Nome : </label><br>
                    <input type="text" name="name" id="nome" required>
                    <br><br>

                    <label for="#email">email : </label><br>
                    <input type="email" name="email" id="email" required>
                    <br><br>

                    <label for="#senha">senha : </label><br> 
                    <input type="password" name="senha" id="senha" required>
                    <br><br>

                    <input type="submit" value="Cadastrar">
                </form>
            </div>
        </div>
    </div>