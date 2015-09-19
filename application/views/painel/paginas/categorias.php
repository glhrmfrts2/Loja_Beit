	<div class="small-5 large-5 columns row left">
		<p class="breadcrumb"><?php echo breadcrumb($breadcrumbs); ?></p>
		<h3 class="blue-title">Adicionar nova categoria</h3>		
		<?php				
		echo form_open('paginas/categorias/cadastrar',array('class'=>'custom'));
		
		erros_validacao();
		get_msg('msgok');
		get_msg('msgerror');

		?>
		<div class="small-12 large-12 columns">
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
		          <span class="prefix has-tip tip-top" title="Slug é uma url amigável, geramente se usa com lestras minúscula e traço"><?php echo form_label('Slug'); ?></span>
		        </div>
		        <div class="small-10 columns">
		          <?php echo form_input(array('name'=>'slug'), set_value('slug'));  ?>
		        </div>
		     </div>

		     <div class="row">
			    <div class="large-12 columns">		      
			        <?php 
			        echo form_label('Descrição');
					echo form_textarea(array('name'=>'descricao', 'id'=>'html-editor','style'=>'max-width:100%;min-width:100%;'), set_value('descricao'));
			        ?>
			    </div>
			</div>
			<div class="row">
			    <div class="large-4 columns">
			      <label>Pai
				      <select name="cod_hierarquia">
				      	<option value="0">Nenhuma</option>
				      	<?php if (isset($categorias)){?>
					      	<?php foreach ($categorias as $data) { ?>
					      		<option value="<?php echo $data->id_pg_categoria; ?>"><?php echo $data->nome ?></option>
					      	<?php } ?>				      	
				      	<?php } ?>
				      </select>					      							      		
			      </label>
			    </div>
			</div>

			<div class="row left">
				<div class="large-12 columns">
					<!-- A default button-group with small buttons inside -->
					<?php echo form_submit(array('name'=>'cadastrar', 'class'=>'postfix button small'),'Adicionar nova categoria'); ?>

				</div>
			</div>
	     </div> 
	</div>
	<div class="large-7 columns" style="margin-top:91px;">
			<table class="large-12 columns data-table">
				<thead>
					<tr>
						<th>Nome</th>
						<th>Descricao</th>
						<th>Slug</th>
					</tr>
				</thead>
				<tbody>
					<?php 			
					foreach ($categorias as $data) 
					{
						echo "<tr>";
						printf('<td class="td-title-main">%s</td>','<strong><a href="">'.$data->nome.'</a></strong>'.							
							'<span class="ation-table">'.
								anchor("paginas/categorias/editar/".$data->id_pg_categoria,'Editar',array('title'=>'Editar')).
								anchor("paginas/categorias/excluir/".$data->id_pg_categoria,'Excluir',array('title'=>'Excluir')).
							'</span>'
						);
						printf('<td class="">%s</td>',$data->descricao);
						printf('<td>%s</td>',$data->slug);
						echo "</tr>";
					}
					?>
				</tbody>				
			</table>
		</div>
	<?php echo form_close(); ?>
