<?php

require_once '../inc/init.php';

try { 
	if ( empty( $_POST['codigo'] ) )
		throw new Exception( 'Código do calçado não informado.' );

	$calcado = Calcado::get( $_POST['codigo'] );

	if ( empty( $calcado ) )
		throw new Exception( 'Calçado não cadastrado.' );

	if ( Calcado::remover( $calcado ) )
		add_msg( 'info', 'Calçado removido.' );
} catch ( Exception $e ) {
	add_msg( 'danger', 'Erro ao remover calçado: ' . $e->getMessage() );
}

header( 'Location: ' . $_SERVER['HTTP_REFERER'] );
exit;