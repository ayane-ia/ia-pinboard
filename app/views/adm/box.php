<?php if(isset($error)) { 
    if(isset($error)) echo "<script>alert('Usuario errado ou erro no banco!')</script>";

}?>
<div class="content-conteudo">
<form action="" method="post">
    <label for="">Conteudo</label>
    <input type="text" name="content" id=""><br>
    <br>

    <label for="">Usuario * nome exato : </label><br>
    <input type="text" name="user" id="">

    <br><br>
    <input type="submit" value="Enviar Mensagem">
</form>

<br><hr>

<?php $i = 0; 
if(isset($messages)) foreach($messages as $msg) { ?>
<?php 
for ($j=0; $j < count($users); $j++) { 
    if($messages[$j]->user_id == $users[$j]->user_id){
        $user_name = $users[$j]->user_name;
        continue;
    }
}
?>

<div>
    <h2> ID : <?php echo $msg->user_id?> 
    <span>&nbsp; Nome : <?php echo $user_name?></span>
    <span>&nbsp; <?php echo $msg->create_time?></span>
    </h2>
     <p> -> <?php echo $msg->content?></p>
    

    <br>
    <a href="<?php echo URL_BASE."adm/nachrichtSenden/?ilete=$msg->message_id"?>">Excluir</a>
    <br>
    <br>
</div>

<?php $i++;} ?>
</div>