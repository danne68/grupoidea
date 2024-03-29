<?php 
    session_start();
    ini_set("display_errors", true);
    require_once 'conexion.php';
	require_once "functions/functions.php";
    $contact = select_to_where("sitio","id,descripcion,foto",array("id"=>1));
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
        <?php foreach ($contact as $cont) { ?>
        <section class="relative h-64 bg-repeat bg-center bg-cover" style="background-image: url(<?php echo $domain;?>images/<?php echo $cont['foto']; ?>)">
            <span class="text-center w-full uppercase absolute text-white text-4xl px-2" style="top: 7rem;text-shadow: 0px 0px 13px black;">Contáctanos</span>
        </section>
        <?php } ?>
        <div class="container mx-auto py-8 px-2">
            <section>
                <?php foreach ($contact as $cont) { ?>
                    <?php echo $cont['descripcion']; ?>
                <?php } ?>
                <div class="flex flex-col-reverse md:flex-row">
                    <div class="w-full md:w-1/2 md:pr-4">
                        <form id="envio" method="POST">
                            <div class="flex flex-wrap">
                              <div class="w-full md:w-1/2 md:pr-1">
                                <input class="py-2 px-2 w-full border rounded" type="text" placeholder="Nombre" id="name" name="name" />
                              </div>
                              <div class="w-full mt-4 md:mt-0 md:w-1/2 md:pl-1">
                                <input class="py-2 px-2 w-full border rounded" type="tel" placeholder="Teléfono" id="phone" name="phone" />
                              </div>
                              <div class="w-full mt-4">
                              <input class="py-2 px-2 w-full border rounded" type="email" placeholder="Email" id="email" name="email" />
                              </div>
                              <div class="w-full mt-4">
                                  <textarea class="py-2 px-2 w-full" placeholder="Escribe tu mensaje" id="message" name="message" rows="6"></textarea>
                              </div>
                              <!-- Break -->
                              <div class="w-full mt-4">
                                  <div class="relative">
                                      <i class="absolute text-white fa fa-envelope top-3 left-2"></i>
                                      <input type="submit" id="enviar" value="Enviar" class="bg-grupo-red hover:bg-red-400 text-white py-2 pr-4 pl-8 rounded" />
                                  </div>
                              </div>
                              <div id="ok"></div>
                            </div>
                        </form>
                    </div>
                    <div class="w-full md:w-1/2 mb-8 md:mb-0">
                        <a target="blank" href="//www.google.com.mx/maps/place/Idea+Gafetes+y+Letreros/@21.1678751,-86.840994,17z/data=!4m2!3m1!1s0x8f4c2c0cdcb2a2af:0xbf7e10b2925043cf?hl=es">
                            <img class="w-full" src="<?php echo $domain;?>images/location.png" alt="Gafetes y letreros idea">
                        </a>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js"></script>
    <script>
        $( document ).ready(function() {
            $("#ok").hide();

            $("#envio").validate({
                rules: {
                  name: { required: true, minlength: 2},
                  phone: { required:true, minlength: 8},
                  email: { required:true, email: true},
                  message: { required:true, minlength: 2}
                },
                messages: {
                  name: "Debe introducir su nombre.",
                  phone: "Debe introducir un teléfono valido.",
                  email : "Debe introducir un email válido.",
                  message : "Debe escribir un mensaje",
                },
                submitHandler: function(form){
                    var postData = $("#envio").serializeArray();
                    // var dataString = 'name='+$('#name').val()+'&email='+$('#email').val()+'&message='+$('#message').val();
                    $.ajax({
                        type: "POST",
                        url : "<?php echo $domain;?>envio.php",
                        data : postData,
                        beforeSend: function()
                        {
                            $('#enviar').val("Enviando...");
                            $('#enviar').addClass("disabled");
                        },
                        success: function(data, textStatus, jqXHR)
                        {
                            $("#ok").html(data);
                            $("#ok").show();
                            $('#enviar').removeClass("disabled");
                            $('#enviar').val("Enviar");
                            $('#envio')[0].reset();
                            //console.log(data);
                            //console.log(textStatus);
                            //console.log(jqXHR);
                        }
                    });
                }
            });
        });
    </script>
</body>