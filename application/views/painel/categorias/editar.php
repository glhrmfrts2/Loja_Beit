<p class="breadcrumb"><?php echo breadcrumb(); ?></p>
<div class="large-12 columns">
	<?php				
	echo form_open(current_url(),array('class'=>'custom'));
	
	erros_validacao();
	get_msg('msgok');
	get_msg('msgerror');

	?>
	<div class="large-8 columns">
		<div class="row">
		    <div class="large-8 columns">		      
		        <?php 
		        echo form_label('Nome para exibição');
				echo form_input(array('name'=>'nome'), set_value('nome',$query->nome),'autofocus');
		        ?>
		    </div>
		</div>
		
		<div class="row">
		    <div class="large-8 columns">		      
		        <?php 
		        echo form_label('Descrição');
				echo form_input(array('name'=>'slug'), set_value('slug',$query->slug));
		        ?>
		    </div>
		</div>
		<div class="row">
	    <div class="large-8 columns">		      
	        <?php 
	        echo form_label('Descrição');
			echo form_textarea(array('name'=>'descricao'), set_value('descricao',$query->descricao));
	        ?>
	    </div>
	
		<?php
		echo form_hidden('id_categoria',$query->id_categoria);					
		
		echo anchor('categoria/gerenciar','Cancelar',array('class'=>'button radius alert espaco'));

		echo form_submit(array('name'=>'editar', 'class'=>'button radius'),'Salvar Dados');					
		?>
	</div>

	
	<?php
	echo form_fieldset_close();
	echo form_close();

		?>
	</div>