<?php

require_once '../inc/init.php';

try {
	$calcado = new Calcado();
	$calcado->set_nome( $_POST['nome'] );
	$calcado->set_colecao( $_POST['colecao'] );
	$calcado->set_menor_tamanho( $_POST['menor_tamanho'] );
	$calcado->set_maior_tamanho( $_POST['maior_tamanho'] );
	$calcado->set_valor( $_POST['valor'] );
	$calcado->set_cor( $_POST['cor'] );

	if ( ! empty( $_FILES['imagem'] ) && ! empty( $_FILES['imagem']['tmp_name'] ) ) {
		$imagem = upload_imagem( $_FILES['imagem'] );
		$calcado->set_imagem( $imagem );
	}

	if ( Calcado::incluir( $calcado ) )
		add_msg( 'success', 'Calçado incluído com sucesso.' );
} catch ( Exception $e ) {
	add_msg( 'danger', $e->getMessage() );
}

header( 'Location: ' . $_SERVER['HTTP_REFERER'] );
exit;