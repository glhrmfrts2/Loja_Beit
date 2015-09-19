<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auditoria extends CI_Controller {

	public $view = 'auditoria/';

	public function __construct()
	{
		parent::__construct();		
		init_painel();
		user_logout();
		$this->load->model('auditoria_model','auditoria');
	}

	public function index()
	{

		$this->gerenciar();
	}

	public function gerenciar()
	{
		$data = array();

		//verifica a quantidade de dados a serem exibidos
		$modo = $this->uri->segment(3);
		if ($modo == 'all') {
			$limit = 0;
		}else
		{
			$limit = 5;
			$data['titulo'] = '<p>Mostrando os útimos 50 registros, para ver todo histórico ' .anchor('auditoria/gerenciar/all','Clique aqui').'</p>';
		}

		//pega dados do banco de dados para enviar para view
		$data['data'] = $this->auditoria->get_all($limit)->result();

		set_tema('footerinc',load_js(array('data-table','table')),FALSE);
		set_tema('titulo','Registros de auditoria');
		set_tema('conteudo', load_modulo($this->view.'gerenciar',$data));
		load_template();
		
	}
}

/* End of file auditoria.php */
/* Location: ./application/controllers/audtiroia.php */