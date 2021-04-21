<?php
    $result = select_to("promociones","descripcion,foto");
?>
<ul id="slider">
    <?php if ( sizeof($result) == 0) { ?>
        <li><img src="http://placehold.it/1200x470/" alt="" /></li>
        <li><img src="http://placehold.it/951x470/" alt="" /></li>
    <?php
    }
    else {
        foreach($result as $slider) {
        ?>
            <li><img src="images/promociones/<?php echo $slider['foto']; ?>" alt="<?php echo $slider["descripcion"]; ?>" /></li>
        <?php
        }
    }
    ?>
</ul>
<script type='text/javascript' language='javascript'>
    $( document ).ready(function() {
        var demo1 = $("#slider").slippry({
            // transition: 'fade',
            // useCSS: true,
            // speed: 1000,
            // pause: 3000,
            // auto: true,
            // preload: 'visible',
            // autoHover: false
        });
    });
</script>