<?php
	session_start();
	ini_set("display_errors", true);

	if(!isset($_SESSION['s_user'])) {
		// Usuario que no se ha logueado
		echo "No tienes permiso para entrar a esta pagina";
		echo ("<script type='text/javascript'>
			setTimeout(function () {
		 	window.location.href= '../';
		},1000);
		</script>");
		exit();
	}
	require_once 'conexion.php';
	require_once "functions/functions.php";
	$products = select_to_order("productos","*","categoria");
?>
<!DOCTYPE HTML>
<html lang="es">
<head>
	<title>Grupo Idea - Productos</title>
	<?php include 'metas.php'; ?>
</head>
<body class="font-sans font-thin bg-gray-100">
	<?php include 'header-pass.php'; ?>
	<div class="result container mx-auto py-8 px-2">
		<div class="flex">
			<h2 class="text-2xl font-normal">Productos</h2>
			<div class="w-full flex justify-end">
				<div class="relative cursor-pointer">
					<i class="absolute text-white fa fa-plus top-3 left-2"></i>
					<input type="button" id="addProducts" data-nombre-modal="ProductsModal" value="Agregar Nuevo" class="ModalEvent cursor-pointer bg-grupo-red hover:bg-red-400 text-white py-2 pr-4 pl-8 rounded" />
				</div>
			</div>
		</div>
		<div id="fotos">
			<?php if (sizeof($products) != 0) { ?>
				<div class="w-full">Todos<span class="text-grupo-red">(<?php echo count($products) ?>)</span></div>
				<div class="hidden md:flex border-b border-grupo-red px-2 py-2 font-normal">
					<div class="w-1/6">Categoría</div>
					<div class="w-1/5">Nombre</div>
					<div class="w-1/6">Descripcion</div>
					<div class="w-auto">Foto</div>
				</div>
				<?php $contador = 0;
				foreach ($products as $prod) { ?>
					<div class="product-item p-2">
						<div class="showItem flex flex-col md:flex-row items-center">
							<div class="w-full flex md:w-1/6 md:pr-2">
								<div class="md:hidden w-1/4 font-normal mr-2">Categoría</div>
								<?php $categories = select_to_where("categoria","categoria",array("id"=>$prod['categoria'])); ?>
								<?php foreach($categories as $cat) { echo $cat['categoria']; } ?>
							</div>
							<div class="w-full flex md:w-1/5 md:pr-2">
								<div class="md:hidden w-1/4 font-normal mr-2">Nombre</div>
								<?php echo $prod["nombre"]; ?>
							</div>
							<div class="w-full flex md:w-1/6 md:pr-2">
								<div class="md:hidden w-1/4 font-normal mr-2">Descripcion</div>
								<?php echo substr($prod["descripcion"],0,40); ?>...
							</div>
							<div class="w-full flex md:w-2/5 mb-4 md:mb-0">
								<div class="md:hidden w-1/4 font-normal mr-2">Foto</div>
								<?php echo $prod["foto"]; ?>
							</div>
							<div class="w-full md:w-auto relative text-grupo-red">
								<i class="absolute fa fa-pencil-alt top-2 left-2"></i>
								<input type="button" value="Editar" class="w-full button edit cursor-pointer hover:text-white bg-white hover:bg-red-400 border border-grupo-red py-1 pr-2 pl-6 rounded" />
							</div>
						</div>
						<div class="hidden hideItem">
							<form class="flex flex-col md:flex-row" id="multiform<?php echo $contador; ?>" enctype="multipart/form-data" method="POST">
								<input type="hidden" name="id" value="<?php echo $prod['id']; ?>">
								<input type="hidden" name="imagen" value="<?php echo $prod['foto']; ?>">
								<input type="hidden" name="opcion" value="opprod">
								<div class="w-full md:w-1/5 md:pr-2 flex relative">
									<div class="md:hidden w-1/4 font-normal mr-2 self-center">Categoría</div>
									<i class="absolute fa fa-chevron-down top-3 right-3"></i>
									<select class="py-2 pl-2 pr-5 w-full border rounded" name="categoria">
										<?php $categories = select_to("categoria","id,categoria"); ?>
										<?php if(count($categories)>0) {?>
											<?php foreach($categories as $cat) { ?>
												<option value="<?php echo $cat['id'];?>" <?php if($prod["categoria"] == $cat['id']){echo "selected";} ?>><?php echo $cat["categoria"];?></option>
											<?php } ?>
										<?php } ?>
									</select>
								</div>
								<div class="w-full md:w-1/5 md:pr-2 flex">
									<div class="md:hidden w-1/4 font-normal mr-2 self-center">Nombre</div>
									<input type="text" name="nombre" class="py-2 px-2 w-full border rounded" value="<?php echo $prod['nombre']; ?>">
								</div>
								<div class="w-full md:w-1/5 md:pr-2 flex">
									<div class="md:hidden w-1/4 font-normal mr-2">Descripcion</div>
									<input type="text" name="descripcion" class="py-2 px-2 w-full border rounded" value="<?php echo $prod['descripcion']; ?>">
								</div>
								<div class="flex md:pr-2 items-center mb-4 md:mb-0">
									<div class="md:hidden w-1/4 font-normal mr-2 self-center">Foto</div>
									<input type="file" class="py-1 px-2 w-full border rounded" name="image"/>
								</div>
								<div class="flex flex-auto items-center justify-center md:justify-end">
									<div class="relative text-grupo-red mr-1">
										<i class="absolute fa fa-trash-alt top-2 left-2"></i>
										<input type="submit" value="Eliminar" class="button delete cursor-pointer hover:text-white bg-white hover:bg-red-400 border border-grupo-red py-1 pr-2 pl-6 rounded" />
									</div>
									<div class="relative text-grupo-red mr-1">
										<i class="absolute fa fa-check top-2 left-2"></i>
										<input type="submit" value="Guardar" class="button save cursor-pointer hover:text-white bg-white hover:bg-red-400 border border-grupo-red py-1 pr-2 pl-6 rounded" />
									</div>
									<div class="relative text-grupo-red">
										<i class="absolute fa fa-ban top-2 left-2"></i>
										<input type="button" value="Cancelar" class="button cancel cursor-pointer hover:text-white bg-white hover:bg-red-400 border border-grupo-red py-1 pr-2 pl-6 rounded" />
									</div>
								</div>
							</form>
						</div>
					</div>
					<?php $contador++;
				}
			} else { ?>
				<div><img src="images/productos-bg.png" alt="" /></div>
			<?php } ?>
		</div>
	</div>
	<div id="Modal"></div>
	<div id="overlayAlert"></div>
	<div class="spinner">
		<div class="dot1"></div>
		<div class="dot2"></div>
	</div>
	<!--scripts-->
	<script src="assets/js/functions.js"></script>
	<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js"></script>
  <script src="https://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
	<script type='text/javascript' language='javascript'>
	$( document ).ready(function() {
		$("#salir").on("click", function() {
			exit();
		});

		//Mostrar Modal
		$(".ModalEvent").click(function(e) {
			var idModal = $(this).attr("id");
			var name = $(this).data("nombre-modal");
			var data = { 
				action:"form",
				message: null,
				id: idModal,
				name: name,
				uploadOp: "showProd",
				operation: { type: "hidden", name: "opcion", value: "opprod" },
				category: { type: "select", name: "categoria", id: "category", query: "category_id != 0" },
				opName: { type: "text", name: "nombre", id: "name", place: "nombre del producto" },
				description: { type: "textarea", name: "descripcion", id: "description", place: "descripción del producto" }
			};
			showModal(data);
			e.preventDefault();
		});
		//Cerrar Modal
		$(document).on('click', "[data-overlay]", function() {
			var id = $(this).attr("id");
			var modal = $(this).prev(".modal").attr("id");
			var form = $("#"+modal).find("form").attr("id");
			hideModal(id,modal,form);
		});
		$("#fotos").on("click", ".button.edit", function(e) {
			var mostrar = $(this).closest(".product-item").find(".showItem");
			var ocultar = $(this).closest(".product-item").find(".hideItem");
			$(mostrar).hide("slow");
			$(ocultar).show("slow");
			e.preventDefault();
		});
		$("#fotos").on("click", ".button.cancel", function(e) {
			var mostrar = $(this).closest(".product-item").find(".showItem");
			var ocultar = $(this).closest(".product-item").find(".hideItem");
			$(mostrar).show("slow");
			$(ocultar).hide("slow");
			e.preventDefault();
		});
		$("#fotos").on("click", ".button.delete", function() {
			var button = $(this);
			var form = $(this).closest("form");
			var allButtons = $(form).find(".button");
			$(form).submit(function(e)
			{
				var formData = new FormData(this);
				$.ajax(
				{
					type: 'POST',
					url: "update.php?action=deleteProd",
					data:  formData,
					mimeType:"multipart/form-data",
					contentType: false,
					cache: false,
					processData:false,
					beforeSend: function()
					{
						//$(button).prev("i").removeClass("icon fa-trash-o");
						//$(button).prev("i").addClass("icon-spinner icon-spin");
						$(button).val("Eliminando...");
						$(allButtons).attr('disabled', 'disabled');
						$(allButtons).addClass('opacity-50');
						$(allButtons).addClass('cursor-not-allowed');
						$(allButtons).removeClass('hover:bg-red-400');
						$(allButtons).removeClass('hover:text-white');
					},
					success: function(data, textStatus, jqXHR)
					{
						$("#fotos").load("uploader.php?action=showProd");
						//console.log(data);
						//console.log(textStatus);
						//console.log(jqXHR);
					}
			});
				e.preventDefault();
			});
		});
		$("#fotos").on("click", ".button.save", function() {
			var button = $(this);
			var form = $(this).closest("form");
			var allButtons = $(form).find(".button");
			$(form).submit(function(e)
			{
				var formData = new FormData(this);
				$.ajax(
				{
					type: 'POST',
					url: "update.php?action=update",
					data:  formData,
					mimeType:"multipart/form-data",
					contentType: false,
					cache: false,
					processData:false,
					beforeSend: function()
					{
						//$(button).prev("i").removeClass("icon fa-trash-o");
						//$(button).prev("i").addClass("icon-spinner icon-spin");
						$(button).val("Guardando...");
						$(allButtons).attr('disabled', 'disabled');
						$(allButtons).addClass('opacity-50');
						$(allButtons).addClass('cursor-not-allowed');
						$(allButtons).removeClass('hover:bg-red-400');
						$(allButtons).removeClass('hover:text-white');
					},
					success: function(data, textStatus, jqXHR)
					{
						$("#fotos").load("uploader.php?action=showProd");
						//console.log(data);
						//console.log(textStatus);
						//console.log(jqXHR);
					}
			});
				e.preventDefault();
			});
		});
	});
	</script>
</body>
</html>
