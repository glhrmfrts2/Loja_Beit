<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="<?php echo base_url('medias/images/sistema/icones/fav-ico.ico') ?>" rel='shortcut icon'/> 
	<link href="<?php echo base_url('medias/images/sistema/icones/fav-ico.ico') ?>" rel='icon'/>
    <title><?php if(isset($titulo)): ?> {titulo} | <?php endif; ?> {titulo_padrao}</title>
    {headerinc}  
</head>
<body>
	<?php if(user_logout(FALSE)){ ?>
		<?php echo incluir_arquivo('navegacao',''); ?>
	<?php } ?>
	<div class="painel-adm">		
		{conteudo}
	</div>

	<div class="row rodape">
		<div class="large-12 columns text-center">
			{rodape}
		</div>
	</div>
	{footerinc}
	<script>
    $(document).foundation();
  </script>
</body>
</html>