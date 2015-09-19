<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pedido_model extends CI_Model
{
	public function do_insert($dados=NULL,$config=NULL)
	{
		if ($dados != NULL) 
		{	
						
			$this->db->insert('pedido',$dados);
			if ($this->db->affected_rows()>0)
			{	
				//faz a inserção das categorias
				$id = $this->db->insert_id();

				
				auditoria('Cadastro de produto','Novo produto cadastrada no sistema');
				set_msg('msgok','Produto cadastrado com sucesso','sucess');


				return $id;

			}else{
				set_msg('msgok','Ocorreu um erro ao tentar cadastrar produto','error');
			}
			
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

	public function columns_config($campos,$id,$array=false)
	{
		$this->db->select($campos);
		$this->db->from('prod_config');
		$this->db->where('id_produto',$id);
		$this->db->limit(1);
		$query = $this->db->get()->result_array();

		if ($array == true) {			

			foreach ($query[0] as $key => $value) {

				$query = json_decode($value);

			}
		}

		return $query;
	}

	public function preco_papel($tipo)
	{
		$this->db->select('tipo_banner');
		$this->db->from('prod_config');
		$this->db->where('id_produto',1);
		$this->db->limit(1);
		$query = $this->db->get()->result_array();			

		foreach ($query[0] as $key => $value) {
			$query = json_decode($value);
		}

		foreach ($query as $value) {

			if ($tipo == $value->codigo)
			{
				$preco = $value->preco;
			}
		}
		return $preco;
	}


	public function preco_tripe()
	{
		$this->db->select('tripe');
		$this->db->from('prod_config');
		$this->db->where('id_produto',1);
		$this->db->limit(1);
		$query = $this->db->get()->result_array();			

		foreach ($query[0] as $key => $value) {
			$query = json_decode($value);
		}

		
		return $query->com_tripe->preco;
	}

	public function value_campo($id,$campo,$cod)
	{
		$query = $this->columns_config($campo,$id,TRUE);

		foreach ($query as $value) {

			if ($cod == $value->codigo)
			{
				return $value->name;
			}
		}
	}


	public function save_pedido($detalhe_pd=NULL,$codigo=NULL)
	{

		//($detalhe_pd);
		date_default_timezone_set('UTC');
		$pedido['id_cliente']   = $this->session->userdata('user_id');
		$pedido['cod_pagseguro']  = $this->input->get('cod');
		$pedido['data_compra']  = date('Y-m-d H:m:s');
		$pedido['total']   = $this->cart->total();
		//$pedido['status_pagamento'] = 'Em Análise';

		$this->db->insert('pedido',$pedido);
		$id_pedido = $id = $this->db->insert_id();

		foreach ($detalhe_pd as $key => $value) {

			$dados['id_pedido'] = $id_pedido;	
			$dados['nome_produto'] = $value['name'];
			$dados['descricao']    = json_encode($value['options']);
			$dados['quantidade'] = $value['options']['quantidade'];			

			$this->db->insert('detalhes_pedido',$dados);
		}

		$this->cart->destroy();		
	}

	public function get_pedidos($id=NULL)
	{
		$this->db->where('id_cliente',$id);
		$pedidos = $this->db->get('pedido')->result_array();

		foreach ($pedidos as $k => $value) {
			$this->db->where('id_pedido',$value['id_pedido']);
			$detalhes_pedido = $this->db->get('detalhes_pedido')->result_array();

			$pedidos[$k]['detalhes_pedido'] = $detalhes_pedido;
		}

		return $pedidos;
	}
}

/*
* End of file midiaModel.php
* Location: /application/models/midiaModel.php
*/