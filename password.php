<div class="modal">
  <h2 class="text-lg"><strong>Entrar</strong></h2>
	<div class="modal-content pt-6 pb-8 px-4 bg-white">
		<form id="login" method="POST">
			<div class="flex flex-col text-grupo-gray">
				<div class="w-full mb-4">
					<input class="py-2 px-2 w-full border rounded" type="text" placeholder="Email" id="user" name="user" />
				</div>
				<div class="w-full mb-4">
					<input class="py-2 pl-2 w-full border rounded" type="password" placeholder="Contraseña" id="pass" name="pass" />
				</div>
				<div class="w-full">
					<div class="relative">
						<i class="absolute text-white fa fa-user top-3 left-2"></i>
						<input type="submit" id="ingresar" value="Entrar" class="bg-grupo-red hover:bg-red-400 text-white py-2 pr-4 pl-8 rounded" />
					</div>
				</div>
				<div id="ok"></div>
			</div>
		</form>
	</div>
</div>
<div id="overlay"></div>

<!-- Scripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js"></script>
<script>
	$( document ).ready(function() {
		$(".modal").show();
		$("#ok").hide();
		$("body").addClass("noscroll");
		$("#overlay").show();
		$("#login").validate({
			rules: {
        user: { required:true, email: true},
				pass: { required:true, minlength: 2}
			},
			messages: {
				user: "Debe introducir un usuario/correo valido",
				pass : "Debe introducir su contraseña"
			},
			submitHandler: function(form){
				var postData = $("#login").serializeArray();
				$.ajax({
					
					type: "POST",
					url : "ingreso.php",
					data : postData,
					beforeSend: function()
					{
						$('#ingresar').val("comprobando..");
						$('#ingresar').addClass("disabled");
					},
					success: function(data, textStatus, jqXHR)
					{
						if(data == 'true') {
							window.location="vista-promo.php";
             
						}
						else {
							if (data == 'usuario') {
								$("#user").focus();
								$('#ok').html("correo incorrecto");
								$("#ok").show();
								$('#ingresar').removeClass("disabled");
								$('#ingresar').val("Entrar");
								//console.log(data);
								//console.log(textStatus);
								//console.log(jqXHR);
							}
							else {
								if (data == 'contraseña') {
									$("#pass").focus();
									$('#ok').html("contraseña incorrecta");
									$("#ok").show();
									$('#ingresar').removeClass("disabled");
									$('#ingresar').val("Entrar");
									//console.log(data);
									//console.log(textStatus);
									//console.log(jqXHR);
								}
								else {
									$('#ok').html(data);
									$("#ok").show();
									//$('#login')[0].reset();
									$('#ingresar').removeClass("disabled");
									$('#ingresar').val("Entrar");
									//console.log(data);
									//console.log(textStatus);
									//console.log(jqXHR);
								}
							}
						}
					}
				});
			}
		});
		$('#overlay').click(function(){
			var location = window.location.href.replace(window.location.search,'');
			window.location = location;
		});
		$('#user, #pass').keypress(function() {
			$("#ok").hide();
		});
		$("body").keyup(function(e){
			if(e.keyCode == 27) {
				$(".modal").hide();
				$("body").removeClass("noscroll");
				$("#overlay").hide();
				e.preventDefault();
			}
		});
	});
</script>