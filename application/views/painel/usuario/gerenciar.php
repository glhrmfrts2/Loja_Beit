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
	?>		
	<table class="large-12 data-table">
		<thead>
			<tr>
				<th>Nome</th>
				<th>Login</th>
				<th>Email</th>
				<th>Ativo / Admin</th>
				<th>Ações</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			
			foreach ($data as $data) 
			{
				echo "<tr>";
				printf('<td class="">%s</td>',$data->nome);
				printf('<td class="">%s</td>',$data->login);
				printf('<td class="">%s</td>',$data->email);
				printf('<td class="">%s / %s</td>',($data->ativo==0)?'Não':'Sim',($data->adm==0)?'Não':'Sim');
				printf('<td class="large-centered">%s</td>',
				anchor("usuarios/editar/".$data->id_usuario,' ',array('class'=>'table-actions table-edit','title'=>'Editar')).
				anchor("usuarios/alterar_senha/".$data->id_usuario,' ',array('class'=>'table-actions table-pass','title'=>'Alterar Senha')).
				anchor("usuarios/excluir/".$data->id_usuario,' ',array('class'=>'table-actions table-delet deletareg','title'=>'Excluir')));						
				echo "</tr>";
			}
			?>
			</tbody>			
	</table>
</div>