<?php 
    session_start();
    ini_set("display_errors", true);
?>
<!DOCTYPE HTML>
<html lang="es">

<head>
  <title>Grupo Idea - Productos</title>
  <?php include 'metas.php'; ?>
</head>
<body class="font-sans font-thin bg-gray-100">
    <?php
        if (isset($_GET['slug'])) {
            $slug = $_GET['slug'];
        } else {
    ?>
        <script type="text/javascript">window.location ="/";</script>
    <?php 
        }
        require_once 'conexion.php';
        require_once "functions/functions.php";
        $categories = select_to_where("categoria","id,descripcion",array("slug"=>$slug));
        $idSite = $categories[0]["id"];
        $producto = select_to_where("productos","nombre,descripcion,foto",array("categoria"=>$categories[0]["id"]));
    ?>
        <?php include 'header.php'; ?>
        <div class="min-h-screen">
            <section class="relative h-64 bg-repeat bg-center bg-cover" style="background-image: url(../../images/productos-bg.jpg)">
                <?php foreach($categories as $cat) {?><span class="flex w-full md:w-4/5 items-center absolute bottom-0 top-0 left-0 right-0 mx-auto text-center text-white text-lg px-2" style="text-shadow: 0px 0px 13px black;"><?php echo $cat["descripcion"]; ?></span><?php } ?>
            </section>
            <div class="container mx-auto py-8 px-2">
                <section>
                    <?php if ( sizeof($producto) != 0) { ?>
                        <div class="flex flex-wrap">
                            <?php foreach($producto as $prod) {?>
                                <div class="w-1/2 md:w-1/4 px-3 pb-8 imageModal">
                                    <img class="cursor-pointer" src="../../images/productos/<?php echo $prod["foto"]; ?>" alt="<?php echo $prod["nombre"]; ?>" onerror="this.onerror=null;this.src='../images/no-image.jpg';">
                                    <input type="hidden" value="<?php echo $prod['foto']; ?>">
                                    <input type="hidden" value="<?php echo $prod['descripcion']; ?>">
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </section>
            </div>
            <div class="container mx-auto flex w-full items-center justify-center py-8">
                <?php $categoriesNext = select_to("categoria","id,slug,categoria");
                    if(count($categoriesNext)>0) {
                        $cantidad= count($categoriesNext);
                        for ($i = 0; $i < $cantidad; $i++) {
                            if($categoriesNext[$i]["id"] == $idSite){
                                if($i==0){
                                    $step = $cantidad-1;
                                } else {
                                    $step = $i-1;
                                }
                                if($i==($cantidad-1)){
                                    $forward = 0;
                                } else {
                                    $forward = $i+1;
                                }
                                $prevName = $categoriesNext[$step]["categoria"];
                                $prevSlug = $categoriesNext[$step]["slug"];

                                $nextName = $categoriesNext[$forward]["categoria"];
                                $nextSlug = $categoriesNext[$forward]["slug"];
                            }
                        }
                    }
                ?>
                <a class="flex items-center bg-red-400 text-white mx-4 p-2 rounded" href="<?php echo $domain."producto/".$prevSlug; ?>/">
                    <i class="fas fa-arrow-left fa-lg mr-2"></i>
                    <span><?php echo $prevName; ?></span>
                </a>
                <a class="flex items-center bg-red-400 text-white mx-4 p-2 rounded" href="<?php echo $domain."producto/".$nextSlug; ?>/">
                    <span><?php echo $nextName; ?></span>
                    <i class="fas fa-arrow-right fa-lg ml-2"></i>
                </a>
            </div>
        </div>
        <?php include 'footer.php'; ?>
        <div id="Modal"></div>
        <div id="overlayImg"></div>
    </div>
    <!-- Scripts -->
    <script src="<?php echo $domain;?>assets/js/functions.js"></script>
    <script type='text/javascript' language='javascript'>
        $( document ).ready(function() {
            $(".imageModal").click(function(e){
                $("body").addClass("noscroll");
                $("#overlayImg").show();
                $("#Modal").show();
                $('#Modal').html("");
                var data = { 
                    image: $(this).find("input")[0].value,
                    label: $(this).find("input")[1].value,
                    name: "ProductoImage",
                    action:"image",
                };
                showModal(data);
                e.preventDefault();
            });
            $(document).on('click', "#overlayImg", function(e) {
                closeModal();
                $("body").removeClass("noscroll");
                e.preventDefault();
            });
            $("body").keyup(function(e){
                if(e.keyCode == 27) {
                    closeModal();
                    $("body").removeClass("noscroll");
                    e.preventDefault();
                }
            });
        });
    </script>
</body>