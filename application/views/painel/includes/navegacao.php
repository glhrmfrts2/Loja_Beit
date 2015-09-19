<nav class="top-bar" data-topbar role="navigation">	
			<ul class="title-area">
			    <li class="name">
			      <h1><?php echo anchor('painel','Painel administrativo'); ?></h1>
			    </li>
			     <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
			    <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
		  	</ul>

			<section class="top-bar-section ">
				<ul class="center">				
					<li class="has-dropdown active">	
						<?php echo anchor('usuarios/gerenciar','Usuários'); ?>
						<ul class="dropdown">									
							<li><?php echo anchor('usuarios/cadastrar','Cadastrar'); ?></li>
							<li><?php echo anchor('usuarios/gerenciar','Gerenciar'); ?></li>								
						</ul>
					</li>								
					<li class="has-dropdown">	
						<?php echo anchor('midia/gerenciar','Mídias'); ?>
						<ul class="dropdown">									
							<li><?php echo anchor('midias/cadastrar','Cadastrar'); ?></li>
							<li><?php echo anchor('midias/gerenciar','Gerenciar'); ?></li>	
							<li class="divider"></li>
							<li class="has-dropdown">
						        <a href="#">Banner</a>
						        <ul class="dropdown right">
						          <li><?php echo anchor('midias/banners','Gerenciar'); ?></li>
						          <li class="active"><?php echo anchor('midias/gerenciar','Configuração'); ?></li>
						        </ul>
						    </li>						
						</ul>
					</li>
					<li class="has-dropdown">	
						<?php echo anchor('paginas/gerenciar','Páginas'); ?>
						<ul class="dropdown">									
							<li><?php echo anchor('paginas/cadastrar','Cadastrar'); ?></li>
							<li><?php echo anchor('paginas/gerenciar','Gerenciar'); ?></li>	
							<li class="divider"></li>
							<li>
								<?php echo anchor('paginas/categorias','Categorias'); ?>								
							</li>								
						</ul>
					</li>
					<li class="has-dropdown">	
						<?php echo anchor('produtos/gerenciar','Produtos'); ?>
						<ul class="dropdown">									
							<li><?php echo anchor('produtos/cadastrar','Cadastrar'); ?></li>
							<li><?php echo anchor('produtos/gerenciar','Gerenciar'); ?></li>	
							<li class="divider"></li>
							<li><?php echo anchor('categorias','Kits'); ?></li>
							<li><?php echo anchor('categorias','Categorias'); ?></li>								
						</ul>
					</li>
					<li class="has-dropdown">	
						<?php echo anchor('auditoria/gerenciar','Adiministração'); ?>
						<ul class="dropdown">									
							<li><?php echo anchor('auditoria/gerenciar','Auditoria'); ?></li>
							<li><?php echo anchor('settings/gerenciar','Configuracao'); ?></li>								
						</ul>
					</li>					
				</ul>

			   <!-- Right Nav Section -->
			    <ul class="right">
			      <li class="has-dropdown first-perfil">
			        <a href="#">olá,<?php echo $this->session->userdata('user_nome'); ?></a>
			        <div id="drop" data-dropdown-content  class="dropdown contant-perfil f-dropdown" aria-hidden="true" tabindex="-1">
			        	<!-- <a class="th [radius] perfil " href="#">
						  <img aria-hidden=true src="<?php echo base_url('medias/images/sistema/perfis/earth-th-sm.jpg') ?>">
						</a> -->
				        <ul class="perfil-option">
				          <li></li>
				          <li><?php echo anchor('usuarios/alterar_senha/'.$this->session->userdata('user_id'),'Alterar senha','class=""'); ?></li>
				          <li><?php echo anchor('usuarios/logoff/','Sair','class=""'); ?></li>
				        </ul>			        	
			        </div>			        
			      </li>
			    </ul>
			</section>			
		</nav>