<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
**************************************
*   autho@ Bernan Ribeiro
*	email@ alves.bernan@gmail.com
*
*	IMPOTANTE !!!
*	Algumas das classes precisam ser configuradas as rotas para rodas esta aplicação
*   Se for atualizar ou mexer em alguma coisa aqui, não deixe de dar uma olhadinha em config/routes.php
*
**************************************
 */
class Appsite extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		init_front();
	}

	public function index()
	{

		$this->home();
	}

	public function home()
	{	
				
		//set_tema('footerinc', load_js(base_url('medias/pluguins/owl/owl.carousel'), NULL, TRUE),FALSE);
		//set_tema('headerinc',load_css('owl.carousel','medias/pluguins/owl/'),FALSE);

		set_tema('conteudo',load_modulo('home','','application'));
		load_template();
	}

	public function lista()
	{
		set_tema('conteudo', load_modulo('categorias','','application'));
		load_template();
	}

	

	public function carrinho()
	{			

		set_tema('titulo','Resultado da Busca');
		set_tema('conteudo',load_modulo('resultado_busca', array('resultado' => $result),'application'));
		load_template();
	}

	
	
}
