 <?php

require_once '../inc/init.php';

$lista = Estoque::listar();

part( 'header' );

?>

<div class="row mb-4">
	<div class="col">
		<h2>Estoque</h2>
	</div>
</div><!-- .row -->

<div class="row">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th width="40%">Calçado</th>
				<th width="8%" class="text-center">Tamanho</th>
				<th width="8%" class="text-center">Solicitado</th>
				<th width="8%" class="text-center">Em produção</th>
				<th width="8%" class="text-center">Produzido</th>
				<th width="8%" class="text-center">Cancelado</th>
				<th width="8%" class="text-center">Entregue</th>
				<th width="8%" class="text-center">Saldo</th>
			</tr>
		</thead>
		<tbody>

			<?php if ( empty( $lista ) ) : ?>
				<tr>
					<td colspan="4" class="text-center h5 text-muted">Nenhum produto em com movimentação de estoque</td>
				</tr>
			<?php else : ?>
				<?php foreach ($lista as $estoque) : $calcado = $estoque->get_calcado(); ?>
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
						<td class="text-center"><?= $estoque->get_tamanho() == 0 ? '' : $estoque->get_tamanho(); ?></td>
						<td class="text-center"><?= $estoque->get_solicitado() == 0 ? '' : $estoque->get_solicitado(); ?></td>
						<td class="text-center"><?= $estoque->get_em_producao() == 0 ? '' : $estoque->get_em_producao(); ?></td>
						<td class="text-center"><?= $estoque->get_produzido() == 0 ? '' : $estoque->get_produzido(); ?></td>
						<td class="text-center"><?= $estoque->get_cancelado() == 0 ? '' : $estoque->get_cancelado(); ?></td>
						<td class="text-center"></td>
						<td class="text-center font-weight-bold"><?= $estoque->get_saldo(); ?></td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>

		</tbody>
	</table>
</div><!-- .row -->

<?php

part( 'footer' );