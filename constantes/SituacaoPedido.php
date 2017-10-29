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
		foreach ($nomes as $key => $value)
			if ( $key === $codigo )
				return $key;

		return NAO_INFORMADA;
	}

	public static function get_nome( $codigo ) {
		if ( ! empty( $codigo ) && is_int( $codigo) )
			if ( isset( $nomes[ $codigo ] ) )
				return $nomes[ $codigo ];

		return $nomes[ NAO_INFORMADA ];
	}
}