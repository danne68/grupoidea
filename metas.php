<?php 

$basename = basename($_SERVER['PHP_SELF']);
$domain = str_replace("$basename", "", $_SERVER['PHP_SELF']);

?>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
<meta name="description" content="">
<meta name="author" content="">
<meta property="og:title" content="Grupo Idea Cancun" />
<meta property="og:image" content="" />
<link rel="shortcut icon" href="<?php echo $domain;?>images/favicon.ico">
<link rel="stylesheet" href="<?php echo $domain;?>assets/css/main.css" />
<link href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" rel="stylesheet" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/1.8.8/tailwind.min.css" crossorigin="anonymous">
<script src="<?php echo $domain;?>assets/js/jquery.min.js"></script>