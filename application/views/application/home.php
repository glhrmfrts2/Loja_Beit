<div class="large-12 columns lista-cat">
	<div class="full-width main-block">

		<div id="uniformes-destaques">

			<div class="mb-header bg-purple">
				<h4 class="">
					Uniformes/Destaques
				</h4>
			</div>

			<div class="mb-body">
				<div class="full-width produtos-slider">

					<?php for ($i = 0; $i <= 8; $i++): ?>

					<div class="produto produto-destaque">
						<a href="#">
							<figure class="zoom">
								<img class="produto-thumb" src="<?php echo site_url('medias/images/uniformes/saia_shorts_moleton.jpg'); ?>">
							</figure>
						</a>
						<a href="#">
							<span class="block">
								A partir de <span class="preco">R$29,90</span>
							</span>
							<h5 class="c-purple">
								Saia e Shorts Moletom
							</h5>
						</a>
						<a href="#" class="button">
							Escolher Opções
						</a>
					</div>

					<?php endfor; ?>

				</div>
			</div>
		</div>

		<div id="livros-destaques">
			<div class="mb-header bg-orange">
				<h4 class="">
					Livros/Destaques
				</h4>
			</div>

			<div class="mb-body">
				<div class="full-width produtos-slider">

					<?php for ($i = 0; $i <= 8; $i++): ?>

					<div class="produto produto-destaque">
						<a href="#">
							<figure class="zoom">
								<img class="produto-thumb" src="<?php echo site_url('medias/images/livros/livro1.jpg'); ?>">
							</figure>
						</a>
						<a href="#">
							<span class="block preco">
								R$29,90
							</span>
							<h5 class="c-purple">
								G9 - The Outsider
							</h5>
						</a>
						<span>
							1 item em estoque
						</span>
						<a href="#" class="button">
							Escolher Opções
						</a>
					</div>

					<?php endfor; ?>

				</div>
			</div>
		</div>


	</div>
</div>


