


<!DOCTYPE html>
<html lang="en">
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="UTF-8">
	<title></title>
	<?php require_once "scripts.php";  ?>
</head>

 
		<body>
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="card text-left">
							<div class="card-header">
								
							Tabla dinamicas PHP
							</div>
							<div class="card-body">
								<span class="btn btn-primary" data-toggle="modal" data-target="#agregarmodal">
									Agregar nuevo <span class="fa fa-plus-circle"></span>
								</span>
								<hr>
								<div id="tablaDatatable"></div>
							</div>
							<div class="card-footer text-muted">
								By VICTOR AVILES
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Modal -->
			<div class="modal fade" id="agregarmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Agrega  juego</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form id="frmnuevo">
								<label>Nombre</label>
								<input type="text" class="form-control input-sm" id="nombre" name="nombre">
								<label>Año</label>
								<input type="text" class="form-control input-sm" id="anio" name="anio">
								<label>Empresa</label>
								<input type="text" class="form-control input-sm" id="empresa" name="empresa">
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
							<button type="button" id="Agregarnuevo" class="btn btn-primary">Agregar nuevo</button>
						</div>
					</div>
				</div>
			</div>


			<!-- Modal -->
				<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Actualizar juego</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form id="nuevoFr">

									<input type="text" hidden="" id="idjuego" name="idjuego">
									<label>Nombre</label>
									<input type="text" class="form-control input-sm" id="nombreU" name="nombreU">
									<label>Año</label>
									<input type="text" class="form-control input-sm" id="anioU" name="anioU">
									<label>Empresa</label>
									<input type="text" class="form-control input-sm" id="empresaU" name="empresaU">

								</form>
							</div>
							<div class="modal-footer">

							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
							<button type="button" class="btn btn-warning" id="Actualizar">Actualizar</button>

						</div>
					</div>
				</div>
			</div>


		</body>

		</html>


		<script type="text/javascript">



	$(document).ready(function() {
				$('#Agregarnuevo').click(function() {

					datos = $('#frmnuevo').serialize();

					$.ajax({


						type: "POST",
						data: datos,
						url: "procesos/agregar.php",
						success: function(r) {
							if (r == 1) {
								$('#frmnuevo')[0].reset();
								$('#tablaDatatable').load('tabla.php');
								alertify.success("Agregado");
							} else {
								alertify.error("Fallo ");
							}
						}
					});
				});
				

	$('#Actualizar').click(function() {
					datos = $('#nuevoFr').serialize();

					$.ajax({
						type: "POST",
						data: datos,
						url: "procesos/actualizar.php",
						success: function(r) {
							if (r == 1) {
								$('#tablaDatatable').load('tabla.php');
								alertify.success("Actualizado ");
							} else {
								alertify.error("Fallo ");
							}
						}
					});
				});
			});
		</script>


		<script type="text/javascript">
			$(document).ready(function() {
				$('#tablaDatatable').load('tabla.php');
			});
		</script>



		<script type="text/javascript">
			function agregaFrmActualizar(idjuego) {
				$.ajax({
					type: "POST",
					data: "idjuego=" + idjuego,
					url: "procesos/obtenDatos.php",
					success: function(r) {
						datos = jQuery.parseJSON(r);
						$('#idjuego').val(datos['id_juego']);
				$('#nombreU').val(datos['nombre']);
				$('#anioU').val(datos['anio']);
				$('#empresaU').val(datos['empresa']);
			}
		});
	}

	function eliminarDatos(idjuego) {



		alertify.confirm('Eliminar un juego', 'Seguro?', function() {

			$.ajax({
				type: "POST",
				data: "idjuego=" + idjuego,
				url: "procesos/eliminar.php",


					success: function(r) {
						if (r == 1) {
							$('#tablaDatatable').load('tabla.php');
							alertify.success("Eliminado ");
						} else {
							alertify.error("");
						}
					}
				});

			}, function() {

		});
	}
</script>