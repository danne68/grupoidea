<?php
	require_once 'conexion.php';
	require_once "functions/functions.php";
?>
<?php if(isset($_GET['action'])) { ?>
  <?php if($_GET['action'] == 'sitemultiformContact') { ?>
    <?php
      $contact = select_to_where("sitio","id,descripcion,foto",array("id"=>1));
    ?>
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
    <script type='text/javascript' language='javascript'>
      $( document ).ready(function() {
        CKEDITOR.replace( 'editorcontacto', {
          customConfig: '/assets/js/ckeditor_config.js'
        });
      });
    </script>
  <?php } ?>
  <?php if($_GET['action'] == 'socialmultiformSocial') { ?>
    <?php
      $redes = select_to("redes","id,icon,name,link");
      $conRedes = count($redes);
    ?>
    <form class="siteChanges" name="social" id="multiformsocial" enctype="multipart/form-data" method="POST">
      <div class="p-2 flex flex-row">
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
  <?php } ?>
<?php } ?>
