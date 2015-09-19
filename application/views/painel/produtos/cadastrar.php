	<div class="small-9 large-9 columns row left">
		<p class="breadcrumb"><?php echo breadcrumb(); ?></p>
		<h3 class="blue-title">Adicionar Novo produto</h3>		
		<?php				
		echo form_open_multipart('produtos/cadastrar',array('class'=>'custom'));
		echo form_fieldset('Upload de mídia');

		erros_validacao();
		get_msg('msgok');
		get_msg('msgerror');

		?>

		<div class="row collapse prefix-radius">
	        <div class="small-2 columns">
	          <span class="prefix"><?php echo form_label('Nome'); ?></span>
	        </div>
	        <div class="small-10 columns">
	          <?php echo form_input(array('name'=>'nome'), set_value('nome'),'autofocus');  ?>
	        </div>
	     </div>

		<div class="row collapse prefix-radius">
	        <div class="small-2 columns">
	          <span class="prefix"><?php echo form_label('Slug'); ?></span>
	        </div>
	        <div class="small-10 columns">
	          <?php echo form_input(array('name'=>'slug'), set_value('slug'));  ?>
	        </div>
	    </div>

	    <div class="row collapse prefix-radius">
	        <div class="small-2 columns">
	          <span class="prefix"><?php echo form_label('Cod:'); ?></span>
	        </div>
	        <div class="small-10 columns">
	          <?php echo form_input(array('name'=>'cod_produto'), set_value('cod_produto'));  ?>
	        </div>
	    </div> 

		<div class="row">
		    <div class="large-12 columns">		      
		        <?php 
		        echo form_label('Descrisção');
				echo form_textarea(array('name'=>'descricao', 'id'=>'html-editor',), set_value('descricao'));
		        ?>
		    </div>
		</div>
	</div>

	<div class="panel small-3 large-3 columns row" style="margin-top:138px;">	
		<div class="row">
			<label>Tipo de produto</label>
				<select name="prod_type">
					<option value="">Selecionar</option>
					<?php foreach ($tipo as $value) { ?>
					<option value="<?php echo $value['id_prod_type'] ?>"><?php echo $value['nome'] ?></option>
					<?php } ?>
				</select>
			</label>
		</div>
		<div class="row">
			<label>Marca
				<select name="prod_type" onChange="combo_subcategorias(this.value)">
					<option value="">Selecionar</option>
					<?php foreach ($cat_dropdown as $k => $value) { ?>
					<option value="<?php echo $k ?>"><?php echo $value ?></option>
					<?php } ?>
				</select>
			</label>
			<div class="large-12 columns" id="subcategorias">
		    </div>
		</div>		
	</div>
	<div class="panel small-3 large-3 columns row left">
		<div class="row">
	    	<div class="large-12 columns">
	    		<a href="#" class="button tiny" data-reveal-id="myModal">Inserir Imagem Principal</a>
				<?php echo anchor('midias/cadastrar','Upload de imagens','class="button tiny secondary radius right" target="_blank"'); ?>
	    	</div>
	    	<div class="large-12 columns">
	    		<a href="#" class="button tiny" data-reveal-id="myModal">Inserir Galeria</a>
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
		echo incluir_arquivo('script',''); 
		echo form_close();
	?>
