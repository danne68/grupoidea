<?php 
session_start();
ini_set("display_errors", true);
?>
<!DOCTYPE HTML>
<html lang="es">

<head>
    <title>Grupo Idea - Productos</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="">
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/1.6.0/tailwind.min.css" crossorigin="anonymous">
    <script src="assets/js/jquery.min.js"></script>
</head>
<body class="font-sans font-thin bg-gray-100">
    <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
        ?>
            <script type="text/javascript">window.location ="index.php";</script>
        <?php 
        }
        require_once 'conexion.php';
        require_once "functions/functions.php";
        $categories = select_to_where("categoria","descripcion",array("id"=>$id));
        $producto = select_to_where("productos","nombre,descripcion,foto",array("categoria"=>$id));
    ?>
        <?php include 'header.php'; ?>
        <div class="min-h-screen">
            <section class="relative h-64 bg-repeat bg-center bg-cover" style="background-image: url(images/productos-bg.jpg)">
                <?php foreach($categories as $cat) {?><span class="flex w-full md:w-4/5 items-center absolute bottom-0 top-0 left-0 right-0 mx-auto text-center text-white text-lg px-2" style="text-shadow: 0px 0px 13px black;"><?php echo $cat["descripcion"]; ?></span><?php } ?>
            </section>
            <div class="container mx-auto py-8 px-2">
                <section>
                    <?php if ( sizeof($producto) != 0) { ?>
                        <div class="flex flex-wrap">
                            <?php foreach($producto as $prod) {?>
                                <div class="w-1/2 md:w-1/4 px-3 pb-8 imageModal">
                                    <img class="cursor-pointer" src="images/productos/<?php echo $prod["foto"]; ?>" alt="<?php echo $prod["nombre"]; ?>" onerror="this.onerror=null;this.src='images/no-image.jpg';">
                                    <input type="hidden" value="<?php echo $prod['foto']; ?>">
                                    <input type="hidden" value="<?php echo $prod['descripcion']; ?>">
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </section>
            </div>
        </div>
        <?php include 'footer.php'; ?>
        <div id="Modal"></div>
        <div id="overlayImg"></div>
    </div>
    <!-- Scripts -->
    <script src="assets/js/functions.js"></script>
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