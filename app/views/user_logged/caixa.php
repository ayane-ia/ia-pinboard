

  <main>
    <section class="mensagem-container">
      <h2>Mensagens dos Administradores</h2>
      <br>

<?php foreach($messages as $msg) { ?>
  <div class="mensagem">
        <h3> Admin  <?php echo $msg->adm_name?> - <?php echo $msg->create_time?></h3>
        <p><?php echo $msg->content?></p>
  </div>
<?php }?>
      <!-- Adicione mais mensagens aqui -->
    </section>
  </main>
 
 