<?php
	if(isset($_SESSION['s_user'])) {
?>
        <script type="text/javascript">window.location ="vista-promo.php";</script>
<?php
    } else {
        require_once "conexion.php";
        require_once "functions/functions.php";
        $menuProd = select_to("categoria","id,categoria");

	    if (isset($_GET['pass'])) {
    	    require_once("password.php");
        }
	}
?>
<header class="container mx-auto py-4 px-2 md:px-4 flex">
    <a href="index.php" class="w-1/5 md:w-1/8 items-center flex"><img class="w-full max-w-40" src="images/logo.png"></a>
    <ul class="headerNav flex flex-auto justify-end items-center md:pr-8">
        <li class="inline-block mr-2 md:mr-4"><a class="uppercase flex" href="./">Inicio</a></li>
        <li class="inline-block mr-2 md:mr-4 md:relative">
            <span class="uppercase flex">Productos</span>
            <?php if (sizeof($menuProd) != 0) { ?>
                <ul class="hidden w-screen md:w-9/5 left-0 md:left-auto top-16 md:top-4 z-20">
                    <?php foreach($menuProd as $menu) {?>
                        <li class="pl-2 pr-2 flex"><a class="py-2 md:pb-1 w-full text-lg md:text-base" href="/products.php?id=<?php echo $menu['id']; ?>"><?php echo $menu['categoria']; ?></a></li>
                    <?php } ?>
                </ul>
            <?php } ?>
        </li>
        <li class="inline-block mr-2 md:mr-4"><a class="uppercase flex" href="/contact.php">Contacto</a></li>
    </ul>
    <ul class="flex justify-end items-center">
        <li class="pr-2"><a href="https://www.facebook.com/IDEA-Gafetes-y-Letreros-100100851416203" class="fa fa-facebook fa-lg hover:text-red-600"></a></li>
        <!--<li class="pl-2"><a href="#" class="fa fa-youtube fa-lg hover:text-red-600"></a></li>-->
    </ul>
</header>