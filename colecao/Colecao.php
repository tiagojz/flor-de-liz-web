<?php

class Colecao {

	private $codigo;
	private $nome;

	const TBL = 'colecao';


	public function set_codigo( $codigo ) {
		$this->codigo = intval( $codigo );
	}

	public function get_codigo() {
		return $this->codigo;
	}

	public function set_nome( $nome ) {
		$this->nome = strval( $nome );
	}

	public function get_nome() {
		return $this->nome;
	}


	public static function get( $codigo ) {
		global $DB;

		$codigo = intval( $codigo );

		$stm = $DB->prepare( sprintf( 'SELECT * FROM %s WHERE codigo = :codigo', self::TBL ) );
		$stm->bindParam( ':codigo', $codigo, PDO::PARAM_INT );
		$stm->execute();

		if ( $stm->rowCount() ) {
			$row = $stm->fetch();

			$colecao = new Colecao();
			$colecao->set_codigo( $row['codigo'] );
			$colecao->set_nome( $row['nome'] );

			return $colecao;
		}
		
		return null;
	}

	public static function listar() {
		global $DB;

		$stm = $DB->prepare( 'SELECT * FROM ' . self::TBL );
		$stm->execute();

		$colecoes = array();

		if ( $stm->rowCount() ) {
			foreach ( $stm->fetchAll() as $row ) {
				$colecao = new Colecao();
				$colecao->set_codigo( $row['codigo'] );
				$colecao->set_nome( $row['nome'] );

				$colecoes[] = $colecao;
			}
		}

		return $colecoes;
	}
}