	<?php
	$idmidia = $this->uri->segment(3);
	if ($idmidia == NULL) 
	{
		set_msg('msgerror','Requisição incompleta','error');
		redirect('midias/gerenciar');
	}
	?>
	<p class="breadcrumb"><?php echo breadcrumb(); ?></p>
	
		<?php 
			if (stats_user())
			{	
				echo form_open(current_url(),array('class'=>'custom'));
				echo form_fieldset('Alterar usuarios');

				erros_validacao();
				get_msg('msgok');
			?>
			<div class="large-8 columns">
				<div class="row">
				    <div class="large-8 columns">		      
				        <?php 
				        echo form_label('Legenda para exibição');
						echo form_input(array('name'=>'legenda'), set_value('legenda',$query->legenda),'autofocus');
				        ?>
				    </div>
				</div>
				
				<div class="row">
				    <div class="large-8 columns">		      
				        <?php 
				        echo form_label('Descrição');
						echo form_input(array('name'=>'descricao'), set_value('descricao',$query->descricao));
				        ?>
				    </div>
				</div>
			</div>
			<div class="large-4 columns">
				<div class="row panel">
					<div class="large-12 columns">
						<h3>Imagem</h3>
						<?php echo thumb($query->arquivo, 380,180,TRUE,$pasta) ?>
					</div>
				</div>

				<div class="row panel">
					<div class="large-12 columns">
						<?php
							echo form_hidden('id_midia',$idmidia);					
							
							echo anchor('midias/gerenciar','Cancelar',array('class'=>'button radius alert espaco'));

							echo form_submit(array('name'=>'editar', 'class'=>'button radius'),'Salvar Dados');					
						?>
					</div>
				</div>				
			</div>
				<?php
				echo form_fieldset_close();
				echo form_close();
			
			}else{
				//set_msg('msgerror','Você não tem permissão para alterar esse usuário','error');
				redirect('usuarios/gerenciar');
			}
		 ?>
	