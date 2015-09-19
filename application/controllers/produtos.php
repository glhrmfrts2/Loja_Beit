<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Produtos extends CI_Controller {

	public $view = 'produtos/';
	
	public function __construct()
	{
		parent::__construct();		
		init_painel();
		user_logout();
		$this->load->model('produto_model','produtos');
	}

	public function index()
	{
		$this->gerenciar();
	}

	public function cadastrar()
	{	
		$this->form_validation->set_rules('nome','Nome','trim|required|ucfirst|');
		$this->form_validation->set_rules('categoria','Categoria','required');
		$this->form_validation->set_rules('slug','SLUG','trim');
		$this->form_validation->set_rules('descricao','Descricao','trim|htmlentities');

		if($this->form_validation->run(TRUE))
		{	
			//upload da imagem
			$this->load->model('midia_model','midias');
			$upload = $this->midias->do_upload('arquivo','produtos');

			if (is_array($upload) && $upload['file_name'] != '') 
			{	
				$dados = elements(array('nome','url_','descricao','categoria','cod_produto'), $this->input->post());
				($dados['url_'] != '')? $dados['url_']=$dados['url_'] : $dados['url_']=slug($dados['nome']);
				
				
				$dados['imagem'] = $upload['file_name'];

				$this->produtos->do_insert($dados);	
				
			}else{
				set_msg('msgerror',$upload,'error');
				redirect(current_url());
			}							
		}

		//pega as categorias do banco
		$this->load->model('categoria_model','categorias');
		$all_categorias = $this->categorias->get_all()->result();

		//ARRUMA ISSSO AQUI COLOCA TUDO DENTRO DO MODEL PARA TRAZER REDONDO
		$i = 0;
		foreach ($all_categorias as $value) {
			
			if($value->cod_categoria == 0)
			{	
				//monta uma array de categorias
				$categorias[$value->id_categoria] = array(
					'id' => $value->id_categoria,
					'url' => $value->cat_slug,
					'nome' => $value->cat_nome,
					'cad_imagem' => $value->cat_imagem,				
					'descricao' => $value->cat_descricao
				);
				//monta o dropdown de seleção de categorias
				$cat_dropdown[$value->id_categoria] = $value->cat_nome;
			}
			//inclui as subcategorias
			if($value->cod_categoria != 0)
			{	
				$i++;			
				$categorias[$value->cod_categoria]['subcategoria'][$i] = array(
					'nome' => $value->sub_categoria,
					'imagem' => $value->sub_image
				);				
			}
						
		}

		$tipo = $this->produtos->get_all_product_type()->result_array();
		
		
		/*header("Content-Type: text/html; charset=ISO-8859-1");*/
		$cat_json = json_encode($categorias);

		set_tema('titulo','Novo produto');
		set_tema('conteudo', 
			load_modulo($this->view.'cadastrar',
				array(
					'tipo' => $tipo,
					'cat_dropdown'=>$cat_dropdown,
					'cat_json' => $cat_json
				)
			)
		);
		
		//carrega o editor de texto
		init_editortinymce();	
		load_template();		
	}

	public function gerenciar()
	{	
		//lista os dados do banco de dados
		$query =  $this->produtos->get_all()->result();

		set_tema('footerinc',load_js(array('data-table','table')),FALSE);
		set_tema('titulo','Gerenciar Produtos');
		set_tema('conteudo', load_modulo($this->view.'gerenciar',array('query'=>$query)));
		load_template();		
	}

	public function editar($segment=NULL)
	{	
		if ($segment != NULL) 
		{					
			//categorias
			$categorias = $this->load->model('categoria_model','categorias');
			$produto =  $this->produtos->get_by_id($segment)->row();			
			$categorias = $this->categorias->get_all()->result();
			$prod_cat = $this->categorias->get_by_id($segment)->result_array();

			$this->form_validation->set_rules('nome','Nome','trim|required|ucfirst|');
			$this->form_validation->set_rules('categoria','Categoria','required');
			$this->form_validation->set_rules('slug','SLUG','trim');
			$this->form_validation->set_rules('descricao','Descricao','trim|htmlentities');
			
			
			if($this->form_validation->run(TRUE))
			{				
				$dados = elements(array('nome','url_','descricao','cod_produto'), $this->input->post());
				($dados['url_'] != '')? $dados['url_']=$dados['url_'] : $dados['url_']=slug($dados['nome']);
				
				//upload da imagem
				$this->load->model('midia_model','midias');
				$upload = $this->midias->do_upload('arquivo','produtos');

				if (is_array($upload) && $upload['file_name'] != '')
				{				
					$dados['imagem'] = $upload['file_name'];
				}

				$this->produtos->do_update($dados,array('id_produto'=>$this->input->post('id_produto')),$this->input->post('categoria'));
			}			
			

			set_tema('titulo','Editar produto');
			set_tema('conteudo', load_modulo($this->view.'editar',array('query'=>$produto,'categorias'=>$categorias,'prod_categoria'=>$prod_cat)));
			
			//carrega o editor de texto
			init_editortinymce();	
			load_template();
		}else{
			redirect('produtos/gerenciar');
		}
	}

	public function excluir()
	{
		
		if (stats_user(TRUE)) 
		{
		 	$idpagina = $this->uri->segment(3);
		 	if ($idpagina != NULL) 
		 	{
		 		$query = $this->produtos->get_by_id($idpagina);
		 		if ($query->num_rows()==1) {
		 			$query = $query->row();
		 			$this->produtos->do_delete(array('id_pagina'=>$query->id_pagina),FALSE);	 			
		 		}else{
		 			set_msg('msgerror','Página não encontrada','error');
		 		}	
		 	}else{
		 		set_msg('msgerror','Escolha uma página para excluir','error');
		 	}
		}
		redirect('produtos/gerenciar');		
	}

	public function categorias($segment=NULL)
	{
		switch ($segment) {

				case 'cadastrar':
					$this->cadastrarCategoria();
				break;

				case 'gerenciar':
					echo 'gerenciar';	
				break;

				case 'excluir':
					echo 'excluir';	
				break;

				default:
					$this->cadastrarCategoria();
				break;
			}	
	}

	public function cadastrarCategoria()
	{	
		$categorias = '';
		$this->form_validation->set_rules('nome','Nome','trim|required');
		
		if($this->form_validation->run(TRUE))
		{	
			$dados = elements(array('nome','slug','descricao','cod_hierarquia'), $this->input->post());
			($dados['slug'] != '')? $dados['slug']=slug($dados['slug']) : $dados['slug']=slug($dados['nome']);
			$this->produtos->do_insert_Categoria($dados);								
		}
		
		 //lista os modelos de produtos
		$categorias = $this->produtos->categorias_all()->result();
			
		set_tema('titulo','Cadastrar Categoria');
		set_tema('footerinc',load_js(array('data-table','table')),FALSE);
		set_tema('conteudo', load_modulo($this->view.'categorias',array('breadcrumbs'=>'Gerenciar','categorias'=>$categorias)));
		load_template();
	}
}

/* End of file produtos.php */
/* Location: ./application/controllers/produtos.php */