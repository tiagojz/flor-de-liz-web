<div class="modal fade" id="modal-calcado-editar-<?= $calcado->get_codigo(); ?>" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<form action="editar.php" method="post" enctype="multipart/form-data">
		<input type="hidden" name="codigo" value="<?= $calcado->get_codigo(); ?>" />

			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Editar calçado</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<div class="modal-body">

					<div class="form-group">
						<label for="nome" class="col-form-label">Nome:</label>
						<input type="text" class="form-control" id="nome" name="nome" value="<?= $calcado->get_nome(); ?>">
					</div>

					<div class="form-group">
						<label for="colecao" class="col-form-label">Coleção:</label>
						<select id="colecao" class="form-control" name="colecao">
							<option>-- Selecione --</option>
							
							<?php foreach( Colecao::listar() as $colecao ) : ?>
								<?php $select = $colecao->get_codigo() == $calcado->get_colecao()->get_codigo(); ?>
								<option <?= $select ? 'selected="selected"' : ''; ?>" value="<?= $colecao->get_codigo(); ?>">
									<?= $colecao->get_nome(); ?>
								</option>
							<?php endforeach; ?>
						</select>
					</div>

					<div class="row">
						<div class="col">
							<label for="menor_tamanho" class="col-form-label">Menor tamanho:</label>
							<input type="number" class="form-control" id="menor_tamanho" name="menor_tamanho" value="<?= $calcado->get_menor_tamanho(); ?>">
						</div>

						<div class="col">
							<label for="maior_tamanho" class="col-form-label">Maior tamanho:</label>
							<input type="number" class="form-control" id="maior_tamanho" name="maior_tamanho" value="<?= $calcado->get_maior_tamanho(); ?>">
						</div>
					</div>

					<div class="row">
						<div class="col">
							<label for="cor" class="col-form-label">Cor:</label>

							<div class="input-group">
								<div class="input-group-addon">#</div>
								<input type="text" class="form-control text-uppercase" id="cor" name="cor" placeholder="FFFFFF" value="<?= $calcado->get_cor(); ?>">
							</div>
						</div>

						<div class="col">
							<label for="valor" class="col-form-label">Valor:</label>

							<div class="input-group">
								<div class="input-group-addon">R$</div>
								<input type="number" class="form-control" id="valor" name="valor" min="0.00" step="0.01" placeholder="0,00" value="<?= $calcado->get_valor(); ?>">
							</div>
						</div>
					</div>

					<div class="form-group">
						<label for="imagem" class="col-form-label">Imagem:</label>
						<input type="file" class="form-control" id="imagem" name="imagem">
					</div>

				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-info">Salvar</button>
				</div>
			</div><!-- .modal-content -->
		</form>
	</div><!-- .modal-dialog -->
</div><!-- .modal -->