<?php
    $result = select_to_order("promociones","descripcion,foto","id_promocion");
?>
<ul id="slider">
    <?php if ( sizeof($result) == 0) { ?>
        <li><img src="https://placehold.it/1200x470/" alt="" /></li>
        <li><img src="https://placehold.it/951x470/" alt="" /></li>
    <?php
    }
    else {
        foreach($result as $slider) {
            if (!preg_match('/\mp4\b/', $slider['foto'])) {
            ?>
                <li>
                    <img src="images/promociones/<?php echo $slider['foto']; ?>" alt="<?php echo $slider["descripcion"]; ?>" />
                </li>
            <?php } else { ?>
                <li id="videoFrame">
                    <video class="mx-auto" id="autoplay" muted playsinline controls>
                        <source src="images/promociones/<?php echo $slider['foto']; ?>" type="video/mp4">
                    </video>
                </li>
            <?php
            }
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
        document.querySelector(".sy-list").addEventListener("transitionend", videoP);
        function videoP(){
            document.getElementById('autoplay').currentTime = 0;
            setTimeout('', 400);
            if(document.querySelector('#videoFrame.sy-active')){
                demo1.stopAuto();
                document.getElementById('autoplay').play();
            }
        }
        $("#autoplay").on('ended', function(){
            demo1.startAuto();
        });
    });
</script>