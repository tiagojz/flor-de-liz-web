<?php

require_once '../inc/init.php';

$calcados = Calcado::listar();

part( 'header' );

?>

<div class="row mb-4">
	<div class="col-md-9">
		<h2>Calçados</h2>
	</div>

	<div class="col-md-3">
		<button type="button" class="btn btn-success btn-block btn-lg" data-toggle="modal" data-target="#modal-calcado-novo">Novo calçado</button>
	</div>
</div><!-- .row -->

<div class="row">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th width="50%">Calçado</th>
				<th width="15%" class="text-center">Tamanho</th>
				<th width="15%" class="text-right">Valor</th>
				<th width="20%" class="text-center">Ações</th>
			</tr>
		</thead>
		<tbody>
			<?php if ( empty( $calcados ) ) : ?>
				<tr>
					<td colspan="4" class="text-center h5 text-muted">Nenhum calçado cadastrado</td>
				</tr>
			<?php else : ?>
				<?php foreach ($calcados as $calcado) : ?>
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
						<td class="text-center"><?= "{$calcado->get_menor_tamanho()} - {$calcado->get_maior_tamanho()}"; ?></td>
						<td class="text-right"><?= price( $calcado->get_valor() ); ?></td>
						<td class="text-center">
							<button type="button" class="btn btn-info mb-1" data-toggle="modal" data-target="#modal-calcado-editar-<?= $calcado->get_codigo(); ?>">Editar</button>
							<button type="button" class="btn btn-danger mb-1" data-toggle="modal" data-target="#modal-calcado-remover-<?= $calcado->get_codigo(); ?>">Remover</button>

							<?php require 'modal-editar.php'; ?>
							<?php require 'modal-remover.php'; ?>
						</td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
		</tbody>
	</table>
</div><!-- .row -->

<?php

require 'modal-novo.php';

part( 'footer' );