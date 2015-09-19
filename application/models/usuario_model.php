<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class usuario_model extends CI_Model
{
	public function do_insert($dados=NULL, $redir=TRUE)
	{
		if ($dados != NULL) 
		{
			$this->db->insert('usuarios',$dados);
			if ($this->db->affected_rows()>0)
			{
				set_msg('msgok','Seu cadastro foi efetuado com sucesso','sucess');
			}else{
				set_msg('msgok','Ocorreu um erro ao tentar inserir registro','error');
			}
			if($redir){ redirect(current_url()); }else{ return $this->db->insert_id(); }
		}
	}
	public function do_update($dados=NULL, $condicao=NULL, $redir=TRUE)
	{
		if ($dados != NULL && is_array($condicao))
		{
			$this->db->update('usuarios',$dados,$condicao);
			if ($this->db->affected_rows()>0)
			{
				set_msg('msgok','Alteração efetuada com sucesso','sucess');
			}else{
				set_msg('msgok','Ocorreu um erro ao tentar alterar registro','error');
			}			
			if($redir) redirect(current_url());
		}
	}
	public function do_login($usuario=NULL, $senha=NULL)
	{

		if($usuario && $senha)
		{	
			$this->db->where('login',$usuario);
			$this->db->where('senha',$senha);
			$this->db->or_where('email =', $usuario);
			$this->db->where('ativo',1);
			$query = $this->db->get('usuarios');
			
			if ($query->num_rows == 1) 
			{	
				return TRUE;
			}
			else
			{
				return FALSE;
			}
		}
		else
		{
			return FALSE;
		}
	}
	
	public function get_by_login($login=NULL)
	{
		if ($login != NULL) 
		{
			$this->db->where('login',$login);
			$this->db->or_where('email = ',$login);
			$this->db->limit(1);
			return $this->db->get('usuarios');
		}
		else
		{
			return FALSE;
		}
	}

	public function get_by_email($email=NULL)
	{
		if ($email != NULL) 
		{
			$this->db->where('email',$email);
			$this->db->limit(1);
			return $this->db->get('usuarios');
		}
		else
		{
			return FALSE;
		}
	}

	public function get_all()
	{
		return $this->db->get('usuarios');
	}

	public function get_by_id($id=NULL)
	{
		
		if ($id != NULL) 
		{
			$this->db->where('id_usuario',$id);
			$this->db->limit(1);
			return $this->db->get('usuarios');
		}
		else
		{
			return FALSE;
		}
	}
	public function do_delete($condicao=NULL,$redir=TRUE)
	{
		
		if ($condicao != NULL && is_array($condicao)) 
		{
			$this->db->delete('usuarios',$condicao);
			if ($this->db->affected_rows()>0)
			{
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


	public function login($usuario,$senha)
	{	
		$senha = md5($senha);	

		if($this->do_login($usuario,$senha) == TRUE)
		{

			$query = $this->usuarios->get_by_login($usuario)->row();
			$dados = array(
					 'user_id' => $query->id_usuario ,
					 'user_nome' => $query->nome,
					 'user_admin' => $query->adm,
					 'user_logado' =>TRUE,
			);
			$this->session->set_userdata($dados);

			return TRUE;
		}
		else
		{
			$query = $this->get_by_login($usuario)->row();
			if (empty($query)) 
			{
				set_msg('errologin','Usuário inexistente','error');
			}
			elseif($query->senha != $senha)
			{	
				set_msg('errologin','Senha Incorreta','error');
			}
			elseif($query->ativo == 0)
			{
				set_msg('errologin','usuário inativo','error');
			}
			else
			{
				set_msg('errologin','Erro desconhecido, contate o desenvolvedor','erro');
			}

			return FALSE;
		}		
	}
}

/*
* End of file usuario_model.php
* Location: /application/models/usuarioModel.php
*/