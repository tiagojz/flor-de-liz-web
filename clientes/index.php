<?php

require_once '../inc/init.php';

$clientes = Cliente::listar();

part( 'header' );

?>

<div class="row mb-4">
	<div class="col-md-9">
		<h2>Clientes</h2>
	</div>

	<div class="col-md-3">
		<button type="button" class="btn btn-success btn-block btn-lg">Novo cliente</button>
	</div>
</div><!-- .row -->

<div class="row">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th width="5%" class="text-center">#</th>
				<th width="35%">Informações</th>
				<th width="15%">Telefone</th>
				<th width="25%">Endereço</th>
				<th width="20%" class="text-center">Ações</th>
			</tr>
		</thead>
		<tbody>
			<?php if ( empty( $clientes ) ) : ?>
				<tr>
					<td colspan="5" class="text-center h5 text-muted">Nenhum calçado cadastrado</td>
				</tr>
			<?php else : ?>
				<?php foreach ($clientes as $cliente) : ?>
					<tr>
						<td class="text-center"><?= $cliente->codigo; ?></td>
						<td>
							<div>
								<span class="text-muted">CLIENTE: </span>
								<strong><?= $cliente->nome_cliente; ?> </strong>

								<br>

								<span class="text-muted">CNPJ: </span>
								<strong><?= $cliente->cnpj_cliente; ?></strong>

								<br>

								<span class="text-muted">LOJA: </span>
								<strong><?= $cliente->nome_loja; ?> </strong>

								<br>

								<span class="text-muted">CPF PROPRIETÁRIO: </span>
								<strong><?= $cliente->cpf_proprietario_loja; ?></span>
							</div>
						</td>
						<td><?= $cliente->telefone_contato; ?></td>
						<td>
							<?= "{$cliente->logradouro}, {$cliente->numero}"; ?><br>
							<?= "{$cliente->bairro} - CEP {$cliente->cep}"; ?><br>
							<?php if ( ! empty( $cliente->complemento ) ): ?>
								<?= $cliente->complemento; ?><br>
							<?php endif; ?>
							<?= "{$cliente->cidade} - {$cliente->uf}"; ?>
						</td>
						<td class="text-center">
							<button type="button" class="btn btn-info mb-1">Editar</button>
							<button type="button" class="btn btn-danger mb-1">Remover</button>
						</td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
		</tbody>
	</table>
</div><!-- .row -->

<?php

part( 'footer' );