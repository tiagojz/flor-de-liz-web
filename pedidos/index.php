 <?php

require_once '../inc/init.php';

part( 'header' );

?>

<div class="row mb-4">
	<div class="col">
		<h2>Pedidos</h2>
	</div>
</div><!-- .row -->

<div class="row">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th width="40%">Calçado</th>
				<th width="10%">Tamanho</th>
				<th width="10%">Quantidade</th>
				<th width="10%">Data de produção</th>
				<th width="10%">Situação</th>
				<th width="20%">Ações</th>
			</tr>
		</thead>
		<tbody>

			<tr>
				<td colspan="6" class="text-center h5 text-muted">Nenhum pedido realizado</td>
			</tr>

		</tbody>
	</table>
</div><!-- .row -->

<?php

part( 'footer' );