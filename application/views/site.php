<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="<?php echo base_url('medias/images/favico.ico') ?>" rel='shortcut icon'/> 
	<link href="<?php echo base_url('medias/images/favico.ico') ?>" rel='icon'/>
	<link href="<?php echo base_url('medias/stylesheets/style.css') ?>" rel='stylesheet'/>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.8/slick.css" rel="stylesheet">
	<link href="http://fonts.googleapis.com/css?family=Roboto:400,500,700,300" rel="stylesheet">
	<link href="<?php echo site_url('medias/css/font-awesome.min.css'); ?>" rel="stylesheet">

    <title><?php if(isset($titulo)): ?> {titulo} | <?php endif; ?> {titulo_padrao}</title>
    
    {headerinc}

    <script>

    	$(function() {
    		$('.produtos-slider').slick({
    			slidesToShow: 4,
    			slidesToScroll: 1,
    			autoplay: true,
    			dots: false,
    			arrows: true,
    			autoplaySpeed: 4000,
    			speed: 800,
    			prevArrow: '<button type="button" class="slick-prev"><i class="fa fa-chevron-left"></i></button>',
    			nextArrow: '<button type="button" class="slick-next"><i class="fa fa-chevron-right"></i></button>'
    		});

    		$('.open-child').on('mouseover', function(e) {
    			$(this).find('.nav-child').show(0);
    		})

    		$('.open-child').on('mouseleave', function(e) {
    			$(this).find('.nav-child').hide(0);
    		})
    	});

    </script>
	
</head>
<body>
	<header>
		<div id="main-header">
			<div class="row pre-header">
				<div class="large-2 small-12 columns logo-container">
					<figure class="logo">
						<img src="<?php echo site_url('medias/images/logo_beit_yaacov.png'); ?>">
					</figure>
				</div>
				<div class="large-3 small-12 columns">
					<img src="<?php echo site_url('medias/images/beit_05.png'); ?>">
				</div>
				<div class="large-4 small-12 columns carrinho-preco">

					<?php //carrinho_widget(); ?>
					
					<div class="small-3 columns">
						<img src="<?php echo site_url('medias/images/ico_carrinho.png'); ?>">
					</div>
					<div class="small-9 columns">
						<div class="precos">
							<span>2 items a partir de <span id="preco-total">R$69,90</span></span>
						</div>
					</div>

				</div>
			</div>
			<?php echo incluir_arquivo('nav','application'); ?>
		</div>
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


	<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.8/slick.js"></script>

	
</body>
</html>