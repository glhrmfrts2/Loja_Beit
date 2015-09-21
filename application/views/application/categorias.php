<div class="large-12 columns lista-cat">
	<div class="full-width main-block">

		<div class="mb-body no-padding">

			<div class="row">

				<div class="small-12 large-3 columns menu-aux">

					<a href="#">
						<img src="<?php echo site_url('medias/images/menu_aux_livros.png'); ?>">
					</a>

					<ul class="nav-child no-style no-margin small">
						<li class="item-145"><a href="/loja_beit/index.php/livros/k4-ao-g1">K4 ao G1</a></li>
						<li class="item-146"><a href="/loja_beit/index.php/livros/g2-ao-g5">G2 ao G5</a></li>
						<li class="item-147"><a href="/loja_beit/index.php/livros/g6-ao-g9">G6 ao G9</a></li>
						<li class="item-148"><a href="/loja_beit/index.php/livros/1-em">1º Ensino Médio</a></li>
						<li class="item-149"><a href="/loja_beit/index.php/livros/2-em">2º Ensino Médio</a></li>
						<li class="item-150"><a href="/loja_beit/index.php/livros/3-em">3º Ensino Médio</a></li>
						<li class="item-151"><a href="/loja_beit/index.php/livros/4-em">4º Ensino Médio</a></li>
					</ul>

				</div>

				<div class="large-9 small-12 columns cat-produtos">

					<div class="p-list">
						<?php for ($i = 0; $i <= 7; $i++): ?>

						<div class="large-3 small-12 columns produto produto-destaque">
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
								Adicionar ao carrinho
							</a>
						</div>

						<?php endfor; ?>
					</div>

					<div class="paginate large-centered">

						<div>
							<label>
								Exibir
							</label>
							<select name="limit">
								<option value="8">8</option>
								<option value="16">16</option>
								<option value="32">32</option>
								<option value="48">48</option>
							</select>
						
						</div>

						<div class="numbers">
							<ul class="pagination">
							  <li class="arrow unavailable"><a href="">&laquo;</a></li>
							  <li class="current"><a href="">1</a></li>
							  <li><a href="">2</a></li>
							  <li><a href="">3</a></li>
							  <li><a href="">4</a></li>
							  <li class="unavailable"><a href="">&hellip;</a></li>
							  <li><a href="">12</a></li>
							  <li><a href="">13</a></li>
							  <li class="arrow"><a href="">&raquo;</a></li>
							</ul>
						</div>

					</div>

				</div>


			</div>

		</div>


	</div>
</div>


