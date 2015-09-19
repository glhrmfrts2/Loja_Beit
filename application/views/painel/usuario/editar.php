	<?php
	$iduser = $this->uri->segment(3);
	if ($iduser == NULL) 
	{
		set_msg('msgerror','Requisição incompleta','error');
		redirect('usuarios/gerenciar');
	}
	?>
	<p class="breadcrumb"><?php echo breadcrumb(); ?></p>
	<div class="large-12 columns">
		<?php 
			if (stats_user(TRUE) || $iduser == $this->session->userdata('user_id'))
			{
				$query =  $this->usuarios->get_by_id($iduser)->row();

				echo form_open(current_url(),array('class'=>'custom'));
				echo form_fieldset('Alterar usuarios');

				erros_validacao();
				get_msg('msgok');
				?>
				<div class="row">
				    <div class="large-5 columns">		      
				        <?php 
				        echo form_label('Nome completo');
						echo form_input(array('name'=>'nome', ), set_value('nome',$query->nome),'autofocus');
				        ?>
				    </div>
				</div>
				
				<div class="row">
				    <div class="large-5 columns">		      
				        <?php 
				        echo form_label('Email');
						echo form_input(array('name'=>'email','disabled'=>'disabled'), set_value('email',$query->email));
				        ?>
				    </div>
				</div>
				
				<div class="row">
				    <div class="large-4 columns">		      
				        <?php 
				        echo form_label('Login');
						echo form_input(array('name'=>'login','disabled'=>'disabled'), set_value('login',$query->login));
				        ?>
				    </div>
				</div>

				<div class="row">
				    <div class="large-12 columns">		      
				        <?php 
				       	echo form_checkbox(array('name'=>'ativo'),'1',($query->ativo==1)? TRUE:FALSE).' Permitir o acesso deste usuário ao sistema<br><br>';
				        ?>
				    </div>
				</div>

				<div class="row">
				    <div class="large-12 columns">		      
				        <?php 
				       	echo form_checkbox(array('name'=>'adm'),'1',($query->adm==1)?TRUE:FALSE).' Tornar essa conta de administrador<br><br>';
				        ?>
				    </div>
				</div>
				
				<?php
				echo form_hidden('id_usuario',$iduser);					
				
				echo anchor('usuarios/gerenciar','Cancelar',array('class'=>'button radius alert espaco'));

				echo form_submit(array('name'=>'cadastrar', 'class'=>'button radius'),'Salvar Dados');
				
				echo form_fieldset_close();
				echo form_close();

			}else{
				//set_msg('msgerror','Você não tem permissão para alterar esse usuário','error');
				redirect('usuarios/gerenciar');
			}
		 ?>
	</div>