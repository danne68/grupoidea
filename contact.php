<?php 
session_start();
ini_set("display_errors", true);
?>
<!DOCTYPE HTML>
<html lang="es">

<head>
    <title>Grupo Idea - Contactenos</title>
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
    <?php include 'header.php'; ?>
    <div class="min-h-screen">
        <section class="relative h-64 bg-repeat bg-center bg-cover" style="background-image: url(images/contact.jpg)">
            <span class="text-center w-full uppercase absolute text-white text-4xl px-2" style="top: 7rem;text-shadow: 0px 0px 13px black;">Contactenos</span>
        </section>
        <div class="container mx-auto py-8 px-2">
            <section>
                <h2 class="uppercase mb-4 text-lg"><strong>Queremos Conocerte</strong></h2>
                <span class="flex mb-8 text-grupo-gray">Si deseas solicitar información sobre nuestros productos y servicios, por favor envíenos un correo con sus datos y uno de nuestros vendedores se contactara lo mas rápido posible para atenderle.</span>
                <div class="flex flex-col-reverse md:flex-row">
                    <div class="w-full md:w-1/2 md:pr-4">
                        <form id="envio" method="POST">
                            <div class="flex flex-wrap">
                                <div class="w-full md:w-1/2 md:pr-1">
                                    <input class="py-2 px-2 w-full border rounded" type="text" placeholder="Nombre" id="name" name="name" />
                                </div>
                                <div class="w-full mt-4 md:mt-0 md:w-1/2 md:pl-1">
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
                            <img class="w-full" src="images/location.png" alt="Gafetes y letreros idea">
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
                    email: { required:true, email: true},
                    message: { required:true, minlength: 2}
                },
                messages: {
                    name: "Debe introducir su nombre.",
                    email : "Debe introducir un email válido.",
                    message : "Debe escribir un mensaje",
                },
                submitHandler: function(form){
                    var postData = $("#envio").serializeArray();
                    // var dataString = 'name='+$('#name').val()+'&email='+$('#email').val()+'&message='+$('#message').val();
                    $.ajax({
                        type: "POST",
                        url : "envio.php",
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