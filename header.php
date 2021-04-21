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
<header class="container mx-auto py-4 px-4 flex">
    <a href="index.php" class="w-1/8 items-center flex"><img class="w-full max-w-40" src="images/logo.png"></a>
    <ul class="headerNav flex flex-auto justify-end items-center pr-8">
        <li class="inline-block mr-4"><a class="uppercase flex" href="./">Inicio</a></li>
        <li class="inline-block mr-4 relative">
            <span class="uppercase flex">Productos</span>
            <?php if (sizeof($menuProd) != 0) { ?>
                <ul class="hidden">
                    <?php foreach($menuProd as $menu) {?>
                        <li class="pl-2 pr-2 flex"><a class="pb-1 w-full" href="/products.php?id=<?php echo $menu['id']; ?>"><?php echo $menu['categoria']; ?></a></li>
                    <?php } ?>
                </ul>
            <?php } ?>
        </li>
        <li class="inline-block mr-4"><a class="uppercase flex" href="/contact.php">Contacto</a></li>
    </ul>
    <ul class="flex justify-end items-center">
        <li class="pr-2"><a href="#" class="fa fa-facebook fa-lg hover:text-red-600"></a></li>
        <li class="pl-2"><a href="#" class="fa fa-youtube fa-lg hover:text-red-600"></a></li>
    </ul>
</header>