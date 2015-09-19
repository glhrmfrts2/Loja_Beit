	
	<p class="breadcrumb"><?php echo breadcrumb(); ?></p>
	<div class="small-12 large-12 columns">		
	<?php				
	echo form_open_multipart('midias/cadastrar',array('class'=>'custom'));
	echo form_fieldset('Upload de mídia');

	erros_validacao();
	get_msg('msgok');
	get_msg('msgerror');

	?>
	<div class="row">
	    <div class="large-5 columns">		      
	        <?php 
	        echo form_label('Nome para exibição');
			echo form_input(array('name'=>'nome'), set_value('nome'),'autofocus');
	        ?>
	    </div>
	</div>

	<div class="row">
	    <div class="large-5 columns">		      
	        <?php 
	        echo form_label('Descrição');
			echo form_input(array('name'=>'descricao'), set_value('descricao'));
	        ?>
	    </div>
	</div>

	<div class="row">
	    <div class="large-12 columns">		      
	        <?php 
	        echo form_label('Arquivo');
			echo form_upload(array('name'=>'arquivo'), set_value('arquivo'));
	        ?>
	    </div>
	</div>
	<?php	

	echo anchor('midias/gerenciar','Cancelar',array('class'=>'button radius alert espaco'));

	echo form_submit(array('name'=>'cadastrar', 'class'=>'button radius'),'Salvar Dados');

	echo form_fieldset_close();
	echo form_close();		
	?>
	</div>
		