<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class produto_model extends CI_Model
{
	public function do_insert($dados=NULL,$config=NULL, $redir=TRUE)
	{
		if ($dados != NULL) 
		{	
						
			$this->db->insert('produtos',$dados);
			if ($this->db->affected_rows()>0)
			{	
				//faz a inserção das categorias
				$id = $this->db->insert_id();

				if ($config !=NULL) {
					$config['id_produto'] = $id;
					$this->db->insert('prod_config',$config);
				}

				auditoria('Cadastro de produto','Novo produto cadastrada no sistema');
				set_msg('msgok','Produto cadastrado com sucesso','sucess');
			}else{
				set_msg('msgok','Ocorreu um erro ao tentar cadastrar produto','error');
			}
			if($redir) redirect(current_url());			
		}
	}
	

	public function do_update($dados=NULL,$config, $condicao=NULL, $redir=TRUE)
	{
		if ($dados != NULL && is_array($condicao))
		{
			$this->db->update('produtos',$dados,$condicao);
			$this->db->update('prod_config',$config,$condicao);
			if ($this->db->affected_rows()>0)
			{	
				auditoria('Alteração de mídia', 'A mídia com o id "'.$condicao['id'].'" foi alterada');
				set_msg('msgok','Alteração efetuada com sucesso','sucess');
			}else{
				set_msg('msgok','Ocorreu um erro ao tentar alterar registro','error');
			}			
			if($redir) redirect(current_url());
		}
	}

	
	
	public function get_by_id($id=NULL)
	{		
		if ($id != NULL) 
		{
			$this->db->where('id_produto',$id);
			$this->db->limit(1);
			return $this->db->get('produtos');
		}
		else
		{
			return FALSE;
		}
	}

	public function get_config($id=NULL)
	{
		if ($id != NULL) 
		{
			$this->db->where('id_produto',$id);
			$this->db->limit(1);
			return $this->db->get('prod_config');
		}
		else
		{
			return FALSE;
		}
	}

	
}

/*
* End of file midiaModel.php
* Location: /application/models/midiaModel.php
*/