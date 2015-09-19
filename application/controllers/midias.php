<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Midias extends CI_Controller {

	public $view = 'midias/';
	public function __construct()
	{
		parent::__construct();		
		init_painel();
		user_logout();
		$this->load->model('midia_model','midias');
	}

	public function index()
	{
		$this->gerenciar();
	}

	public function cadastrar()
	{	
		$this->form_validation->set_rules('legenda','Nome','trim|required|ucfirst|');
		$this->form_validation->set_rules('descricao','Descrição','trim');
		
		if($this->form_validation->run(TRUE))
		{	
			//upload da imagem
			$upload = $this->midias->do_upload('arquivo');

			if (is_array($upload) && $upload['file_name'] != '') 
			{
				$dados = elements(array('legenda','descricao'), $this->input->post());
				$dados['arquivo'] = $upload['file_name'];
				$this->midias->do_insert($dados);
			}else{
				set_msg('msgerror',$upload,'error');
				redirect(current_url());
			}					
		}
		set_tema('titulo','Upload de imagens');
		set_tema('conteudo', load_modulo($this->view.'cadastrar'));
		load_template();
		
	}

	public function gerenciar()
	{	
		//lista os dados do banco de dados
		$query =  $this->midias->get_all()->result();

		set_tema('footerinc',load_js(array('data-table','table')),FALSE);
		set_tema('titulo','Registros de Midia');
		set_tema('conteudo', load_modulo($this->view.'gerenciar',array('query'=>$query)));
		load_template();
		
	}

	public function editar($idmidia)
	{
		$this->form_validation->set_rules('legenda','Legenda','trim|required|ucfirst|');
		$this->form_validation->set_rules('descricao','Descrição','trim');
		
		if($this->form_validation->run(TRUE))
		{	
			$dados = elements(array('legenda','descricao'), $this->input->post());			
			$this->midias->do_update($dados,array('id_midia'=>$this->input->post('id_midia')));							
		}

		$query =  $this->midias->get_by_id($idmidia)->row();

		($query->tipo == 1)?$pasta='banners':$pasta='';
		set_tema('titulo','Editar mídia');
		set_tema('conteudo', load_modulo($this->view.'editar',array('query'=>$query,'pasta'=>$pasta)));
		load_template();		
	}

	public function excluir()
	{
		
		if (stats_user(TRUE)) 
		{
		 	$idmidia = $this->uri->segment(3);
		 	if ($idmidia != NULL) 
		 	{
		 		$query = $this->midias->get_by_id($idmidia);
		 		if ($query->num_rows()==1) {
		 			$query = $query->row();
		 			unlink('./medias/images/uploads/'.$query->arquivo);
		 			$thumbs= glob('./medias/images/uploads/thumbs/*_'.$query->arquivo);
		 			foreach ($thumbs as $arquivo) 
		 			{
		 				unlink($arquivo);
		 			}
		 			$this->midias->do_delete(array('id_midia'=>$query->id_midia),FALSE);	 			
		 		}else{
		 			set_msg('msgerror','Mídia não encontrada','error');
		 		}	
		 	}else{
		 		set_msg('msgerror','Escolha uma mídia para excluir','error');
		 	}
		}
		redirect('midias/gerenciar');		
	}

	public function get_imgs()
	{
		header('Content-Type: application/x-json; charset=utf-8');

		$this->db->like('legenda',$this->input->post('pesquisarimg'));
		
		if ($this->input->post('pesquisarimg')=='') $this->db->limit(10);

		$this->db->order_by('id_midia','DESC');
		$query =  $this->midias->get_all();
		$retorno = 'Nenhum resultado encontrado com base em sua pesquisa';
		if($query->num_rows()>0)
		{
			$retorno = '';
			$query = $query->result();
			foreach ($query as $data) 
			{
				$retorno .= '<a class="th" role="button" href="javascript:void(0)" onclick="tinyMCE.execCommand(\'mceInsertContent\',false,\'<img src='.base_url().'medias/images/'.$data->pasta.'/'.$data->arquivo.'/>\');return false;">';
				$retorno  .= '<img src="'.thumb($data->arquivo,250,130,FALSE,$data->pasta).'" class="retornoimg" alt="'.$data->legenda.'" title="Clique aqui para inserir"/>';
				$retorno .= '</a>';
			}			
		}
		echo (json_encode($retorno));
	}

	public function banners($segment=NULL)
	{
		if($segment == 'excluir')
		{
			$this->excluir_banner();
		}
			else
		{
			$this->gerenciar_banner();
		}
	}

	public function excluir_banner()
	{
		if (stats_user(TRUE)) 
		{
		 	$id = $this->uri->segment(4);
		 	if ($id != NULL) 
		 	{
		 		$query = $this->midias->get_by_id($id);
		 		if ($query->num_rows()==1) {
		 			$query = $query->row();
		 			unlink('./medias/images/banners/'.$query->arquivo);
		 			$thumbs= glob('./medias/images/banners/thumbs/*_'.$query->arquivo);
		 			foreach ($thumbs as $arquivo) 
		 			{
		 				unlink($arquivo);
		 			}
		 			$this->midias->do_delete_banner(array('id_midia'=>$query->id_midia),FALSE);	 			
		 		}else{
		 			set_msg('msgerror','Mídia não encontrada','error');
		 		}	
		 	}else{
		 		set_msg('msgerror','Escolha uma mídia para excluir','error');
		 	}
		}
		redirect('midias/banners');

		$this->midias->do_delete_banner($this->uri->segment(4));
	}

	public function gerenciar_banner()
	{
		$this->form_validation->set_rules('legenda','Legenda','trim|required|ucfirst|');
		$this->form_validation->set_rules('descricao','Descrição','trim');

		if($this->form_validation->run(TRUE))
		{	
			$upload = $this->midias->do_upload('arquivo','banners/');
			if (is_array($upload) && $upload['file_name'] != '') 
			{
				$dados = elements(array('legenda','descricao','tipo'), $this->input->post());
				$dados['arquivo'] = $upload['file_name'];
				$this->midias->do_insert_banner($dados);
			}else{
				set_msg('msgerror',$upload,'error');
				redirect(current_url());
			}
		}

		// carrega os banners cadastrado no banco
		$banners = $this->midias->get_all_banner()->result();

		set_tema('titulo','Upload de imagens');
		set_tema('conteudo', load_modulo($this->view.'gerenciar_banner',array('banners'=>$banners)));
		load_template();
	}
		
}

/* End of file midia.php */
/* Location: ./application/controllers/midia.php */