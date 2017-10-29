<?php

final class SituacaoProducao {

	const NAO_INFORMADA = 0;
	const SOLICITADO    = 1;
	const EM_PRODUCAO   = 2;
	const PRODUZIDO     = 3;
	const CANCELADO     =-1;


	private static $nomes = array(
		self::SOLICITADO     => 'Solicitado',
		self::EM_PRODUCAO    => 'Em produção',
		self::PRODUZIDO      => 'Produzido',
		self::CANCELADO      => 'Cancelado'
	);

	public static function get( $codigo ) {
		if ( isset( self::$nomes[ intval( $codigo ) ] ) )
			return intval( $codigo );

		return self::NAO_INFORMADA;
	}

	public static function get_nome( $codigo ) {
		if ( isset( self::$nomes[ intval( $codigo ) ] ) )
			return self::$nomes[ intval( $codigo ) ];

		return 'Não informada';
	}

	public static function listar() {
		return self::$nomes;
	}
}