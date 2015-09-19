	<div class="small-9 large-9 columns row left">
		<p class="breadcrumb"><?php echo breadcrumb(); ?></p>
		<h3 class="blue-title">Adicionar Novo produto</h3>		
		<?php				
		echo form_open_multipart(current_url(),array('class'=>'custom'));
		echo form_fieldset('Editar Produto');

		erros_validacao();
		get_msg('msgok');
		get_msg('msgerror');

		?>

		<div class="row collapse prefix-radius">
	        <div class="small-2 columns">
	          <span class="prefix"><?php echo form_label('Nome'); ?></span>
	        </div>
	        <div class="small-10 columns">
	          <?php echo form_input(array('name'=>'nome'), set_value('nome',$query->nome),'autofocus');  ?>
	        </div>
	     </div>

		<div class="row collapse prefix-radius">
	        <div class="small-2 columns">
	          <span class="prefix"><?php echo form_label('Slug'); ?></span>
	        </div>
	        <div class="small-10 columns">
	          <?php echo form_input(array('name'=>'slug'), set_value('slug',$query->url_));  ?>
	        </div>
	    </div>

	    <div class="row collapse prefix-radius">
	        <div class="small-2 columns">
	          <span class="prefix"><?php echo form_label('Cod:'); ?></span>
	        </div>
	        <div class="small-10 columns">
	          <?php echo form_input(array('name'=>'cod_produto'), set_value('cod_produto',$query->cod_produto));  ?>
	        </div>
	    </div>

	    <div class="row">
	    	<div class="large-12 columns">
	    		<a href="#" class="button tiny" data-reveal-id="myModal">Inserir imagens</a>
				<?php echo anchor('midia/cadastrar','Upload de imagens','class="button tiny secondary radius"','target="_blank"'); ?>
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

		<div class="row">
		    <div class="large-12 columns">		      
		        <?php 
		        echo form_label('Descrisção');
				echo form_textarea(array('name'=>'descricao', 'id'=>'html-editor'), set_value('descricao',to_html($query->descricao)));
		        ?>
		    </div>
		</div>
		
	</div>
	
	<div class="panel small-3 large-3 columns row left top-20 ">	
		<div class="row">
			<h4>Categorias de produtos</h4>
		    <div class="large-12 columns border">		    	
			    <?php 
			    $i = 1;
			    foreach ($categorias as $data) {
			    ?>	
			       <label>
			        	<?php echo form_checkbox(array('name'=>'categoria[]','id'=>'category_'.$i,'value'=>$data->id_categoria, 'checked' => set_checkbox($data->id_categoria, $prod_categoria,'categoria'))).' '.$data->nome; ?>
			      </label>
			      <?php $i++; } ?>
		    </div>
		</div>
	</div>
	<div class="panel small-3 large-3 columns row left">
		<div class="row">
			<h4>Imagem do produto</h4>
			<div class="large-12 columns">
		      <img src="<?php echo thumb($query->imagem,280,200,FALSE,'produtos'); ?>" alt="<?php echo $query->nome; ?>">
		    </div>
	    </div>
	</div>
		<?php echo form_input(array('name'=>'id_produto','type'=>'hidden'), set_value('id_produto',$query->id_produto));  ?>

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
