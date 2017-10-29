<?php

class Calcado {

	private $codigo;
	private $nome;
	private $colecao;
	private $menor_tamanho;
	private $maior_tamanho;
	private $valor;
	private $cor;
	private $imagem;

	const TBL = 'calcado';


	public function set_codigo( $codigo ) {
		if ( ! empty ( $codigo ) )
			$this->codigo = intval( $codigo );
	}

	public function get_codigo() {
		return $this->codigo;
	}

	public function set_nome( $nome ) {
		if ( ! empty ( $nome ) )
			$this->nome = strval( $nome );
	}

	public function get_nome() {
		return $this->nome;
	}

	public function set_colecao( $colecao ) {
		if ( ! empty ( $colecao ) )
			$this->colecao = Colecao::get( $colecao );
	}

	public function get_colecao() {
		return $this->colecao;
	}

	public function set_menor_tamanho( $menor_tamanho ) {
		if ( ! empty ( $menor_tamanho ) )
			$this->menor_tamanho = intval( $menor_tamanho );
	}

	public function get_menor_tamanho() {
		return $this->menor_tamanho;
	}

	public function set_maior_tamanho( $maior_tamanho ) {
		if ( ! empty ( $maior_tamanho ) )
			$this->maior_tamanho = intval( $maior_tamanho );
	}

	public function get_maior_tamanho() {
		return $this->maior_tamanho;
	}

	public function set_valor( $valor ) {
		if ( ! empty ( $valor ) )
			$this->valor = floatval( $valor );
	}

	public function get_valor() {
		return $this->valor;
	}

	public function set_cor( $cor ) {
		$this->cor = is_int( $cor ) ? dechex( $cor ) : $cor;
		$this->cor = str_pad( $this->cor, 6, '0', STR_PAD_LEFT );
	}

	public function get_cor() {
		return $this->cor;
	}

	public function get_cor_int() {
		return hexdec( $this->cor );
	}

	public function set_imagem( $imagem ) {
		if ( ! empty ( $imagem ) )
			$this->imagem = strval( $imagem );
	}

	public function get_imagem() {
		return $this->imagem;
	}

	public function get_imagem_url() {
		return url_imagem( $this->imagem );
	}
	

	public static function get( $codigo ) {
		global $DB;

		if ( empty( $codigo ) )
			throw new Exception( 'Código não informado.' );

		$codigo = intval( $codigo );

		$stm = $DB->prepare( sprintf( 'SELECT * FROM %s WHERE codigo = :codigo', self::TBL ) );
		$stm->bindParam( ':codigo', $codigo, PDO::PARAM_INT );
		$stm->execute();

		if ( $stm->rowCount() )
			return self::carregar( new Calcado(), $stm->fetch() );
		
		return null;
	}

	public static function incluir( $calcado ) {
		global $DB;

		if ( empty( $calcado ) )
			throw new Exception( 'Calçado não informado.' );

		if ( empty( $calcado->get_nome() ) )
			throw new Exception( 'Nome não informado.' );

		if ( empty( $calcado->get_colecao() ) )
			throw new Exception( 'Coleção não informada.' );

		$sql = sprintf( '
			INSERT INTO %s (nome, colecao, menor_tamanho, maior_tamanho, valor, cor, imagem)
			VALUES (:nome, :colecao, :menor_tamanho, :maior_tamanho, :valor, :cor, :imagem);
		', self::TBL );

		try {
			$stm = $DB->prepare( $sql );
			$stm->bindValue( ':nome', $calcado->get_nome() );
			$stm->bindValue( ':colecao', $calcado->get_colecao()->get_codigo(), PDO::PARAM_INT );
			$stm->bindValue( ':menor_tamanho', $calcado->get_menor_tamanho(), PDO::PARAM_INT );
			$stm->bindValue( ':maior_tamanho', $calcado->get_maior_tamanho(), PDO::PARAM_INT );
			$stm->bindValue( ':valor', $calcado->get_valor() );
			$stm->bindValue( ':cor', $calcado->get_cor_int(), PDO::PARAM_INT );
			$stm->bindValue( ':imagem', $calcado->get_imagem() );
			$stm->execute();

			return !! $stm->rowCount();
		} catch ( PDOException $e ) {
			throw new Exception( $stm->errorInfo()[2] );
		}
	}

	public static function alterar( $calcado ) {
		global $DB;

		if ( empty( $calcado ) )
			throw new Exception( 'Calçado não informado.' );

		if ( empty( $calcado->get_nome() ) )
			throw new Exception( 'Nome não informado.' );

		if ( empty( $calcado->get_colecao() ) )
			throw new Exception( 'Coleção não informada.' );

		$sql = sprintf( '
			UPDATE %s 
			SET nome = :nome, colecao = :colecao, menor_tamanho = :menor_tamanho,
				maior_tamanho = :maior_tamanho, valor = :valor, cor = :cor, imagem = :imagem
			WHERE codigo = :codigo
		', self::TBL );

		try {
			$stm = $DB->prepare( $sql );
			$stm->bindValue( ':codigo', $calcado->get_codigo(), PDO::PARAM_INT );
			$stm->bindValue( ':nome', $calcado->get_nome() );
			$stm->bindValue( ':colecao', $calcado->get_colecao()->get_codigo(), PDO::PARAM_INT );
			$stm->bindValue( ':menor_tamanho', $calcado->get_menor_tamanho(), PDO::PARAM_INT );
			$stm->bindValue( ':maior_tamanho', $calcado->get_maior_tamanho(), PDO::PARAM_INT );
			$stm->bindValue( ':valor', $calcado->get_valor() );
			$stm->bindValue( ':cor', $calcado->get_cor_int(), PDO::PARAM_INT );
			$stm->bindValue( ':imagem', $calcado->get_imagem() );
			$stm->execute();

			return !! $stm->rowCount();
		} catch ( PDOException $e ) {
			throw new Exception( $stm->errorInfo()[2] );
		}
	}

	public static function remover( $calcado ) {
		global $DB;

		if ( empty( $calcado ) )
			throw new Exception( 'Calçado não informado.' );

		if ( empty( $calcado->get_codigo() ) )
			throw new Exception( 'Código não informado.' );

		try {
			$stm = $DB->prepare( sprintf( 'DELETE FROM %s WHERE codigo = :codigo', self::TBL ) );
			$stm->bindValue( ':codigo', $calcado->get_codigo() );
			$stm->execute();

			return !! $stm->rowCount();
		} catch ( PDOException $e ) {
			throw new Exception( $e->getmessage() );
		}
	}
	
	public static function listar() {
		global $DB;

		$stm = $DB->prepare( sprintf ('SELECT * FROM %s ORDER BY codigo', self::TBL ) );
		$stm->execute();

		$calcados = array();

		if ( $stm->rowCount() )
			foreach ( $stm->fetchAll() as $row )
				$calcados[] = self::carregar( new Calcado(), $row );

		return $calcados;
	}

	private static function carregar( $calcado, $row ) {
		$calcado->set_codigo( $row['codigo'] );
		$calcado->set_nome( $row['nome'] );
		$calcado->set_colecao( $row['colecao'] );
		$calcado->set_menor_tamanho( $row['menor_tamanho'] );
		$calcado->set_maior_tamanho( $row['maior_tamanho'] );
		$calcado->set_valor( $row['valor'] );
		$calcado->set_cor( intval( $row['cor'] ) );
		$calcado->set_imagem( $row['imagem'] );
		return $calcado;
	}
} 