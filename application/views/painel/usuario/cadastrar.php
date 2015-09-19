		
<p class="breadcrumb"><?php echo breadcrumb(); ?></p>
<div class="small-12 large-12 columns">		
	<?php				
	echo form_open('usuarios/cadastrar',array('class'=>'custom'));
	echo form_fieldset('Cadastrar novo usuário');

	erros_validacao();
	get_msg('msgok');

	?>
	<div class="row">
	    <div class="large-5 columns">		      
	        <?php 
	        echo form_label('Nome completo');
			echo form_input(array('name'=>'nome'), set_value('nome'),'autofocus');
	        ?>
	    </div>
	</div>
	
	<div class="row">
	    <div class="large-5 columns">		      
	        <?php 
	        echo form_label('Email');
			echo form_input(array('name'=>'email'), set_value('email'));
	        ?>
	    </div>
	</div>
	
	<div class="row">
	    <div class="large-4 columns">		      
	        <?php 
	        echo form_label('Login');
			echo form_input(array('name'=>'login'), set_value('login'));
	        ?>
	    </div>
	</div>
	
	<div class="row">
	    <div class="large-3 columns">		      
	        <?php 
	        echo form_label('Senha');
			echo form_password(array('name'=>'senha'), set_value('senha'));
	        ?>
	    </div>
	</div>
	
	<div class="row">
	    <div class="large-3 columns">		      
	        <?php 
	        echo form_label('Repita a senha');
			echo form_password(array('name'=>'senha2'), set_value('senha2'));
	        ?>
	    </div>
	</div>
	
	<div class="row">
	    <div class="large-12 columns">		      
	        <?php 
	       	echo form_checkbox(array('name'=>'adm'),'1').' Criar conta de administrador<br><br>';
	        ?>
	    </div>
	</div>

	<?php	
	echo anchor('usuarios/gerenciar','Cancelar',array('class'=>'button radius alert espaco'));

	echo form_submit(array('name'=>'cadastrar', 'class'=>'button radius'),'Salvar Dados');
	
	echo form_fieldset_close();
	echo form_close();	
	?>
</div>