<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="<?php echo base_url('medias/images/favico.ico') ?>" rel='shortcut icon'/> 
	<link href="<?php echo base_url('medias/images/favico.ico') ?>" rel='icon'/>
    <title><?php if(isset($titulo)): ?> {titulo} | <?php endif; ?> {titulo_padrao}</title>
    
    {headerinc}


	
</head>
<body>
	<header id="main-header">
		<div class="">
			
		</div>
		<?php echo incluir_arquivo('nav','application'); ?>
	</header>

	

	<section class="container">	

		<div class="row content">
			{conteudo}	
		</div>		
		
		<footer class="footer">		
			{rodape}
		</footer>

	</section>		
	
	{footerinc}

	
</body>
</html>