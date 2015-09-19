<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paginas extends CI_Controller {

	public $view = 'paginas/';
	
	public function __construct()
	{
		parent::__construct();		
		init_painel();
		user_logout();
		$this->load->model('pagina_model','paginas');

	}

	public function index()
	{
		$this->gerenciar();
	}

	public function cadastrar()
	{	

		$this->form_validation->set_rules('titulo','Titulo','trim|required|ucfirst|');
		$this->form_validation->set_rules('slug','SLUG','trim');
		$this->form_validation->set_rules('conteudo','Conteúdo','trim|required|htmlentities');
		
		if($this->form_validation->run(TRUE))
		{	

			//upload da imagem O IDEAL É CADASTRA NA TABELA MIDIAS
			$this->load->model('midia_model','midias');
			$upload = $this->midias->do_upload('arquivo','uploads');		

			$dados = elements(array('titulo','url_','conteudo','type','status','comentarios'), $this->input->post());
			($dados['url_'] != '')? $dados['url_']=$dados['url_'] : $dados['url_']=slug($dados['titulo']);
			($dados['comentarios'] != '')? $dados['comentarios']='1' : $dados['comentarios']='0';
			$dados['autor'] = $this->session->userdata('user_id');
			$dados['imagem'] = $upload['file_name'];
			
			$this->paginas->do_insert($dados);								
		}


		//lista os modelos de paginas
		$query =  $this->paginas->type_all()->result();
		
		//tranforma objetos em array para criar o select
		$modelos = array();		
		foreach ($query as $key) {
			$modelos[$key->id_type] = $key->nome;
		}

		//lista as opções de status da página
		$query =  $this->paginas->status_all()->result();

		//tranforma objetos em array para criar o select
		$status = array();		
		foreach ($query as $key) {
			$status[$key->id_status] = $key->nome;
		}

		set_tema('titulo','Nova página');
		set_tema('conteudo', load_modulo($this->view.'cadastrar',array('modelos'=>$modelos,'status'=>$status)));
		
		//carrega o editor de texto
		init_editortinymce();	
		load_template();
		
	}

	public function gerenciar()
	{	
		//lista os dados do banco de dados
		$query =  $this->paginas->get_all()->result();

		set_tema('footerinc',load_js(array('data-table','table')),FALSE);
		set_tema('titulo','Registros de Midia');
		set_tema('conteudo', load_modulo($this->view.'gerenciar',array('query'=>$query)));
		load_template();
		
	}

	public function editar($segment=NULL)
	{	
		if ($segment != NULL) 
		{			
		
			$pagina =  $this->paginas->get_by_id($segment)->row();

			//lista os modelos de paginas
			$query =  $this->paginas->type_all()->result();
			
			//tranforma objetos em array para criar o select
			$modelos = array();		
			foreach ($query as $key) {
				$modelos[$key->id_type] = $key->nome;
			}

			//lista as opções de status da página
			$query =  $this->paginas->status_all()->result();

			//tranforma objetos em array para criar o select
			$status = array();		
			foreach ($query as $key) {
				$status[$key->id_status] = $key->nome;
			}

			$this->form_validation->set_rules('titulo','Titulo','trim|required|ucfirst|');
			$this->form_validation->set_rules('slug','SLUG','trim');
			$this->form_validation->set_rules('conteudo','Conteúdo','trim|required|htmlentities');
			
			if($this->form_validation->run(TRUE))
			{				
				$dados = elements(array('titulo','slug','conteudo'), $this->input->post());
				($dados['slug'] != '')? $dados['url_']=$dados['slug'] : $dados['url_']=slug($dados['titulo']);
				unset($dados['slug']);
				$this->paginas->do_update($dados,array('id_pagina'=>$this->input->post('id_pagina')));								
			}
			
			set_tema('titulo','Editar mídia');
			set_tema('conteudo', load_modulo($this->view.'editar',array('pagina'=>$pagina,'modelos'=>$modelos,'status'=>$status)));
			
			//carrega o editor de texto
			init_editortinymce();	
			load_template();

		}else{
			redirect('paginas/gerenciar');
		}	
	}

	public function excluir()
	{
		
		if (stats_user(TRUE)) 
		{
		 	$idpagina = $this->uri->segment(3);
		 	if ($idpagina != NULL) 
		 	{
		 		$query = $this->paginas->get_by_id($idpagina);
		 		if ($query->num_rows()==1) {
		 			$query = $query->row();
		 			$this->paginas->do_delete(array('id_pagina'=>$query->id_pagina),FALSE);	 			
		 		}else{
		 			set_msg('msgerror','Página não encontrada','error');
		 		}	
		 	}else{
		 		set_msg('msgerror','Escolha uma página para excluir','error');
		 	}
		}
		redirect('paginas/gerenciar');		
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
			$this->paginas->do_insert_Categoria($dados);								
		}
		
		 //lista os modelos de paginas
		$categorias = $this->paginas->categorias_all()->result();
			
		set_tema('titulo','Cadastrar Categoria');
		set_tema('footerinc',load_js(array('data-table','table')),FALSE);
		set_tema('conteudo', load_modulo($this->view.'categorias',array('breadcrumbs'=>'Gerenciar','categorias'=>$categorias)));
		load_template();
	}
}

/* End of file paginas.php */
/* Location: ./application/controllers/paginas.php */