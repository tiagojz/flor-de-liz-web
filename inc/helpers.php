<?php

/**
 * Incluir parte do layout.
 */
function part( $part ) {
	$pathname = PATH . "/parts/{$part}.php";
	$success = include $pathname;
	
	if ( ! $success )
		die( "Falha ao incluir parte no layout: '{$part}' ({$pathname})" );
}

/**
 * Incluir arquivo de modal.
 */
function modal( $file, $codigo = '', $calcado = null ) {
	$pathname = PATH . "/{$file}";
	$success = include $pathname;
	
	if ( ! $success )
		die( "Falha ao incluir arquivo de modal no layout: '{$pathname}'" );
}

/**
 * Formatar para moeda.
 */
function price( $vlr ) {
	return 'R$ ' . number_format( $vlr, 2, ',', '.' );
}

/**
 * Retorna a URL do site mais o caminho informado do arquivo ou pasta.
 */
function home_url( $path = '' ) {
	return HOME_URL . '/' . ltrim( $path, '/' );
}

/**
 * Retorna URL com a localização da imagem feita upload.
 */
function url_imagem( $imagem ) {
	if ( ! empty( $imagem ) )
		return HOME_URL . '/uploads/' . $imagem;

	return '';
}

/**
 * Adicionar mensagem.
 */
function add_msg( $tipo, $msg ) {
	if ( ! isset( $_SESSION['msg'] ) )
		$_SESSION['msg'] = array();

	$_SESSION['msg'][] = array(
		'tipo' => $tipo,
		'msg'  => $msg
	);
}

/**
 * Exibir e logo após redefinir a lista de mensagens.
 */
function show_msgs() {
	if ( ! empty( $_SESSION['msg'] ) ) :
		foreach ($_SESSION['msg'] as $msg) :
		?>

			<div class="alert alert-<?= $msg['tipo']; ?>" role="alert">
				<?= $msg['msg']; ?>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			
		<?php
		endforeach;
	endif;

	$_SESSION['msg'] = array();
}

/**
 * Fazer upload da imagem e retornar nome do arquivo.
 */
function upload_imagem( $file ) {
	if ( empty( $file ) || empty( $file['tmp_name'] ) )
		return '';

	try {
		$name = $file['name'];
		$tmpname = $file['tmp_name'];
		$extension = pathinfo( $name, PATHINFO_EXTENSION );
		$newname = uniqid( 'calcado-' ) . ".{$extension}";
		$path = PATH . "/uploads/{$newname}";

		if ( file_exists( $path ) )
			unlink( $path );
		
		move_uploaded_file( $tmpname, $path );
		return $newname;
	} catch ( Exception $e ) {
		add_msg( 'Erro ao fazer upload da imagem: ' . $e->getMessage() );
		return '';
	}
}

/**
 * Formatar data para visualização.
 */
function formatar_data( $strdate ) {
	if ( empty( $strdate ) )
		return '';
	
	return date( 'd/m/Y', strtotime( $strdate ) );
}