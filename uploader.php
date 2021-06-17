<?php
	require_once 'conexion.php';
	require_once "functions/functions.php";
	if(isset($_GET['action'])) {	
?>
		<?php if($_GET['action'] == 'showProm') {
			$promos = select_to("promociones","id_promocion,descripcion,foto");
			if (sizeof($promos) != 0) { ?>
				<div class="w-full">Todos<span class="text-grupo-red">(<?php echo count($promos) ?>)</span></div>
				<div class="hidden md:flex border-b border-grupo-red px-2 py-2 font-normal">
					<div class="w-1/4">promociones</div>
					<div class="w-auto">Foto</div>
				</div>
				<?php $contador = 0;
				foreach ($promos as $prom) { ?>
					<div class="product-item p-2">
						<div class="showItem flex flex-col md:flex-row items-center">
							<div class="w-full md:w-1/4 flex md:w-1/4 pr-2">
								<div class="md:hidden font-normal mr-4">Promociones</div>
								<?php echo $prom["descripcion"]; ?>
							</div>
							<div class="w-full flex md:flex-auto mb-4 md:mb-0">
								<div class="md:hidden font-normal mr-4">Foto</div>
								<?php echo $prom["foto"]; ?>
							</div>
							<div class="w-full md:w-auto relative text-grupo-red">
								<i class="absolute fa fa-pencil-alt top-2 left-2"></i>
								<input type="button" value="Editar" class="w-full button edit cursor-pointer hover:text-white bg-white hover:bg-red-400 border border-grupo-red py-1 pr-2 pl-6 rounded" />
							</div>
						</div>
						<div class="hidden hideItem">
							<form class="flex flex-col md:flex-row" id="multiform<?php echo $contador; ?>" enctype="multipart/form-data" method="POST">
								<input type="hidden" name="id" value="<?php echo $prom['id_promocion']; ?>">
								<input type="hidden" name="imagen" value="<?php echo $prom['foto']; ?>">
								<input type="hidden" name="opcion" value="opprom">
								<div class="w-full md:w-1/4 md:pr-2 flex">
									<div class="md:hidden font-normal mr-4 self-center">Promociones</div>
									<input type="text" name="descripcion" class="py-2 px-2 w-full border rounded" value="<?php echo $prom['descripcion']; ?>">
								</div>
								<div class="flex items-center mb-4 md:mb-0">
									<div class="md:hidden font-normal mr-4 self-center">Foto</div>
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
				<div class="product-example"><img src="images/promociones-bg.png" alt="" /></div>
			<?php } ?>
		<?php } ?>
		<?php if($_GET['action'] == 'showProd') {
			$products = select_to("productos","*");
			if (sizeof($products) != 0) { ?>
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
							<div class="w-full flex md:w-1/6 pr-2">
								<div class="md:hidden font-normal mr-4">Categoría</div>
								<?php $categories = select_to_where("categoria","categoria",array("id"=>$prod['categoria'])); ?>
								<?php foreach($categories as $cat) { echo $cat['categoria']; } ?>
							</div>
							<div class="w-full flex md:w-1/5 pr-2">
								<div class="md:hidden font-normal mr-4">Nombre</div>
								<?php echo $prod["nombre"]; ?>
							</div>
							<div class="w-full flex md:w-1/6 pr-2">
								<div class="md:hidden font-normal mr-4 self-center">Descripcion</div>
								<?php echo substr($prod["descripcion"],0,40); ?>...
							</div>
							<div class="w-full flex md:w-2/5 mb-4 md:mb-0">
								<div class="md:hidden font-normal mr-4">Foto</div>
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
								<div class="w-full md:w-1/5 pr-2 flex relative">
									<div class="md:hidden font-normal mr-4 self-center">Categoría</div>
									<i class="absolute fa fa-chevron-down top-3 right-3"></i>
									<select class="py-2 pl-2 pr-5 w-full border rounded" name="categoria">
										<?php $categories = select_to("categoria","id,categoria"); ?>
										<?php if(count($categories) > 0) {?>
											<?php foreach($categories as $cat) { ?>
												<option value="<?php echo $cat['id'];?>" <?php if($prod["categoria"] == $cat['id']){echo "selected";} ?>><?php echo $cat["categoria"];?></option>
											<?php } ?>
										<?php } ?>
									</select>
								</div>
								<div class="w-full md:w-1/5 pr-2 flex">
									<div class="md:hidden font-normal mr-4 self-center">Nombre</div>
									<input type="text" name="nombre" class="py-2 px-2 w-full border rounded" value="<?php echo $prod['nombre']; ?>">
								</div>
								<div class="w-full md:w-1/5 pr-2 flex">
									<div class="md:hidden font-normal mr-4 self-center">Descripcion</div>
									<input type="text" name="descripcion" class="py-2 px-2 w-full border rounded" value="<?php echo $prod['descripcion']; ?>">
								</div>
								<div class="flex pr-2 items-center mb-4 md:mb-0">
									<div class="md:hidden font-normal mr-4 self-center">Foto</div>
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
		<?php } ?>
		<?php if($_GET['action'] == 'showCat') {
			$categories = select_to("categoria","id,categoria,descripcion,foto");
			if (sizeof($categories) != 0) { ?>
				<div class="w-full">Todos<span class="text-grupo-red">(<?php echo count($categories) ?>)</span></div>
				<div class="hidden md:flex border-b border-grupo-red px-2 py-2 font-normal">
					<div class="w-1/4">Nombre</div>
					<div class="w-1/4">Descripcion</div>
					<div class="w-auto">Foto</div>
				</div>
				<?php $contador = 0;
				foreach($categories as $cat) { ?>
					<div class="product-item p-2">
						<div class="showItem flex flex-col md:flex-row items-center">
							<div class="w-full flex md:w-1/4 pr-2">
								<div class="md:hidden font-normal mr-4">Nombre</div>
								<?php echo $cat["categoria"]; ?>
							</div>
							<div class="w-full flex md:w-1/4 pr-2">
								<div class="md:hidden font-normal mr-4 self-center">Descripcion</div>
								<?php echo substr($cat["descripcion"],0,40); ?>...
							</div>
							<div class="w-full flex md:w-2/5 mb-4 md:mb-0">
								<div class="md:hidden font-normal mr-4">Foto</div>
								<?php echo $cat["foto"]; ?>
							</div>
							<div class="w-full md:w-auto relative text-grupo-red">
								<i class="absolute fa fa-pencil-alt top-2 left-2"></i>
								<input type="button" value="Editar" class="w-full button edit cursor-pointer hover:text-white bg-white hover:bg-red-400 border border-grupo-red py-1 pr-2 pl-6 rounded" />
							</div>
						</div>
						<div class="hidden hideItem">
							<form class="flex flex-col md:flex-row" id="multiform<?php echo $contador; ?>" enctype="multipart/form-data" method="POST">
								<input type="hidden" name="id" value="<?php echo $cat['id']; ?>">
								<input type="hidden" name="imagen" value="<?php echo $cat['foto']; ?>">
								<input type="hidden" name="opcion" value="opcat">
								<div class="w-full md:w-1/4 pr-2 flex">
									<div class="md:hidden font-normal mr-4 self-center">Nombre</div>
									<input type="text" name="categoria" class="py-2 px-2 w-full border rounded" value="<?php echo $cat['categoria']; ?>">
								</div>
								<div class="w-full md:w-1/4 pr-2 flex">
									<div class="md:hidden font-normal mr-4 self-center">Descripcion</div>
									<textarea name="descripcion" class="py-2 px-2 w-full border rounded" rows='1'><?php echo $cat['descripcion']; ?></textarea>
								</div>
								<div class="flex pr-2 items-center mb-4 md:mb-0">
									<div class="md:hidden font-normal mr-4 self-center">Foto</div>
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
				<div><img src="images/categorias-bg.png" alt="" /></div>
			<?php } ?>
		<?php } ?>
	<?php } else {
		/***************************DEFINIR VALORES DE LA IMAGEN**********************************************************************/
		$name = $_FILES['image']['name'] = str_replace(" ", "", $_FILES['image']['name']); //quitar espaciados en el nombre de la imagen
		$type = $_FILES['image']['type']; //este es el tipo de archivo que acabas de subir
		$temporal = $_FILES['image']['tmp_name'];//este es donde esta almacenado el archivo que acabas de subir.
		$size = $_FILES['image']['size']; //este es el tamaño en bytes que tiene el archivo que acabas de subir.
		$error = $_FILES['image']['error']; //este almacena el codigo de error que resultaría en la subida.
		//image es el nombre del input tipo file del formulario.
		$opcion = $_POST["opcion"];
		if(isset($_POST['nombre'])) {
			$nom_prod =	$_POST["nombre"];
		}
		if(isset($_POST['categoria'])) {
			$categoria = $_POST["categoria"];
		}
		if(isset($_POST['descripcion'])) {
			$det_prod = $_POST["descripcion"];
		} else {
			$det_prod = NULL;
		}
		switch ($opcion) {
		case "opcat":
			$consulta = 1;
			$destino =	dirname(__FILE__).'/images/categorias/'.$name;
			break;
		case "opprod":
			$consulta = 2;
			$destino =	dirname(__FILE__).'/images/productos/'.$name;
			break;
		case "opprom":
			$consulta = 3;
			$destino =	dirname(__FILE__).'/images/promociones/'.$name;
			break;
		}
		$types = array("video/mp4","image/jpg","image/jpeg","image/gif","image/png"); // archivos extension
		if ($type == "video/mp4" ){
			$limite_kb = $size;
		} else {
			$limite_kb = 5120;
		}

		/***********************************COMPROBAMOS SI HA OCURRIDO UN ERROR*******************************************************/
		if ($error > 0) {
			echo "error";
		} else {
			/***********VERIFICAMOS SI EL TIPO DE IMAGEN ES PERMITIDA Y SI EL TAMAÑO DE LA IMAGEN NO EXCEDE LOS 5MB********************/
			if (in_array($type, $types) && $size <= $limite_kb*1020) {
				if(isset($_FILES['image'])) {
					/**********************COMPROBAMOS SI EXISTE UN ARCHIVO CON EL MISMO NOMBRE******************************************/
					if (!file_exists($destino)) {
						//aqui movemos el archivo desde la ruta temporal a nuestra ruta
						//usamos la variable $resultado para almacenar el resultado del proceso de mover el archivo
						//almacenara true o false
						// @move_uploaded_file($temporal, $destino); se antepone el @ para ocultar los mensajes de error
						$resultado = move_uploaded_file($temporal, $destino);
						if ($resultado) {	
							if ($consulta == 1) {
								$campos = array("categoria","descripcion","foto");
								$values = array($nom_prod,$det_prod,$name);
								insert_into("categoria",$campos,$values);
							}
							if ($consulta == 2) {
								$campos = array("nombre","descripcion","categoria","foto", "precio");
								$values = array($nom_prod,$det_prod,$categoria,$name, 0.00);
								insert_into("productos",$campos,$values);
							}
							if ($consulta == 3) {
								$campos = array("descripcion","foto");
								$values = array($nom_prod,$name);
								insert_into("promociones",$campos,$values);
							}
							/**************VARIABLES PARA BAJAR EL PESO DE LA IMAGEN UNA VES SUBIDA AL SERVIDOR******************/

							$ruta_imagen = $destino;
							$info_imagen = getimagesize($ruta_imagen);
							$ancho = $info_imagen[0];
							$alto = $info_imagen[1];
							$imagen_tipo = $info_imagen['mime'];
							echo "subido exitosamente";
						}
					} else {
						echo $name . ", este archivo existe";
					}
				}
			} else {
				echo "archivo no permitido(solo jpg, jpeg, gif, png y mp4) o excede el tamano de $limite_kb Kilobytes";
			}
		}
	}
?>