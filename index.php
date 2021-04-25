<?php 
session_start();
ini_set("display_errors", true);
?>
<!DOCTYPE HTML>
<html lang="es">

<head>
  <title>Grupo Idea - Home</title>
  <?php include 'metas.php'; ?>
</head>
<body class="font-sans font-thin bg-gray-100">
    <?php
        require_once "conexion.php";
        require_once "functions/functions.php";
        $categories = select_to("categoria","id,categoria,foto");
    ?>
        <?php include 'header.php'; ?>
        <div class="min-h-screen">
            <?php include 'slider.php'; ?>
            <div class="container mx-auto px-2 pb-10">
                <?php if (sizeof($categories) != 0) { ?>
                    <section class="py-8">
                        <div class="flex flex-wrap">
                            <?php foreach($categories as $cat) {?>
                                <div class="w-1/3 pr-2 pl-2 py-2">
                                    <a href="products.php?id=<?php echo $cat['id']; ?>">
                                        <img src="images/categorias/<?php echo $cat['foto']; ?>" alt="<?php echo $cat['categoria']; ?>" onerror="this.onerror=null;this.src='images/no-image.jpg';">
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                    </section>
                <?php } ?>
            </div>
        </div>
        <?php include 'footer.php'; ?>
    <script src="assets/js/slider.js"></script>
</body>
</html>