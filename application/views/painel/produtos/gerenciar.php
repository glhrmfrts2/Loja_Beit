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
				<th>Foto</th>
				<th>Nome</th>
				<th>categoria</th>				
				<th class="tex-center">Ações</th>
			</tr>
		</thead>
		<tbody>
			<?php 			
			foreach ($query as $data) 
			{
				echo "<tr>";
				printf('<td class="">%s</td>',thumb($data->imagem,180,100,TRUE,'produtos'));
				printf('<td class="">%s</td>',$data->nome);
				printf('<td class="">%s</td>',$data->categoria);
				printf('<td class="">%s</td>',
				anchor("produtos/editar/".$data->id_produto,' ',array('class'=>'table-actions table-edit','title'=>'Editar')).
				anchor("produtos/excluir/".$data->id_produto,' ',array('class'=>'table-actions table-delet deletareg','title'=>'Excluir')));
			}
			?>
		</tbody>				
	</table>
</div>