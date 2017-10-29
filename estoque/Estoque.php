<?php

class Estoque {

	private $calcado;
	private $tamanho;
	private $solicitado;
	private $em_producao;
	private $produzido;
	private $cancelado;

	private function set_calcado( $calcado ) {
		$this->calcado = Calcado::get( $calcado );
	}

	public function get_calcado() {
		return $this->calcado;
	}

	private function set_tamanho( $tamanho ) {
		$this->tamanho = intval( $tamanho );
	}

	public function get_tamanho() {
		return $this->tamanho;
	}

	private function set_solicitado( $solicitado ) {
		$this->solicitado = intval( $solicitado );
	}

	public function get_solicitado() {
		return $this->solicitado;
	}

	private function set_em_producao( $em_producao ) {
		$this->em_producao = intval( $em_producao );
	}

	public function get_em_producao() {
		return $this->em_producao;
	}

	private function set_produzido( $produzido ) {
		$this->produzido = intval( $produzido );
	}

	public function get_produzido() {
		return $this->produzido;
	}

	private function set_cancelado( $cancelado ) {
		$this->cancelado = intval( $cancelado );
	}

	public function get_cancelado() {
		return $this->cancelado;
	}

	public function get_saldo() {
		$entregue = 0;
		return $this->get_produzido() - $entregue;
	}


	public static function listar() {
		global $DB;

		$sql = '
			SELECT c.codigo AS calcado, p.tamanho,
				SUM(CASE WHEN p.situacao <> :solicitado THEN 0 ELSE p.quantidade END) AS solicitado,
				SUM(CASE WHEN p.situacao <> :em_producao THEN 0 ELSE p.quantidade END) AS em_producao,
				SUM(CASE WHEN p.situacao <> :produzido THEN 0 ELSE p.quantidade END) AS produzido,
				SUM(CASE WHEN p.situacao <> :cancelado THEN 0 ELSE p.quantidade END) AS cancelado
			FROM calcado c
			LEFT JOIN producao p ON p.calcado = c.codigo
			GROUP BY c.codigo, p.tamanho
			ORDER BY c.codigo
		';

		$stm = $DB->prepare( $sql );
		$stm->bindValue( ':solicitado', SituacaoProducao::SOLICITADO, PDO::PARAM_INT );
		$stm->bindValue( ':em_producao', SituacaoProducao::EM_PRODUCAO, PDO::PARAM_INT );
		$stm->bindValue( ':produzido', SituacaoProducao::PRODUZIDO, PDO::PARAM_INT );
		$stm->bindValue( ':cancelado', SituacaoProducao::CANCELADO, PDO::PARAM_INT );
		$stm->execute();

		$lista = array();

		if ( $stm->rowCount() )
			foreach ( $stm->fetchAll() as $row )
				$lista[] = self::carregar( new Estoque(), $row );

		return $lista;
	}

	private static function carregar( $estoque, $row ) {
		$estoque->set_calcado( $row['calcado'] );
		$estoque->set_tamanho( $row['tamanho'] );
		$estoque->set_solicitado( $row['solicitado'] );
		$estoque->set_em_producao( $row['em_producao'] );
		$estoque->set_produzido( $row['produzido'] );
		$estoque->set_cancelado( $row['cancelado'] );
		return $estoque;
	}
}