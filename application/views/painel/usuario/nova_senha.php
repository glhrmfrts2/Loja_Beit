<?php 
	echo '<div class="small-5 small-centered large-5 columns large-centered">';
	echo form_open('usuarios/nova_senha',array('class'=>'custom login-form'));
	echo form_fieldset('Recuperação de Senha');
	erros_validacao();
	get_msg('msgok');
	get_msg('msgerror');		
	echo form_label('seu email');
	echo form_input(array('name'=>'email'), set_value('email'),'autofocus');		
	echo form_submit(array('name'=>'novasenha', 'class'=>'button radius right'),'Enviar nova senha');
	echo "<p>".anchor('usuarios/login','Fazer login').'<p>';
	echo form_fieldset_close();
	echo form_close();
	echo "</div>";
 ?>