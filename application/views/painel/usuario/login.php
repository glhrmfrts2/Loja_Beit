<div class="row">
<?php 
	echo '<div class="small-4 small-centered large-4 columns large-centered">';
	echo form_open('usuarios/login',array('class'=>'custom login-form'));
	echo form_fieldset('Identifique-se');
	erros_validacao();
	get_msg('logoffok');
	get_msg('errologin');		
	echo form_label('Usuário');
	echo form_input(array('name'=>'usuario'), set_value('usuario'),'autofocus');
	echo form_label('Senha');
	echo form_password(array('name'=>'senha'), set_value('senha'));
	echo form_hidden('redirect',$this->session->userdata('redir_para'));
	echo form_submit(array('name'=>'logar', 'class'=>'button radius right'),'Login');
	echo "<p>".anchor('usuarios/nova_senha','Esqueci  minha senha').'<p>';
	echo form_fieldset_close();
	echo form_close();
	echo "</div>";
 ?>
 </div>