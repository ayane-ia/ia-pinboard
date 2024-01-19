

  <main>
    <section class="mensagem-container">
      <h2>Mensagens dos Administradores</h2>
      <br>
<?php if(isset($messages)) { foreach($messages as $msg){ ?>

  <?php 
for ($j=0; $j < count($adms); $j++) { 
    if($messages[$j]->adm_id == $adms[$j]->adm_id){
        $adm_name = $adms[$j]->adm_name;
        continue;
    }
}
?>
  <div class="mensagem">
        <h3> Admin  <?php echo  $adm_name?> - <?php echo $msg->create_time?></h3>
        <p><?php echo $msg->content?></p>
  </div>
<?php }}?>  

      <!-- Adicione mais mensagens aqui -->
    </section>
  </main>
 
 