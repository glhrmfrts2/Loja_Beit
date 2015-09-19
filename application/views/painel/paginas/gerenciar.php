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
				<th>Título</th>
				<th>Link</th>
				<th>Resumo</th>						
				<th class="tex-center">Ações</th>
			</tr>
		</thead>
		<tbody>
			<?php 			
			foreach ($query as $data) 
			{
				echo "<tr>";
				printf('<td class="">%s</td>',$data->titulo);
				printf('<td class="">%s</td>',$data->url_);
				printf('<td>%s</td>',resumo($data->conteudo,10));
				printf('<td class="">%s</td>',
				anchor("paginas/editar/".$data->id_page,' ',array('class'=>'table-actions table-edit','title'=>'Editar')).
				anchor("paginas/excluir/".$data->id_page,' ',array('class'=>'table-actions table-delet deletareg','title'=>'Excluir')));
			}
			?>
		</tbody>				
	</table>
</div>