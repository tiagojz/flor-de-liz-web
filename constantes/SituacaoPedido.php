<?php

final class SituacaoPedido {

	const NAO_INFORMADA  = 0;
	const A_FATURAR      = 1;
	const FATURADO       = 2;
	const EM_PRODUCAO    = 3;
	const ENVIO_PENDENTE = 4;
	const ENVIADO        = 5;
	const ENTREGUE       = 6;
	const CANCELADO      =-1;


	private static $nomes = array(
		NAO_INFORMADA  => 'Não informada',
		A_FATURAR      => 'A faturar',
		FATURADO       => 'Faturado',
		EM_PRODUCAO    => 'Em produção',
		ENVIO_PENDENTE => 'Envio pendente',
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