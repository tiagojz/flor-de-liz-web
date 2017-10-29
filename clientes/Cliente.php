<?php

class Cliente {

	public $codigo;
	public $nome_cliente;
	public $nome_loja;
	public $cnpj_cliente;
	public $cpf_proprietario_loja;
	public $telefone_contato;
	public $logradouro;
	public $numero;
	public $bairro;
	public $complemento;
	public $cep;
	public $cidade;
	public $uf;


	const TBL = 'cliente';


	public static function get( $codigo ) {
		global $DB;

		if ( empty( $codigo ) )
			throw new Exception( 'Código não informado.' );

		$codigo = intval( $codigo );

		$stm = $DB->prepare( sprintf( 'SELECT * FROM %s WHERE codigo = :codigo', self::TBL ) );
		$stm->bindParam( ':codigo', $codigo, PDO::PARAM_INT );
		$stm->execute();

		if ( $stm->rowCount() )
			return self::carregar( new Cliente(), $stm->fetch() );
		
		return null;
	}

	public static function listar() {
		global $DB;

		$stm = $DB->prepare( sprintf ('SELECT * FROM %s ORDER BY codigo', self::TBL ) );
		$stm->execute();

		$clientes = array();

		if ( $stm->rowCount() )
			foreach ( $stm->fetchAll() as $row )
				$clientes[] = self::carregar( new Cliente(), $row );

		return $clientes;
	}

	private static function carregar( $cliente, $row ) {
		$cliente->codigo = intval( $row['codigo'] );
		$cliente->nome_cliente = $row['nome_cliente'];
		$cliente->nome_loja = $row['nome_loja'];
		$cliente->cnpj_cliente = $row['cnpj_cliente'];
		$cliente->cpf_proprietario_loja = $row['cpf_proprietario_loja'];
		$cliente->telefone_contato = $row['telefone_contato'];
		$cliente->logradouro = $row['logradouro'];
		$cliente->numero = intval( $row['numero'] );
		$cliente->bairro = $row['bairro'];
		$cliente->complemento = $row['complemento'];
		$cliente->cep = $row['cep'];
		$cliente->cidade = $row['cidade'];
		$cliente->uf = $row['uf'];
		return $cliente;
	}
} 