<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pagina_model extends CI_Model
{
	public function do_insert($dados=NULL, $redir=TRUE)
	{
		if ($dados != NULL) 
		{
			$this->db->insert('pg_pages',$dados);
			if ($this->db->affected_rows()>0)
			{	
				auditoria('Inclusão de página','Nova páginas cadastrada no sistema');
				set_msg('msgok','Página cadastrada com sucesso','sucess');
			}else{
				set_msg('msgok','Ocorreu um erro ao tentar inserir registro','error');
			}
			if($redir) redirect(current_url());
		}
	}
	public function do_insert_Categoria($dados=NULL, $redir=TRUE)
	{
		if ($dados != NULL) 
		{
			$this->db->insert('pg_categorias',$dados);
			if ($this->db->affected_rows()>0)
			{	
				auditoria('Inclusão de nova categoria','Nova categoria cadastrada no sistema');
				set_msg('msgok','Categoria cadastrada com sucesso','sucess');
			}else{
				set_msg('msgok','Ocorreu um erro ao tentar inserir registro','error');
			}
			if($redir) redirect(current_url());
		}
	}

	public function do_update($dados=NULL, $condicao=NULL, $redir=TRUE)
	{
		if ($dados != NULL && is_array($condicao))
		{
			$this->db->update('paginas',$dados,$condicao);
			if ($this->db->affected_rows()>0)
			{	
				auditoria('Alteração de páginas', 'A página com o id "'.$condicao['id'].'" foi alterada');
				set_msg('msgok','Alteração efetuada com sucesso','sucess');
			}else{
				set_msg('msgok','Ocorreu um erro ao tentar alterar registro','error');
			}			
			if($redir) redirect(current_url());
		}
	}

	public function do_delete($condicao=NULL,$redir=TRUE)
	{
		
		if ($condicao != NULL && is_array($condicao)) 
		{
			$this->db->delete('paginas',$condicao);
			if ($this->db->affected_rows()>0)
			{
				auditoria('Exclusão de páginas', 'A página com o id "'.$condicao['id'].'" foi excluída');
				set_msg('msgok','Registro excluído com sucesso','sucess');
			}else{
				set_msg('msgok','Erro ao excluir registro','error');
			}
			if ($redir) redirect(current_url());
		}
		else
		{
			return FALSE;
		}
	}

	public function status_all($array=FALSE)
	{	
		return $this->db->get('pg_status');
	}

	public function type_all()
	{			
		return $this->db->get('pg_type');
	}

	public function get_all()
	{			
		return $this->db->get('pg_pages');
	}

	public function categorias_all()
	{			
		return $this->db->get('pg_categorias');
	}

	public function get_by_id($id=NULL)
	{
		
		if ($id != NULL) 
		{
			$this->db->where('id_pagina',$id);
			$this->db->limit(1);
			return $this->db->get('paginas');
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