<?php 
session_start();
ini_set("display_errors", true);
?>
<!DOCTYPE HTML>
<html lang="es">

<head>
    <title>Grupo Idea - Home</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <meta name="description" content="">
    <meta name="author" content="">
    <meta property="og:title" content="Grupo Idea Cancun" />
    <meta property="og:image" content="" />
    <link rel="shortcut icon" href="">
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/1.6.0/tailwind.min.css" crossorigin="anonymous">
    <script src="assets/js/jquery.min.js"></script>
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
                <section>
                    <div class="flex flex-col md:flex-row">
                        <div class="w-full md:w-1/2 md:pr-2 mb-8 md:mb-0">
                            <h2 class="mb-2 uppercase">Quiénes somos</h2>
                            <p>Somos una empresa dedicada al servicio, compromiso y calidad desde su fundación en 1995 por lo mismo nuestro principal objetivo es seguir siendo de su preferencia.</p>
                        </div>
                        <div class="w-full md:w-1/2 md:pl-2">
                            <h2 class="mb-2 uppercase">CONTROL DE CALIDAD</h2>
                            <p class="mb-2">Nuestro principal objetivo es la satisfacción de nuestros clientes, todo ello garantizando la máxima calidad de nuestros servicios y productos.</p>
                            <p>Para alcanzar éste reconocimiento, es con el gran esfuerzo que supone llevamos a cabo un procedimiento de control de calidad, que garantiza toda un seguridad y trazabilidad dentro de la logística de nuestra empresa.</p>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <?php include 'footer.php'; ?>
    <script src="assets/js/slider.js"></script>
</body>
</html>