<script type="text/javascript">
	$(function(){
		$('.deletareg').click(function(){
			if(confirm("deseja realmente excluir esse registro?\nEsta operação não poderá ser desfeita!"))return true;else return false;
		});
	})
</script>
<p class="breadcrumb"><?php echo breadcrumb(); ?></p>
<div class="large-12 columns">		
	<?php 
	get_msg('msgok');
	get_msg('msgerror'); 	

	echo (isset($titulo))?$titulo:'';
	?>	
	<table class="large-12 data-table">
		<thead>
			<tr>
				<th>Usuário</th>
				<th>Data e hora</th>
				<th>Operação</th>
				<th>Observação</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			
			foreach ($data as $data) 
			{
				echo "<tr>";
				printf('<td class="">%s</td>',$data->usuario);
				printf('<td class="">%s</td>',date('d/m/Y H:i:s', strtotime($data->data_hora)));
				printf('<td class="">%s</td>','<span class="has-tip tip-top" title="'.$data->query.'">'.$data->operacao.'</span>');
				printf('<td class="">%s</td>',$data->observacao);
			}
			?>
		</tbody>				
	</table>
</div>

