	<script type="text/javascript">
		$(function(){
			$('.deletareg').click(function(){
				if(confirm("deseja realmente excluir esse registro?\nEsta operação não poderá ser desfeita!"))return true;else return false;
			});
			$('.link').on('click', function(){
				$(this).select();
			});
		})
	</script>
	<p class="breadcrumb"><?php echo breadcrumb(); ?></p>
	<div class="large-6 columns">
		<?php				
		echo form_open_multipart('midias/banners',array('class'=>'custom'));
		echo form_fieldset('Upload de mídia');

		erros_validacao();
		get_msg('msgok');
		get_msg('msgerror');

		?>
		<div class="row">
		    <div class="large-12 columns">		      
		        <?php 
		        echo form_label('Legenda');
				echo form_input(array('name'=>'legenda'), set_value('legenda'),'autofocus');
		        ?>
		    </div>
		</div>

		<div class="row">
		    <div class="large-12 columns">		      
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
		echo form_input(array('name'=>'tipo', 'type'=>'hidden', 'value'=>'1'));
		echo anchor('midias/gerenciar','Cancelar',array('class'=>'button radius alert espaco'));

		echo form_submit(array('name'=>'cadastrar', 'class'=>'button radius'),'Salvar Dados');

		echo form_fieldset_close();
		echo form_close();		
		?>
	</div>
	<div class="large-6 columns " style="margin-top:30px;">		
		<table class="large-12 data-table">
			<thead>
				<tr>
					<th>Miniatura</th>
					<th>Legenda</th>
					<!-- <th>Descrição</th>	 -->					
					<th class="tex-center">Ações</th>
				</tr>
			</thead>
			<tbody>
				<?php 				
				foreach ($banners as $data) 
				{
					echo "<tr>";
					printf('<td class="">%s</td>',thumb($data->arquivo,180,100,TRUE,'banners'));
					printf('<td class="">%s</td>',$data->legenda);
					/*printf('<td></td>',$data->descricao);*/
					printf('<td class="">%s</td>',
					anchor("medias/images/banners/".$data->arquivo,' ',array('class'=>'table-actions table-view','title'=>'Visualizar','target'=>'_blank')).
					anchor("midias/editar/".$data->id_midia,' ',array('class'=>'table-actions table-edit','title'=>'Editar')).
					anchor("midias/banners/excluir/".$data->id_midia,' ',array('class'=>'table-actions table-delet deletareg','title'=>'Excluir')));
				}
				?>
			</tbody>				
		</table>
	</div>
