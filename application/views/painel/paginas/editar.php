	<div class="small-9 large-9 columns row left">
		<p class="breadcrumb"><?php echo breadcrumb(); ?></p>
		<h3 class="blue-title">Editar pagina</h3>		
		<?php				
		echo form_open('paginas/editar',array('class'=>'custom','enctype' =>'multipart/form-data'));
		
		erros_validacao();
		get_msg('msgok');
		get_msg('msgerror');

		?>

		<div class="row collapse prefix-radius">
	        <div class="small-2 columns">
	          <span class="prefix"><?php echo form_label('Título'); ?></span>
	        </div>
	        <div class="small-10 columns">
	          <?php echo form_input(array('name'=>'titulo'), set_value('titulo',$pagina->titulo),'autofocus');  ?>
	        </div>
	     </div>

		<div class="row collapse prefix-radius">
	        <div class="small-2 columns">
	          <span class="prefix"><?php echo form_label('Slug'); ?></span>
	        </div>
	        <div class="small-10 columns">
	          <?php echo form_input(array('name'=>'slug'), set_value('slug'),$pagina->url_);  ?>
	        </div>
	    </div>

		<div class="row">
		    <div class="large-12 columns">		      
		        <?php 
		        echo form_label('Coteudo');
				echo form_textarea(array('name'=>'conteudo', 'id'=>'html-editor',), set_value('conteudo',to_html($pagina->conteudo)));
		        ?>
		    </div>
		</div>
		<div class="row">
	    	<div class="large-12 columns"><br>
	    		<a class="button tiny" onclick="tinyMCE.execCommand('mceInsertContent',false,'<hr class=red-more>');return false;" href="javascript:void(0)" >Read More</a>
	    		<a href="#" class="button tiny" data-reveal-id="myModal">Inserir imagens</a>
				<?php echo anchor('midias/cadastrar','Upload de imagens','class="button tiny secondary radius"','target="_blank"'); ?>
	    	</div>	
	    </div>
		
	</div>
	
	<div class="panel small-3 large-3 columns row left top-20 ">	
		<div class="row">
		    <div class="large-12 columns">
		      <label>Modelo
		        	<?php echo form_dropdown('type', $modelos, set_value('type')); ?>
		      </label>
		    </div>
		</div>

		<div class="row">
		    <div class="large-12 columns">
		      <label>Status
		        	<?php echo form_dropdown('status', $status, set_value('status')); ?>
		      </label>
		    </div>
		</div>

		<div class="row">
			<div class="large-12 columns">
		      <?php echo form_checkbox('comentarios', '1', TRUE); ?>
		      <label for="comentarios">Permitir comentário</label>
		    </div>
	    </div>
	</div>

	<div class="panel small-3 large-3 columns row left">
		<!-- A default button-group with small buttons inside -->
		Imagem destacada
		<div class="row">
		    <div class="large-12 columns">		      
		        <?php 
		        echo form_label('Arquivo');
				echo form_upload(array('name'=>'arquivo'), set_value('arquivo'));
		        ?>
		    </div>
		</div>
	</div>

	<div class="panel small-3 large-3 columns row left">
		<!-- A default button-group with small buttons inside -->
		<ul class="button-group small-9 large-9 columns">
		  <li class="left"><?php echo anchor('paginas/gerenciar','Cancelar',array('class'=>'red-color espaco padding-5')); ?></li>
		  <li class="right"><?php echo form_submit(array('name'=>'cadastrar', 'class'=>'postfix button small'),'Salvar Dados'); ?></li>
		</ul>
	</div>

	<?php
		//incluir modal de incluir imagem			
		echo incluir_arquivo('modalimg',''); 
		echo form_close();
	?>
