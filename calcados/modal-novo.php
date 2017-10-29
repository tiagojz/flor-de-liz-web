<div class="modal fade" id="modal-calcado-novo" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<form action="novo.php" method="post" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Novo calçado</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<div class="modal-body">

					<div class="form-group">
						<label for="nome" class="col-form-label">Nome:</label>
						<input type="text" class="form-control" id="nome" name="nome">
					</div>

					<div class="form-group">
						<label for="colecao" class="col-form-label">Coleção:</label>
						<select id="colecao" class="form-control" name="colecao">
							<option>-- Selecione --</option>

							<?php foreach( Colecao::listar() as $colecao ) : ?>
								<option value="<?= $colecao->get_codigo(); ?>"><?= $colecao->get_nome(); ?></option>
							<?php endforeach; ?>
						</select>
					</div>

					<div class="row">
						<div class="col">
							<label for="menor_tamanho" class="col-form-label">Menor tamanho:</label>
							<input type="number" class="form-control" id="menor_tamanho" name="menor_tamanho" value="34">
						</div>

						<div class="col">
							<label for="maior_tamanho" class="col-form-label">Maior tamanho:</label>
							<input type="number" class="form-control" id="maior_tamanho" name="maior_tamanho" value="39">
						</div>
					</div>

					<div class="row">
						<div class="col">
							<label for="cor" class="col-form-label">Cor:</label>

							<div class="input-group">
								<div class="input-group-addon">#</div>
								<input type="text" class="form-control" id="cor" name="cor" placeholder="FFFFFF" value="000000">
							</div>
						</div>

						<div class="col">
							<label for="valor" class="col-form-label">Valor:</label>

							<div class="input-group">
								<div class="input-group-addon">R$</div>
								<input type="number" class="form-control" id="valor" name="valor" min="0.00" step="0.01" placeholder="0,00">
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
					<button type="submit" class="btn btn-success">Salvar</button>
				</div>
			</div><!-- .modal-content -->
		</form>
	</div><!-- .modal-dialog -->
</div><!-- .modal -->