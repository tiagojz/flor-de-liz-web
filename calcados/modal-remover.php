<div class="modal fade" id="modal-calcado-remover-<?= $calcado->get_codigo(); ?>" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<form action="remover.php" method="post">
			<input type="hidden" name="codigo" value="<?= $calcado->get_codigo(); ?>" />

			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Remover calçado</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<div class="modal-body">
					<p>Deseja realmente remover este calçado?</p>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-danger">Remover</button>
				</div>
			</div><!-- .modal-content -->
		</form>
	</div><!-- .modal-dialog -->
</div><!-- .modal -->