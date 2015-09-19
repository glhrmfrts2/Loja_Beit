<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// carrega um módulo do sistema devolvendo a tela solicitada

function load_modulo($modulo=NULL, $data=NULL, $diretorio='painel')
{
	$CI =& get_instance();

	if( $modulo!=NULL )
	{
		return $CI->load->view("$diretorio/$modulo",$data,TRUE);
	
	}else{

		return FALSE;
	}
}

function incluir_arquivo($view,$pasta=NULL)
{	
	$CI =& get_instance();
	if ($pasta==NULL) 
	{
		return $CI->load->view('painel/includes/'.$view,'',TRUE);
		
	}
	return $CI->load->view($pasta.'/includes/'.$view,'',TRUE);
}

//seta valores ao array $tema da classe sistema
function set_tema($prop,$valor,$replace=TRUE)
{
	$CI =& get_instance();
	$CI->load->library('sistema');

	if($replace)
	{
		$CI->sistema->tema[$prop] = $valor;
	}else{
		if(!isset($CI->sistema->tema[$prop])) $CI->sistema->tema[$prop] = '';
		$CI->sistema->tema[$prop] .= $valor;
	}
}

function get_tema()
{
	$CI =& get_instance();
	$CI->load->library('sistema');
	return $CI->sistema->tema;
}

//inicializar o painel adm carregando os recursos necessários
function init_painel()
{
	$CI =& get_instance();
	$CI->load->library(array('sistema','session','form_validation','parser'));
	$CI->load->helper(array('form','url','array','text'));
	
	//carregamento do models
	$CI->load->model('usuario_model','usuarios');

	set_tema('titulo_padrao','Painel ADM');
	set_tema('rodape','<p>&copy; 2014 | Todos os direitos reservados para BR');
	set_tema('template','painel');	
	//incluir_arquivo('navegacao');
	//set_tema('navegacao',incluir_arquivo('navegacao'));
	set_tema('headerinc',load_css(array('foundation/foundation.min','back/style')),FALSE);
	set_tema('headerinc',load_js(array('jquery')),FALSE);
	set_tema('footerinc',load_js(array('foundation.min')),FALSE);
	
}

//inicializar o painel adm carregando os recursos necessários
function init_front()
{
	$CI =& get_instance();
	$CI->load->library(array('sistema','session','form_validation','parser'));
	$CI->load->helper(array('form','url','array','text'));
	

	set_tema('titulo_padrao','Lanabello');
	set_tema('rodape',incluir_arquivo('footer','application'));
	set_tema('template','site');	
	//incluir_arquivo('navegacao');
	//set_tema('navegacao',incluir_arquivo('navegacao'));
	set_tema('headerinc',load_css(array('foundation/foundation.min')),FALSE);
	set_tema('headerinc',load_css(array('front/global')),FALSE);
	set_tema('headerinc',load_js(array('jquery')),FALSE);
	set_tema('footerinc',load_js(array('foundation.min')),FALSE);
	
}

//carrega o ckeditor para textearea
function init_editorhtml()
{
	set_tema('footerinc', load_js(base_url('medias/library/ckeditor/ckeditor'), NULL, TRUE),FALSE);
	set_tema('footerinc', load_js(base_url('medias/library/ckeditor/sample'), NULL, TRUE),FALSE);
	set_tema('footerinc', load_js(base_url('medias/js/init_ckeditor'), NULL, TRUE),FALSE);
}


function init_editortinymce()
{
	set_tema('footerinc', load_js("//tinymce.cachefly.net/4.1/tinymce.min", NULL, TRUE),FALSE);

	set_tema('footerinc', load_js("medias/library/tinymce/init_tinymce", NULL, FALSE),FALSE);

}

//carrega um templates passando o array $tema como parâmetro
function load_template()
{
	$CI =& get_instance();
	$CI->load->library('sistema');
	$CI->parser->parse($CI->sistema->tema['template'], get_tema());
}

//carrega um ou varios arquivos css em uma pasta
function load_css($arquivo=NULL,$pasta='medias/css',$medias='all')
{
	if($arquivo != NULL)
	{
		$CI =& get_instance();
		$CI->load->helper('url');
		$retorno = '';

		if( is_array($arquivo))
		{
			foreach ($arquivo as $css) 
			{
				$retorno .= '<link rel="stylesheet" type="text/css" href="'.base_url("$pasta/$css.css").'" media="'.$medias.'">';
			}

		}else{

			$retorno .= '<link rel="stylesheet" type="text/css" href="'.base_url("$pasta/$arquivo.css").'" media="'.$medias.'">';
		
		}
		return $retorno;
	}
}

// função carrega um ou varios arquivos js, de uma pasta ou remoto

function load_js($arquivo=NULL, $pasta='medias/js', $remoto=FALSE)
{
	if ( $arquivo != NULL) 
	{
		$CI =& get_instance();
		$CI->load->helper('url');

		$retorno = '';

		if(is_array($arquivo))
		{
			foreach ($arquivo as $js) {
				if($remoto)
				{
					$retorno .= '<script type="text/javascript" src="'.$js.'.js"></script>';	
				}else{
					$retorno .= '<script type="text/javascript" src="'.base_url($pasta."/".$js).'.js"></script>';
				}
			}
		}else{
			if($remoto)
			{	
				$retorno .= '<script type="text/javascript" src="'.$arquivo.'.js"></script>';	
			}else{
				$retorno .= '<script type="text/javascript" src="'.base_url($pasta."/".$arquivo).'.js"></script>';
			}
		}
	}
	return $retorno;
}

//mostra erros de validadção em form

function erros_validacao()
{
	if(validation_errors()) echo '<div class="alert-box alert radius">'.validation_errors('<p>','</p>').'</div>';
}

//verifica se o usuário esta logado no sistema
//NO FUTURO CORRIGIR ESSA FUNÇÃO, CREATE SESSION PODE DAR PROBLEMAS
function user_logout($redir=TRUE)
{
	$CI =& get_instance();
	$CI->load->library('session');
	$user_status = $CI->session->userdata('user_logado');

	//dd($user_status);
	if (!isset($user_status) || $user_status != TRUE) 
	{
		$CI->session->sess_destroy();
		$CI->session->sess_create();

		if ($redir) 
		{
			$CI->session->set_userdata(array('redir_para'=>current_url()));
			set_msg('errologin','Acesso restrito, faça login antes de prosseguir','error');
			redirect('usuarios/login');
		}
		else
		{
			return FALSE;
		}
	}
	else
	{
		return TRUE;
	}
}

//define uma mensagem para ser exibida na próxima tela carregada

function set_msg($id='msgerro', $msg=NULL, $tipo='error')
{
	$CI =& get_instance();
	switch ($tipo) {
		case 'error':
			$CI->session->set_flashdata($id,'<div class="large-12 alert-box alert radius"><p>'.$msg.'</p></div>');
		break;
		case 'sucess':
			$CI->session->set_flashdata($id,'<div class="large-12 alert-box sucess radius"><p>'.$msg.'</p></div>');
		break;
		
		default:
			$CI->session->set_flashdata($id,'<div class="alert-box radius"><p>'.$msg.'</p></div>');
		break;
	}
}

//verifica se existe uma mensgem para ser exibida na tela atual
function get_msg($id, $printar=TRUE)
{	
	$CI =& get_instance();		
	if ($CI->session->flashdata($id))
	{

		if ($printar) {
			echo $CI->session->flashdata($id);
			return TRUE;
		}
		else
		{
			return $CI->session->flashdata($id);
		}
	}
	//return FALSE;
}

//verifica se usuario logado é administrador
function stats_user($set_msg=FALSE)
{
	$CI = & get_instance();
	$user_admin = $CI->session->userdata('user_admin');
	if (!isset($user_admin) || $user_admin != TRUE)
	{
		if($set_msg) set_msg('msgerror','você não tem permissão para executar essa operação','error');
		return FALSE;
	}else{
		return TRUE;
	}
}

//gera um breadcrumb com base no controller atual
function breadcrumb($asc=NULL)
{
	$CI = & get_instance();
	$CI->load->helper('url');
	$classe = ucfirst($CI->router->class);
	if($classe == 'Painel')
	{
		$classe = anchor($CI->router->class,'Início');

	}else{

		$classe = anchor($CI->router->class,$classe);

	}
	$metodo = ucwords(str_replace('_',' ',$CI->router->method));
	
	if ($metodo && $metodo != 'Index')
	{
		$metodo = '<li>'.anchor($CI->router->class."/".$CI->router->method,$metodo).'</li>';

	}else{
		$metodo = '';
	}
	//acrecenta mais nreadcrumb no final
	if ($asc != NULL) {
		$and = "<li>".$asc."</li>";
	}else{
		$and = '';
	}
	return '<ul class="breadcrumbs"><li>'.anchor('painel','Início').'</li>'.$classe.$metodo.$and."</ul>";
}

//seta um registro na tabela auditoria
function auditoria($operacao,$observacao,$query=TRUE)
{
	$CI =& get_instance();
	$CI->load->library('session');
	$CI->load->model('auditoria_model','auditoria');
	if (user_logout(FALSE)) 
	{
		$user_id  = $CI->session->userdata('user_id');
		$user_login = $CI->usuarios->get_by_id($user_id)->row()->login; 
	}
	else
	{
		$user_login = 'Desconhecido';
	}
	if ($query) {
		$last_query = $CI->db->last_query();
	}
	else
	{
		$last_query = '';
	}
	$dados = array(
		'usuario' => $user_login,
		'operacao' => $operacao,
		'query'   => $last_query,
		'observacao' => $observacao
	);
	$CI->auditoria->do_insert($dados,FALSE);
}

//gera uma thumb de uma image
function thumb($imagem=NULL,$width=100,$height=75,$geratag=TRUE,$pasta='uploads')
{	

	$CI =& get_instance();
	$CI->load->helper('file');
	$caminho = './medias/images/'.$pasta.'/thumbs/';
	$thumb = $height.'x'.$width.'_'.$imagem;
	$thumbinfo = get_file_info($caminho.$thumb);

	if($thumbinfo!=FALSE)
	{
		$retorno = base_url($caminho.$thumb);

	}else{
		$CI->load->library('image_lib');
		$config['image_library'] = 'gd2';
		$config['source_image'] = './medias/images/'.$pasta.'/'.$imagem;
		$config['new_image'] = $caminho.$thumb;
		$config['maintain_ratio'] = TRUE;
		$config['width'] = $width;
		$config['height'] = $height;
		$CI->image_lib->initialize($config);
		if ($CI->image_lib->resize()) 
		{
			$CI->image_lib->clear();
			$retorno = base_url($caminho.$thumb);
		}else{
			$retorno =FALSE;
		}		
	}
	if($geratag && $retorno != FALSE)$retorno = '<img src="'.$retorno.'" alt="">';
	return $retorno;
}

function slug($string=NULL)
{
 	$string = remove_acento($string);
 	return url_title($string,'-',TRUE);
}

function remove_acento($string=NULL)
{
	$string = preg_replace("/[ÁÀÂÃÄáàâãä]/", "a", $string);
    $string = preg_replace("/[ÉÈÊéèê]/", "e", $string);
    $string = preg_replace("/[ÍÌíì]/", "i", $string);
    $string = preg_replace("/[ÓÒÔÕÖóòôõö]/", "o", $string);
    $string = preg_replace("/[ÚÙÜúùü]/", "u", $string);
    $string = preg_replace("/Çç/", "c", $string);
    $string = preg_replace("/[][><}{)(:;,!?*%~^`&#@]/", "", $string);
    $string = strtolower($string);
    return $string;
}

function resumo($string=NULL,$palavras=50,$decodifica_html=TRUE,$remove_tags=TRUE)
{
	if ($string!=NULL) 
	{
		if ($decodifica_html) $string = to_html($string);
		if ($remove_tags) $string = strip_tags($string);
		$retorno = word_limiter($string,$palavras);
	}else{
		$retorno = FALSE;
	}
	return $retorno;
}

function to_html($string=NULL)
{
	return html_entity_decode($string);

}

//salva ou atualiza uma config no db
function set_setting($nome, $valor='')
{
	$CI =& get_instance();
	$CI->load->model('settings_model','settings');
	if ($CI->settings->get_by_nome($nome)->num_rows() == 1)
	{
		if (trim($valor) == '') 
		{
			$CI->settings->do_delete(array('nome_config'=>$nome),FALSE);
		}else{
			$dados = array(
				'nome_config' => $nome,
				'valor_config' =>$valor
			);
			$CI->settings->do_update($dados,array('nome_config'=>$nome),FALSE);
		}
	}else{
		$dados = array(
			'nome_config' => $nome,
			'valor_config' =>$valor
		);
		$CI->settings->do_insert($dados,FALSE);
	}
}

//retorno uma config do db
function get_setting($nome)
{
	$CI =& get_instance();
	$CI->load->model('settings_model','settings');
	$setting = $CI->settings->get_by_nome($nome);
	if ($setting->num_rows()==1) 
	{
		$setting = $setting->row();
		return $setting->valor_config;
	}else{
		return NULL;
	}
	return $setting->valor_config;
}


function dd($var,$exit=FALSE){
	echo "<pre style:border:1px solid #ccc;>";
	print_r($var);
	echo "</pre>";

	if($exit == TRUE){
		exit();
	}
}