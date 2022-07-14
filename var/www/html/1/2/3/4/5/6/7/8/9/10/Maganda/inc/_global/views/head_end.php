<?php
?>

    <!-- Fonts and Dashmix framework -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" id="css-main" href="<?php echo $dm->assets_folder; ?>/css/dashmix.min.css">
    <link rel="stylesheet" id="css-main" href="<?php echo $dm->assets_folder; ?>/css/blur.css">
    <?php if ($dm->theme) { ?>
    <link rel="stylesheet" id="css-theme" href="<?php echo $dm->assets_folder; ?>/css/themes/<?php echo $dm->theme; ?>.min.css">
    <?php } ?>
</head>
<body>
