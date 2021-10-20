<?php
  if(isset($_SESSION['s_user'])) {
?>
    <script type="text/javascript">window.location ="vista-promo.php";</script>
<?php
  } else {
    require_once "conexion.php";
    require_once "functions/functions.php";
    $menuProd = select_to("categoria","slug,categoria");
    $redes = select_to("redes","icon,link");
    if (isset($_GET['pass'])) {
      require_once("password.php");
    }
	}
  
?>
<header class="container mx-auto py-4 px-2 md:px-4 flex">
  <div id="buttonMob" class="flex md:hidden items-center px-2 border mr-4"><i class="fa fa-bars fa-lg"></i></div>
  <a href="<?php echo $domain;?>" class="w-1/4 md:w-auto items-center flex"><img class="w-full max-w-40" src="<?php echo $domain;?>images/logo.png"></a>
  <ul class="headerNav hidden md:flex flex-auto justify-center items-center">
    <li class="inline-block mr-2 md:mr-4"><a class="uppercase flex" href="<?php echo $domain;?>">Inicio</a></li>
    <li class="inline-block mr-2 md:mr-4"><a class="uppercase flex" href="/somos/">¿Quiénes Somos?</a></li>
    <li class="inline-block mr-2 md:mr-4 md:relative">
      <span class="uppercase flex">Productos</span>
      <?php if (sizeof($menuProd) != 0) { ?>
        <ul class="hidden w-9/5 left-auto top-4">
          <?php foreach($menuProd as $menu) {?>
            <li class="pl-2 pr-2 flex"><a class="py-2 md:pb-1 w-full text-lg md:text-base" href="<?php echo $domain;?>producto/<?php echo $menu['slug']; ?>/"><?php echo $menu['categoria']; ?></a></li>
          <?php } ?>
        </ul>
      <?php } ?>
    </li>
    <li class="inline-block"><a class="uppercase flex" href="/contacto/">Contacto</a></li>
  </ul>
  <ul class="flex w-full md:w-auto justify-end items-center">
    <?php foreach($redes as $social) {?>
      <?php if ($social["link"] != "") { ?>
        <li class="pr-2"><a href="<?php echo $social["link"]; ?>" target="_blank" class="fab fa-<?php echo $social["icon"]; ?> fa-lg hover:text-red-600"></a></li>
      <?php } ?>
    <?php } ?>
  </ul>
</header>
<div id="menuMob" class="relative">
  <div id="menuWrapper" class="px-4 py-2 mt-16 w-full h-full overflow-y-scroll">
    <div id="menuMobClose" class="absolute top-4 right-4"><i class="fa fa-times fa-2x"></i></div>
    <ul class="overflow-y-scroll mb-16">
      <li class="py-2 uppercase"><a href="<?php echo $domain;?>" class="flex">Inicio</a></li>
      <li class="py-2 uppercase"><a href="/somos/" class="flex">¿Quiénes Somos?</a></li>
      <li class="py-2 uppercase">
        <div id="productMob" class="flex w-full">
          <span class="flex-1">Productos</span>
          <i class="flex items-center fa fa-chevron-down fa-lg"></i>
        </div>
        <?php if (sizeof($menuProd) != 0) { ?>
          <ul id="productList" class="hidden pl-4 normal-case">
            <?php foreach($menuProd as $menu) {?>
              <li class="pl-2 pr-2 flex"><a class="py-2 w-full text-lg" href="<?php echo $domain;?>producto/<?php echo $menu['slug']; ?>"><?php echo $menu['categoria']; ?></a></li>
            <?php } ?>
          </ul>
        <?php } ?>
      </li>
      <li class="py-2 uppercase"><a href="/contacto/" class="flex">Contacto</a></li>
    </ul>
  </div>
</div>
<script type='text/javascript' language='javascript'>
  $('#buttonMob').click(function(){
    $("body").addClass("noscroll");
    document.getElementById("menuMob").style.width = "100%";
    document.getElementById("menuWrapper").style.display = "block";
	});

  $('#menuMobClose').click(function(){
    $("body").removeClass("noscroll");
    document.getElementById("menuWrapper").style.display = "none";
    document.getElementById("menuMob").style.width = "0";
	});

  var btn = document.querySelector('#productMob');
  var btnIcon = document.querySelector("#productMob i");
  btn.addEventListener('click', function(){
    var list = document.getElementById('productList');
    list.classList.toggle("hidden");
    btnIcon.classList.toggle("fa-chevron-down");
    btnIcon.classList.toggle("fa-chevron-up");
  });
</script>