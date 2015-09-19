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
	<div class="large-12 columns">		
		<?php 
		get_msg('msgok');
		get_msg('msgerror'); 			
		?>	
		<table class="large-12 data-table">
			<thead>
				<tr>
					<th>Miniatura</th>
					<th>Nome</th>
					<th>Link</th>						
					<th class="tex-center">Ações</th>
				</tr>
			</thead>
			<tbody>
				<?php 				
				foreach ($query as $data) 
				{
					($data->tipo==1)?$pasta='banners':$pasta='uploads';
					echo "<tr>";
					printf('<td class="">%s</td>',thumb($data->arquivo,280,150,TRUE,$pasta));
					printf('<td class="">%s</td>',$data->legenda);
					printf('<td><input class="link" type="text" value="%s"/></td>',base_url("medias/images/uploads/".$data->arquivo));
					printf('<td class="">%s</td>',
					anchor("medias/images/uploads/".$data->arquivo,' ',array('class'=>'table-actions table-view','title'=>'Visualizar','target'=>'_blank')).
					anchor("midias/editar/".$data->id_midia,' ',array('class'=>'table-actions table-edit','title'=>'Editar')).
					anchor("midias/excluir/".$data->id_midia,' ',array('class'=>'table-actions table-delet deletareg','title'=>'Excluir')));
				}
				?>
			</tbody>				
		</table>
	</div>