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
	$redes = select_to("redes","id,icon,name,link");
  $contact = select_to_where("sitio","id,descripcion,foto",array("id"=>1));
  $conRedes = count($redes);   
?>
<!DOCTYPE HTML>
<html lang="es">
<head>
    <title>Grupo Idea - Sitio</title>
    <?php include 'metas.php'; ?>
</head>
<body class="font-sans font-thin bg-gray-100">
	<?php include 'header-pass.php'; ?>
	<div class="container mx-auto py-8 px-2">
    <section class="mb-8">
      <h2 class="text-2xl font-normal">Redes Sociales</h2>
      <form class="siteChanges" name="social" id="multiformSocial" enctype="multipart/form-data" method="POST">
        <div class="p-2 flex flex-col md:flex-row">
          <?php 
            $contadorSocial = 0;
          ?>
          <?php foreach ($redes as $social) { ?>
            <div class="w-full md:w-1/4<?php if(++$contadorSocial != $conRedes) {?> md:pr-2<?php } ?> flex items-center">  
              <input type="hidden" name="id-<?php echo $social['name']; ?>" value="<?php echo $social['id']; ?>">
              <i class="fab fa-<?php echo $social["icon"]; ?> fa-lg hover:text-red-600 mr-1"></i>
              <input type="text" name="url-<?php echo $social['name']; ?>" class="py-2 px-2 w-full border rounded" value="<?php echo $social["link"]; ?>">
            </div>
          <?php } ?>
        </div>
        <div class="p-2 flex flex-auto items-center justify-center md:justify-end">		
          <div class="relative text-grupo-red">
            <i class="absolute fa fa-check top-2 left-2"></i>
            <input type="submit" value="Guardar" class="button save cursor-pointer hover:text-white bg-white hover:bg-red-400 border border-grupo-red py-1 pr-2 pl-6 rounded">
          </div>
        </div>
      </form>
    </section>
    <!-- <section class="mb-8">
      <h2 class="uppercase mb-4 text-lg"><strong>¿Quiénes Somos?</strong></h2>
      banner
      <div id="editorsomos">
        <div class="container mx-auto py-8 px-2">
          <section class="py-8 flex w-full">
            <div class="w-full md:w-1/2 px-4 text-center">
            Somos una empresa mexicana fundada en 1995, dedicada a la elaboración de productos que forman parte de la comunicación corporativa y publicitaria de nuestros clientes, desde un gafete hasta el letrero más sofisticado.
            Nuestra diversidad de técnicas y materiales nos permite cumplir con las exigencias del mercado actual, siempre bajo los principios de innovación y excelencia, mismos que nos han llevado a colaborar con compañías locales, nacionales e internacionales.
            Somos el socio ideal para materializar tus proyectos.
            </div>
            <img class="hidden w-full md:w-1/2 px-8" src="https://via.placeholder.com/630x300" alt="">
          </section>
          <section class="py-8 flex w-full justify-end">
            <img class="hidden w-full md:w-1/2 px-8" src="https://via.placeholder.com/630x300" alt="">
            <div class="w-full md:w-1/2 px-4 text-center">
              <h3 class="mb-2 font-bold text-base">CONTROL DE CALIDAD</h3>
              <p>Nuestro principal objetivo es la satisfacción de nuestros clientes, por lo que nuestros procesos están guiados por una cultura de calidad, la cual empieza en los materiales que utilizamos y termina en la entrega del producto final.</p>
            </div>
          </section>
          <div class="flex justify-center mt-8">
            <a href="/contacto/" class="bg-grupo-red hover:bg-red-400 text-white py-2 px-4 rounded uppercase">Contáctanos</a> 
          </div>
        </div>
      </div>
      foto
      boton
    </section>
    <section class="mb-8">
      <h2 class="uppercase mb-4 text-lg"><strong>Control de calidad</strong></h2>
      <div id="editorcalidad">
        <p>This is the descripción calidad.</p>
      </div>
      foto
      <h2 class="uppercase mb-4 text-lg"><strong>Carousel</strong></h2>
      foto
    </section>
    <section class="mb-8">
      <h2 class="uppercase mb-4 text-lg"><strong>Productos</strong></h2>
      banner
    </section>
    -->
    <section class="mb-8">
      <h2 class="text-2xl font-normal">Contacto</h2>
      <form class="siteChanges" name="site" id="multiformContact" enctype="multipart/form-data" method="POST">
        <?php foreach ($contact as $cont) { ?>
        <input type="hidden" name="opcion" value="opcontact">
        <input type="hidden" name="id" value="<?php echo $cont['id']; ?>">
        <input type="hidden" name="imagen" value="<?php echo $cont['foto']; ?>">
        <div class="relative">
          <input type="file" class="py-1 px-2 w-full border rounded" name="image" id="image"/>
          <label for="image" class="absolute bg-white left-0 label_file"><?php echo $cont['foto']; ?></label>
        </div>
        <textarea name="editorcontacto" autocomplete="off">
          <?php echo $cont['descripcion']; ?>
        </textarea>
        <?php } ?>
        <div class="p-2 flex flex-auto items-center justify-center md:justify-end">		
          <div class="relative text-grupo-red">
            <i class="absolute fa fa-check top-2 left-2"></i>
            <input type="submit" value="Guardar" class="button save cursor-pointer hover:text-white bg-white hover:bg-red-400 border border-grupo-red py-1 pr-2 pl-6 rounded">
          </div>
        </div>
      </form>
    </section>
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
  <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
	<script type='text/javascript' language='javascript'>
		$( document ).ready(function() {
      CKEDITOR.replace( 'editorsomos' );
      CKEDITOR.replace( 'editorcalidad' );
      CKEDITOR.replace( 'editorcontacto', {
        customConfig: '/assets/js/ckeditor_config.js'
      });

			$("#salir").on("click", function() {
				exit();
			});

      $(".siteChanges #image").on("click", function() {
        $(this).next().hide();
			});

			$(".siteChanges").on("click", ".button.save", function() {
				var button = $(this);
				var form = $(this).closest("form");
        var action = form.attr("name");
        var opcion = form.attr("id");
        $(form).submit(function(e)
				{
          var formData = new FormData(this);
          $.ajax(
					{
						type: 'POST',
            url: "updatesite.php?action="+action,
						data:  formData,
						mimeType:"multipart/form-data",
						contentType: false,
						cache: false,
						processData:false,
            beforeSend: function()
						{
							$(button).val("Guardando...");
							$(button).attr('disabled', 'disabled');
							$(button).addClass('opacity-50');
							$(button).addClass('cursor-not-allowed');
							$(button).removeClass('hover:bg-red-400');
							$(button).removeClass('hover:text-white');
						},
            success: function(data, textStatus, jqXHR)
						{
							$(form).load("reloader.php?action="+action+opcion);
							console.log(data);
							// console.log(textStatus);
							// console.log(jqXHR);
						}
          });
          e.preventDefault();
        });
      });			
		});
	</script>
</body>
</html>