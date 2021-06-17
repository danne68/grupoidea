<?php 
  session_start();
  ini_set("display_errors", true);
?>
<!DOCTYPE HTML>
<html lang="es">
<head>
  <title>Grupo Idea - Contactenos</title>
  <?php include 'metas.php'; ?>
</head>

<body class="font-sans font-thin bg-gray-100">
    <?php include 'header.php'; ?>
    <div class="min-h-screen">
        <section class="relative h-64 bg-repeat bg-center bg-cover" style="background-image: url(<?php echo $domain;?>images/pic11.jpg)">
          <span class="text-center w-full uppercase absolute text-white text-4xl px-2" style="top: 7rem;text-shadow: 0px 0px 13px black;">¿QUIÉNES SOMOS?</span>
        </section>
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
    <?php include 'footer.php'; ?>
</body>