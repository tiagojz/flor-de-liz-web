<?php

final class SituacaoEntrega {

	const NAO_INFORMADA = 0;
	const PENDENTE      = 1;
	const ENVIADO       = 2;
	const ENTREGUE      = 3;
	const CANCELADO     =-1;

	private static $nomes = array(
		NAO_INFORMADA  => 'Não informada',
		PENDENTE       => 'Pendente',
		ENVIADO        => 'Enviado',
		ENTREGUE       => 'Entregue',
		CANCELADO      => 'Cancelado'
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