<div class="content-conteudo">
            <div class="tabls001-container">
                <table id="minha-tabls001" class="minha-tabls001">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Seguidores</th>
                            <th>Seguindo</th>
                            <th>Confi</th>
                            </tr>
                    </thead>
                    <tbody>
                    <?php if(isset($users)) foreach($users as $usr) { ?>
 
                        <tr>
                            <td><?php echo $usr->user_name?></td>
                            <td><?php echo $usr->user_email?></td>
                            <td><?php echo $usr->user_followers;?></td>
                            <td><?php echo $usr->user_following;?></td>
                            
                            <td> 
                                <a href="" title="Mensagem"><button class="button-edit" ><img class="img-botao-tabela" src="<?php echo URL_BASE?>assets/images/recursos/dialogo.png" alt=""></button></a>

                                <a href="" title="banir"><button class="button-edit" ><img class="img-botao-tabela" src="<?php echo URL_BASE?>assets/images/recursos/banir-usuario.png" alt=""></button> </a>
                            </td>

                        </tr>

                    <?php }?>
                        <!-- Adiciona mais linhas conforme necessário -->
                    </tbody>
                </table>
            </div>
        </div>

</div>