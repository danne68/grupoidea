<?php
	session_start();
	ini_set("display_errors", true);
	
	if(!isset($_SESSION['s_user']))
	{
	   // Usuario que no se ha logueado
		echo "No tienes permiso para entrar a esta pagina";
		echo ("<script type='text/javascript'>
		setTimeout(function () {
			window.location.href= 'index.php';
		},3000);
		</script>");
		exit();
	}
	require_once 'conexion.php';
	require_once "functions/functions.php";
	$categories = select_to("categoria","id,categoria,descripcion,foto");
?>
<!DOCTYPE HTML>
<html lang="es">
<head>
    <title>Grupo Idea - Categorias</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <meta name="description" content="">
    <meta name="author" content="">
	<link rel="shortcut icon" href="">
	<link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/1.6.0/tailwind.min.css" crossorigin="anonymous">
</head>
<body class="font-sans font-thin bg-gray-100">
	<?php include 'header-pass.php'; ?>
	<div class="result container mx-auto py-8 px-2">
		<div class="flex">
			<h2 class="text-2xl font-normal">Categorías</h2>
			<div class="w-full flex justify-center">
				<div class="relative cursor-pointer">
					<i class="absolute text-white fa fa-plus top-3 left-2"></i>
					<input type="button" id="addCategory" data-nombre-modal="CategoryModal" value="Agregar Nuevo" class="ModalEvent cursor-pointer bg-grupo-red hover:bg-red-400 text-white py-2 pr-4 pl-8 rounded" />
				</div>
			</div>
		</div>
		<div id="fotos">
			<?php if (sizeof($categories) != 0) { ?>
				<div class="w-full">Todos<span class="text-grupo-red">(<?php echo count($categories) ?>)</span></div>
				<div class="flex border-b border-grupo-red px-2 py-2 font-normal">
					<div class="w-1/4">Nombre</div>
					<div class="w-1/4">Descripcion</div>
					<div class="flex-auto">Foto</div>
				</div>
				<?php $contador = 0;
				foreach($categories as $cat) { ?>
					<div class="product-item p-2">
						<div class="showItem flex items-center">
							<div class="w-1/4 pr-2"><?php echo $cat["categoria"]; ?></div>
							<div class="w-1/4 pr-2"><?php echo substr($cat["descripcion"],0,40); ?>...</div>
							<div class="flex-auto"><?php echo $cat["foto"]; ?></div>
							<div class="relative text-grupo-red">
								<i class="absolute fa fa-pencil top-2 left-2"></i>
								<input type="button" value="Editar" class="button edit cursor-pointer hover:text-white bg-white hover:bg-red-400 border border-grupo-red py-1 pr-2 pl-6 rounded" />
							</div>
						</div>
						<div class="hidden hideItem">
							<form class="flex" id="multiform<?php echo $contador; ?>" enctype="multipart/form-data" method="POST">
								<input type="hidden" name="id" value="<?php echo $cat['id']; ?>">
								<input type="hidden" name="imagen" value="<?php echo $cat['foto']; ?>">
								<input type="hidden" name="opcion" value="opcat">
								<div class="w-1/4 pr-2">
									<input type="text" name="categoria" class="py-2 px-2 w-full border rounded" value="<?php echo $cat['categoria']; ?>">
								</div>
								<div class="w-1/4 pr-2 flex">
									<textarea name="descripcion" class="py-2 px-2 w-full border rounded" rows='1'><?php echo $cat['descripcion']; ?></textarea>
								</div>
								<div class="flex pr-2 items-center">
									<input type="file" class="py-1 px-2 w-full border rounded" name="image"/>
								</div>
								<div class="flex flex-auto items-center justify-end">
									<div class="relative text-grupo-red mr-1">
										<i class="absolute fa fa-trash-o top-2 left-2"></i>
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
				<div><img src="images/categorias-bg.png" alt="" /></div>
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
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/functions.js"></script>
	<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js"></script>
    <script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
	<script type='text/javascript' language='javascript'>
	$( document ).ready(function() {
		$("#salir").on("click", function() {
			exit();
		});

		$(".ModalEvent").click(function(e){
			var idModal = $(this).attr("id");
			var name = $(this).data("nombre-modal");
			var data = { 
				action:"form",
				message: null,
				id: idModal,
				name: name,
				uploadOp: "showCat",
				operation: { type: "hidden", name: "opcion", value: "opcat" },
				opName: { type: "text", name: "nombre", id: "name", place: "nombre de la categoria" },
				description: { type: "textarea", name: "descripcion", id: "description", place: "descripción de la categoria" }
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
					url: "update.php?action=deleteCat",
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
						$("#fotos").load("uploader.php?action=showCat");
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
			var forma = $(this).closest("form");
			var allButtons = $(forma).find(".button");
			$(forma).submit(function(e)
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
						$("#fotos").load("uploader.php?action=showCat");
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
