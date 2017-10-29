 <?php

require_once '../inc/init.php';


// REMOVER

if ( ! empty( $_GET['remover'] ) ) {
	$producao = Producao::get( $_GET['remover'] );

	try {
		if ( empty( $producao ) )
			throw new Exception( 'Ordem de produção não cadastrada.' );

		if ( Producao::remover( $producao ) )
			add_msg( 'info', 'Ordem de produção removida.' );
	} catch ( Exception $e ) {
		add_msg( 'danger', $e->getMessage() );
	}

	header( 'Location: ' . home_url( 'producao') );
	exit;
}

// INCLUIR E ALTERAR

if ( ! empty( $_POST ) ) {
	try {
		if ( ! empty( $_POST['codigo'] ) ){
			// ALTERAR

			$producao = Producao::get( $_POST['codigo'] );

			if ( empty( $producao ) )
				throw new Exception( 'Produção não cadastrada.' );

			$producao->set_calcado( $_POST['calcado'] );
			$producao->set_tamanho( $_POST['tamanho'] );
			$producao->set_quantidade( $_POST['quantidade'] );
			$producao->set_data_producao( $_POST['data_producao'] );
			$producao->set_situacao( $_POST['situacao'] );

			if ( Producao::alterar( $producao ) )
				add_msg( 'success', 'Produção alterada com sucesso.' );
		} else {
			// INCLUIR

			$producao = new Producao();
			$producao->set_calcado( $_POST['calcado'] );
			$producao->set_tamanho( $_POST['tamanho'] );
			$producao->set_quantidade( $_POST['quantidade'] );
			$producao->set_data_producao( $_POST['data_producao'] );
			$producao->set_situacao( $_POST['situacao'] );

			if ( Producao::incluir( $producao ) )
				add_msg( 'success', 'Produção incluída com sucesso.' );
		}
	} catch ( Exception $e ) {
		add_msg( 'danger', $e->getMessage() );
	}

    header( 'Location: ' . home_url( 'producao') );
    exit;
}

// CARREGAR PRODUÇÃO PARA SER ALTERADA

if ( ! empty( $_GET['codigo'] ) ) {
	$producao = Producao::get( $_GET['codigo'] );

	if ( empty( $producao ) )
		add_msg( 'info', 'Produção não cadastrada.' );
}


$producoes = Producao::listar();

part( 'header' );

?>

<div class="row mb-4">
	<div class="col">
		<h2>Produção</h2>
	</div>
</div><!-- .row -->

<form method="post">
	<?php if ( ! empty( $producao ) ) : ?>
		<input type="hidden" name="codigo" value="<?= $producao->get_codigo(); ?>">
	<?php endif; ?>

	<div class="row mb-4">
		<div class="col form-group">
			<label for="calcado" class="col-form-label">Calçado:</label>
			<select id="calcado" class="form-control" name="calcado">
				<option>-- Selecione --</option>

				<?php foreach( Calcado::listar() as $calcado ) : ?>
					<?php if ( isset( $producao ) && $calcado->get_codigo() === $producao->get_calcado()->get_codigo() ) : ?>
						<option selected="selected" value="<?= $calcado->get_codigo(); ?>"><?= $calcado->get_nome(); ?></option>
					<?php else : ?>
						<option value="<?= $calcado->get_codigo(); ?>"><?= $calcado->get_nome(); ?></option>
					<?php endif; ?>
				<?php endforeach; ?>
			</select>
		</div>

		<div class="col">
			<label for="tamanho" class="col-form-label">Tamanho:</label>
			<input type="number" class="form-control" id="tamanho" name="tamanho" value="<?= isset( $producao ) ? $producao->get_tamanho() : ''; ?>">
		</div>

		<div class="col">
			<label for="quantidade" class="col-form-label">Quantidade:</label>
			<input type="number" class="form-control" id="quantidade" name="quantidade" value="<?= isset( $producao ) ? $producao->get_tamanho() : ''; ?>">
		</div>

		<div class="col">
			<label for="data_producao" class="col-form-label">Data de produção:</label>
			<input type="date" class="form-control" id="data_producao" name="data_producao" value="<?= isset( $producao ) ? $producao->get_data_producao() : ''; ?>">
		</div>

		<div class="col form-group">
			<label for="situacao" class="col-form-label">Situação:</label>

			<select id="situacao" class="form-control" name="situacao">
				<?php foreach( SituacaoProducao::listar() as $codigo => $nome ) : ?>
					<?php if ( isset( $producao ) && $codigo === $producao->get_situacao() ) : ?>
						<option selected="selected" value="<?= $codigo; ?>"><?= $nome; ?></option>
					<?php else : ?>
						<option value="<?= $codigo; ?>"><?= $nome; ?></option>
					<?php endif; ?>
				<?php endforeach; ?>
			</select>
		</div>

		<div class="col">
			<label for="producao" class="col-form-label text-muted">Confirmar:</label>

			<?php if ( isset( $producao ) ) : ?>
				<button type="submit" class="btn btn-warning btn-block">Alterar</button>
			<?php else : ?>
				<button type="submit" class="btn btn-success btn-block">Nova produção</button>
			<?php endif; ?>
		</div>
	</div><!-- .row -->
</form>

<div class="row">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th width="40%">Calçado</th>
				<th width="10%" class="text-center">Tamanho</th>
				<th width="10%" class="text-center">Quantidade</th>
				<th width="10%" class="text-center">Data de produção</th>
				<th width="10%" class="text-center">Situação</th>
				<th width="20%" class="text-center">Ações</th>
			</tr>
		</thead>
		<tbody>
			<?php if ( empty( $producoes ) ) : ?>
				<tr>
					<td colspan="6" class="text-center h5 text-muted">Nenhuma produção cadastrada</td>
				</tr>
			<?php else : ?>
				<?php foreach ($producoes as $producao) : $calcado = $producao->get_calcado(); ?>
					<tr>
						<td>
							<div class="calcado-imagem" style="background-image: url('<?= $calcado->get_imagem_url(); ?>');"></div>
							
							<strong class="calcado-nome"><?= $calcado->get_nome(); ?></strong><br>

							<div>
								<span class="text-muted">COLEÇÃO:</span>
								<strong><?= $calcado->get_colecao()->get_nome(); ?></strong>

								<span class="text-muted ml-4">COR:</span>
								<span class="calcado-cor" style="background-color: #<?= $calcado->get_cor(); ?>"></span>
							</div>
						</td>
						<td class="text-center"><?= $producao->get_tamanho(); ?></td>
						<td class="text-center"><?= $producao->get_quantidade(); ?></td>
						<td class="text-center"><?= formatar_data( $producao->get_data_producao() ); ?></td>
						<td class="text-center"><?= SituacaoProducao::get_nome( $producao->get_situacao() ); ?></td>
						<td class="text-center">
							<a href="?codigo=<?= $producao->get_codigo(); ?>" class="btn btn-info mb-1">Editar</a>
							<button type="button" class="btn btn-danger mb-1" data-toggle="modal" data-target="#modal-producao-remover-<?= $producao->get_codigo(); ?>">Remover</button>

							<?php require 'modal-remover.php'; ?>
						</td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
		</tbody>
	</table>
</div><!-- .row -->

<?php

part( 'footer' );