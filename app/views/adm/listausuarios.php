
<div class="content-conteudo">

            <div class="tabls001-container">
                <table id="minha-tabls001" class="minha-tabls001">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Seguidores</th>
                            <th>Seguindo</th>
                            <th>Estado Atual</th>
                            <th>Confi</th>
                            </tr>
                    </thead>
                    <tbody>
                    <?php if(isset($users)) foreach($users as $usr) { ?>
 
                        <tr>
                            <td><?php echo $usr->user_id?></td>
                            <td><?php echo $usr->user_name?></td>
                            <td><?php echo $usr->user_email?></td>
                            <td><?php echo $usr->user_followers;?></td>
                            <td><?php echo $usr->user_following;?></td>
                            <td><?php if($usr->user_ban == 1) echo "Banido"; else echo "Permitido";?></td>

                            <td> 
                                <a href="<?php echo URL_BASE."adm/nachrichtSenden/$usr->user_id"?>" title="Mensagem"><button class="button-edit" ><img class="img-botao-tabela" src="<?php echo URL_BASE?>assets/images/recursos/dialogo.png" alt=""></button></a>

                                <?php if($usr->user_ban == 0 ) { ?> <a href="<?php echo URL_BASE?>adm/tomarisBan/<?php echo $usr->user_id?>" title="Banir"><button class="button-edit" ><img class="img-botao-tabela" src="<?php echo URL_BASE?>assets/images/recursos/banir01.png" alt=""></button> </a> 
                                <?php } else { ?>
                                    <a href="<?php echo URL_BASE?>adm/removeBan/<?php echo $usr->user_id?>" title="Permitir"><button class="button-edit" ><img class="img-botao-tabela" src="<?php echo URL_BASE?>assets/images/recursos/checked.png" alt=""></button> </a>
                                <?php } ?>

                                <a href="<?php echo URL_BASE?>adm/ixnel/<?php echo $usr->user_id?>" title="Excluir"><button class="button-edit" ><img class="img-botao-tabela" src="<?php echo URL_BASE?>assets/images/recursos/banir-usuario.png" alt=""></button> </a>


                            
                            
                            </td>

                        </tr>

                    <?php }?>
                        <!-- Adiciona mais linhas conforme necessário -->
                    </tbody>
                </table>
            </div>
        </div>

</div>