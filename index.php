<?php

require_once 'inc/init.php';

part( 'header' );

?>

<div class="row">
	<div class="col-md-4">
		<a class="card-link" href="<?= HOME_URL . '/calcados'; ?>">
			<div class="card card-home text-white bg-primary mb-4">
				<div class="card-body">
					<p class="card-number"><?= sizeof( Calcado::listar() ); ?></p>
					<h4 class="card-title">Calçados</h4>
				</div>
			</div>
		</a>
	</div>

	<div class="col-md-4">
		<a class="card-link" href="<?= HOME_URL . '/producao'; ?>">
			<div class="card card-home text-white bg-secondary mb-4">
				<div class="card-body">
					<p class="card-number"><?= sizeof( Producao::listar() ); ?></p>
					<h4 class="card-title">Ordens de produção</h4>
				</div>
			</div>
		</a>
	</div>

	<div class="col-md-4">
		<a class="card-link" href="<?= HOME_URL . '/clientes'; ?>">
			<div class="card card-home text-white bg-success mb-4">
				<div class="card-body">
					<p class="card-number"><?= sizeof( Cliente::listar() ); ?></p>
					<h4 class="card-title">Clientes</h4>
				</div>
			</div>
		</a>
	</div>

	<div class="col-md-4">
		<a class="card-link" href="<?= HOME_URL . '/pedidos'; ?>">
			<div class="card card-home text-white bg-danger mb-4">
				<div class="card-body">
					<p class="card-number">57</p>
					<h4 class="card-title">Pedidos</h4>
				</div>
			</div>
		</a>
	</div>

	<div class="col-md-4">
		<a class="card-link" href="<?= HOME_URL . '/entregas'; ?>">
			<div class="card card-home text-white bg-warning mb-4">
				<div class="card-body">
					<p class="card-number">18</p>
					<h4 class="card-title">Entregas</h4>
				</div>
			</div>
		</a>
	</div>

	<div class="col-md-4">
		<a class="card-link" href="<?= HOME_URL . '/estoque'; ?>">
			<div class="card card-home text-white bg-info mb-4">
				<div class="card-body">
					<p class="card-number">570</p>
					<h4 class="card-title">Estoque</h4>
				</div>
			</div>
		</a>
	</div>
</div><!-- .row -->

<?php

part( 'footer' );