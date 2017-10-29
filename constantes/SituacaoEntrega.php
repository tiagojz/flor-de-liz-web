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