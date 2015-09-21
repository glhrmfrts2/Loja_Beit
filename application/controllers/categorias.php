<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categorias extends CI_Controller {

	public $view = 'categorias/';
	
	public function __construct()
	{
		parent::__construct();		
		init_painel();
		user_logout();
		$this->load->model('categoria_model','categorias');

	}

	public function index()
	{
		$this->gerenciar();
	}

	public function site()
	{
		
	}

	public function gerenciar()
	{	
		//lista os dados do banco de dados
		$query =  $this->categorias->get_all()->result();
		
		set_tema('footerinc',load_js(array('data-table','table')),FALSE);
		set_tema('titulo','Registros de Midia');
		set_tema('conteudo', load_modulo($this->view.'gerenciar',array('categorias'=>$query)));
		load_template();		
	}

	public function editar($segment=NULL)
	{	
		if ($segment != NULL) 
		{	

			$this->form_validation->set_rules('nome','Nome','trim|required');
			
			if($this->form_validation->run(TRUE))
			{	
				$dados = elements(array('nome','slug','descricao'), $this->input->post());
				($dados['slug'] != '')? $dados['slug']=slug($dados['slug']) : $dados['slug']=slug($dados['nome']);
				$this->categorias->do_update($dados,array('id_categoria'=>$segment),FALSE);								
				redirect('categorias/gerenciar');
			}

			$query = $this->categorias->get_by_id($segment)->row();
			set_tema('titulo','Editar categoria');
			set_tema('conteudo', load_modulo($this->view.'editar',array('query'=>$query)));
			load_template();

		}else{
			redirect('categorias/gerenciar');
		}	
	}

	public function excluir()
	{
		
		if (stats_user(TRUE)) 
		{
		 	$idpagina = $this->uri->segment(3);
		 	if ($idpagina != NULL) 
		 	{
		 		$query = $this->categorias->get_by_id($idpagina);
		 		if ($query->num_rows()==1) {
		 			$query = $query->row();
		 			$this->categorias->do_delete(array('id_pagina'=>$query->id_pagina),FALSE);	 			
		 		}else{
		 			set_msg('msgerror','Página não encontrada','error');
		 		}	
		 	}else{
		 		set_msg('msgerror','Escolha uma página para excluir','error');
		 	}
		}
		redirect('categorias/gerenciar');		
	}

	

	public function cadastrar()
	{	
		$categorias = '';
		$this->form_validation->set_rules('nome','Nome','trim|required');
		
		if($this->form_validation->run(TRUE))
		{	
			$dados = elements(array('nome','slug','descricao'), $this->input->post());
			($dados['slug'] != '')? $dados['slug']=slug($dados['slug']) : $dados['slug']=slug($dados['nome']);
			$this->categorias->do_insert($dados);								
		}
		
		 //lista os modelos de categorias
		$query =  $this->categorias->get_all()->result();
			
		set_tema('titulo','Cadastrar Categoria');
		set_tema('footerinc',load_js(array('data-table','table')),FALSE);
		set_tema('conteudo', load_modulo($this->view.'gerenciar',array('categorias' => $query)));
		load_template();
	}
}

/* End of file categorias.php */
/* Location: ./application/controllers/produtos.php */