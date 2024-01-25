<?php if(isset($error)) { 
    if(isset($error)) echo "<script>alert('Usuario errado ou erro no banco!')</script>";

}?>
<div class="content-conteudo">
<form action="" method="post">
    <label for="">Conteudo</label>
    <input type="text" name="content" id=""><br>
    <br>

    <label for="">user: Nome ou ID exato : </label><br>
    <input type="text" name="user" id="" <?php if(isset($user_id)) echo "value=\"$user_id\""?>>

    <br><br>
    <input type="submit" value="Enviar Mensagem">
</form>

<br><hr>

<?php foreach($messages as $msg) { ?>
<div>
    <h2> ID : <?php echo $msg->user_id?> 
    <span>&nbsp; Nome : <?php echo $msg->user_name?></span>
    <span>&nbsp; <?php echo $msg->create_time?></span>
    </h2>
     <p> -> <?php echo $msg->content?></p>
    

    <br>
    <a href="<?php echo URL_BASE."adm/nachrichtSenden/?ilete=$msg->message_id"?>">Excluir</a>
    <br>
    <br>
</div>

<?php }?>
</div>