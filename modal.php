<?php
require_once "conexion.php";
require_once "functions/functions.php";
if($_GET['action'] == 'form') {
	$id = $_POST['id'];
	$name = $_POST['name'];
	$uploadOp = $_POST['uploadOp'];
	$operation = $_POST['operation'];
	$opName = $_POST['opName'];
	if (isset($_POST['slug'])) {
		$slug = $_POST['slug'];
	}
	if (isset($_POST['description'])) {
		$description = $_POST['description'];
	}
	if (isset($_POST['category'])) {
		$category = $_POST['category'];
		$categories = select_to("categoria","id,categoria");
	}
?>
	<div id="<?php echo $name; ?>" class="modal">
		<h2 class="text-lg"><strong>Agregar</strong></h2>
		<div class="modal-content pt-6 pb-8 px-4 bg-white">
			<form id="multiform-<?php echo $id; ?>" enctype="multipart/form-data" method="POST" data-upload="<?php echo $uploadOp; ?>">
				<div class="lex flex-col text-grupo-gray">
					<input type="<?php echo $operation['type']; ?>" name="<?php echo $operation['name']; ?>" value="<?php echo $operation['value']; ?>">
					<?php if (isset($category)) { ?>
						<div class="w-full mb-4 relative">
							<i class="absolute fa fa-chevron-down top-3 right-3"></i>
							<select class="py-2 pl-2 pr-6 w-full border rounded" name="<?php echo $category['name']; ?>" id="<?php echo $category['id']; ?>">
								<option value="" disabled selected>-Elige-</option>
								<?php if(count($categories) > 0) {?>
									<?php foreach($categories as $cat) {?>
										<option value="<?php echo $cat["id"];?>"><?php echo $cat["categoria"];?></option>
									<?php } ?>
								<?php } ?>
							</select>
						</div>
					<?php } ?>
					<?php if (isset($opName)) { ?>
						<div class="w-full mb-4">
							<input class="py-2 px-2 w-full border rounded" type="text" placeholder="<?php echo $opName['place']; ?>" id="<?php echo $opName['id']; ?>" name="<?php echo $opName['name']; ?>" />
						</div>
					<?php } ?>
					<?php if (isset($slug)) { ?>
						<div class="w-full mb-4">
							<input class="py-2 px-2 w-full border rounded" type="text" placeholder="<?php echo $slug['place']; ?>" id="<?php echo $slug['id']; ?>" name="<?php echo $slug['name']; ?>" />
						</div>
					<?php } ?>
					<?php if (isset($description)) { ?>
						<div class="w-full mb-4">
							<?php switch($description["type"]) {
								case "text":
									echo "<input type='text' class='py-2 px-2 w-full border rounded' placeholder='".$description['place']."' id='".$description['id']."' name='".$description['name']."' />";
								break;
								case "textarea":
									echo "<textarea class='py-2 px-2 w-full border rounded' placeholder='".$description['place']."' id='".$description['id']."' name='".$description['name']."' rows='6'></textarea>";
								break;
							}?>
						</div>
					<?php } ?>
					<div class="w-full mb-4">
						<input class="py-1 px-2 w-full border rounded" type="file" id="file" name="image" />
					</div>
					<div class="w-full">
						<div class="relative">
							<i class="absolute text-white fa fa-upload top-3 left-2"></i>
							<input type="submit" id="subir" value="Subir" class="bg-grupo-red hover:bg-red-400 text-white py-2 pr-4 pl-8 rounded" />
						</div>
					</div>
					<div id="ok"></div>
				</div>
			</form>
		</div>
	</div>
	<div id="overlay<?php echo $id; ?>" data-overlay></div>
<?php } ?>
<?php if($_GET['action'] == 'alert') { ?>
	<?php $message = $_POST['message']; ?>
	<div id="alertMsg" class="modal">
		<h2>Alert</h2>
		<div class="modal-content pt-6 pb-8 px-4 bg-white">
			<div class="row">
				<div class="12u$">				
					<p><?php echo $message; ?></p>
					<ul class="actions">
						<li><a href="#" id="accept" class="button special icon fa-check-circle">Aceptar</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
<?php if($_GET['action'] == 'image') { ?>
	<?php $image = $_POST['image']; ?>
	<?php $label = $_POST['label']; ?>
	<div id="ProductoImage" class="modal image">
		<div class="modal-content pt-6 pb-8 px-4 bg-white">
			<div class="flex flex-col">
				<img class="w-full" src="../../images/productos/<?php echo $image ?>" alt="" onerror="this.onerror=null;this.src='images/no-image.jpg';">
				<span><?php echo $label; ?></span>
			</div>
		</div>
	</div>
<?php } ?>
<script type='text/javascript' language='javascript'>
$( document ).ready(function() {
	$("#ok").hide();

	$('#file').click(function() {
		$("#ok").hide();
	});

	$('#category').change(function() {
		$("#ok").hide();
	});

	$('#name').keypress(function() {
		$("#ok").hide();
	});

	$('#description').keypress(function() {
		$("#ok").hide();
	});

	$('form').each(function () {
		$(this).validate({
			rules: {
				categoria: { required:true },
				nombre: { required:true, minlength: 2},
				slug: { required:true, minlength: 2, pattern: "^[a-zA-Z_-]*$",},
				descripcion: { required:true, minlength: 2},
				image: { required:true, accept: "image/*, video/*"}
			},
			messages: {
				categoria: "Debe seleccionar una categoría",
				nombre: "Debe introducir un nombre",
				slug: "Debe introducir una ruta sin numeros",
				descripcion: "Debe introducir una descripcion",
				image: "Debe subir una imagen"
			},
			submitHandler: function(form){
				var id = this.currentForm.id;
				var action = this.currentForm.dataset.upload;
				var postData = $("#"+id).serializeArray();
				var formData = new FormData($("#"+id)[0]);
				//Test FormData
				/* for (var pair of formData.entries()) {
					console.log(pair[0]+ ', ' + pair[1]); 
				}*/
				$.ajax({
					type: 'POST',
					url: "uploader.php",
					data:  formData,
					mimeType:"multipart/form-data",
					contentType: false,
					cache: false,
					processData:false,
					beforeSend: function()
					{
						$('#subir').val("cargando...");
						$('#subir').addClass("disabled");
					},
					success: function(data, textStatus, jqXHR)
					{
						if(data == 'error') {
							$('#ok').html("ha ocurrido un error con la imagen");
							$("#ok").show();
							$('#subir').removeClass("disabled");
							$('#subir').val("subir");
							console.log(data);
							//console.log(textStatus);
							console.log(jqXHR);
						}
						else {
							$('#ok').html(data);
							$('#ok').show();
							$('#'+id)[0].reset();
							$('#subir').removeClass("disabled");
							$('#subir').val("subir");
							$('#fotos').load("uploader.php?action="+action);
							console.log(data);
							//console.log(textStatus);
							console.log(jqXHR);
						}
					}
				});
			}
		});
	});
});
</script>