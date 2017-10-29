<?php

class Producao {

	private $codigo;
	private $calcado;
	private $tamanho;
	private $quantidade;
	private $data_producao;
	private $situacao;

	const TBL = 'producao';


	public function set_codigo( $codigo ) {
		$this->codigo = intval( $codigo );
	}

	public function get_codigo() {
		return $this->codigo;
	}

	public function set_calcado( $calcado ) {
		$this->calcado = Calcado::get( $calcado );
	}

	public function get_calcado() {
		return $this->calcado;
	}

	public function set_tamanho( $tamanho ) {
		if ( ! empty( $tamanho ) )
			$this->tamanho = intval( $tamanho );
	}

	public function get_tamanho() {
		return $this->tamanho;
	}

	public function set_quantidade( $quantidade ) {
		if ( ! empty( $quantidade ) )
			$this->quantidade = intval( $quantidade );
	}

	public function get_quantidade() {
		return $this->quantidade;
	}

	public function set_data_producao( $data_producao ) {
		if ( ! empty( $data_producao ) )
			$this->data_producao = strval( $data_producao );
	}

	public function get_data_producao() {
		return $this->data_producao;
	}

	public function set_situacao( $situacao ) {
		$this->situacao = SituacaoProducao::get( $situacao );
	}

	public function get_situacao() {
		return $this->situacao;
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
			return self::carregar( new Producao(), $stm->fetch() );
		
		return null;
	}

	private static function validar( $producao ) {
		if ( empty( $producao ) )
			throw new Exception( 'Produção não informada.' );

		if ( empty( $producao->get_calcado() ) )
			throw new Exception( 'Calçado não informado.' );

		if ( empty( $producao->get_tamanho() ) )
			throw new Exception( 'Tamanho não informado.' );

		if ( $producao->get_tamanho() < $producao->get_calcado()->get_menor_tamanho() )
			throw new Exception( 'Tamanho menor que o mínimo para o calçado.' );

		if ( $producao->get_tamanho() > $producao->get_calcado()->get_maior_tamanho() )
			throw new Exception( 'Tamanho maior que o máximo para o calçado.' );
	}

	public static function incluir( $producao ) {
		global $DB;

		self::validar( $producao );

		$sql = sprintf( '
			INSERT INTO %s (calcado, tamanho, quantidade, data_producao, situacao)
			VALUES (:calcado, :tamanho, :quantidade, :data_producao, :situacao);
		', self::TBL );

		try {
			$stm = $DB->prepare( $sql );
			$stm->bindValue( ':calcado', $producao->get_calcado()->get_codigo(), PDO::PARAM_INT );
			$stm->bindValue( ':tamanho', $producao->get_tamanho(), PDO::PARAM_INT );
			$stm->bindValue( ':quantidade', $producao->get_quantidade(), PDO::PARAM_INT );
			$stm->bindValue( ':data_producao', $producao->get_data_producao() );
			$stm->bindValue( ':situacao', $producao->get_situacao(), PDO::PARAM_INT );
			$stm->execute();

			return !! $stm->rowCount();
		} catch ( PDOException $e ) {
			throw new Exception( $stm->errorInfo()[2] );
		}
	}

	public static function alterar( $producao ) {
		global $DB;

		self::validar( $producao );

		if ( empty( $producao->get_codigo() ) )
			throw new Exception( 'Código não informado.' );

		$sql = sprintf( '
			UPDATE %s 
			SET calcado = :calcado, tamanho = :tamanho, quantidade = :quantidade,
			    data_producao = :data_producao, situacao = :situacao
			WHERE codigo = :codigo
		', self::TBL );

		try {
			$stm = $DB->prepare( $sql );
			$stm->bindValue( ':codigo', $producao->get_codigo(), PDO::PARAM_INT );
			$stm->bindValue( ':calcado', $producao->get_calcado()->get_codigo(), PDO::PARAM_INT );
			$stm->bindValue( ':tamanho', $producao->get_tamanho(), PDO::PARAM_INT );
			$stm->bindValue( ':quantidade', $producao->get_quantidade(), PDO::PARAM_INT );
			$stm->bindValue( ':data_producao', $producao->get_data_producao() );
			$stm->bindValue( ':situacao', $producao->get_situacao(), PDO::PARAM_INT );
			$stm->execute();

			return !! $stm->rowCount();
		} catch ( PDOException $e ) {
			throw new Exception( $stm->errorInfo()[2] );
		}
	}

	public static function remover( $producao ) {
		global $DB;

		if ( empty( $producao ) )
			throw new Exception( 'Ordem de produção não informada.' );

		if ( empty( $producao->get_codigo() ) )
			throw new Exception( 'Código não informado.' );

		try {
			$stm = $DB->prepare( sprintf( 'DELETE FROM %s WHERE codigo = :codigo', self::TBL ) );
			$stm->bindValue( ':codigo', $producao->get_codigo() );
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

		$producoes = array();

		if ( $stm->rowCount() )
			foreach ( $stm->fetchAll() as $row )
				$producoes[] = self::carregar( new Producao(), $row );

		return $producoes;
	}

	private static function carregar( $producao, $row ) {
		$producao->set_codigo( $row['codigo'] );
		$producao->set_calcado( $row['calcado'] );
		$producao->set_tamanho( $row['tamanho'] );
		$producao->set_quantidade( $row['quantidade'] );
		$producao->set_data_producao( $row['data_producao'] );
		$producao->set_situacao( $row['situacao'] );
		return $producao;
	}
} 