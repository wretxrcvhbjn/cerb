<?php
?>
<?php if(isset($dm->page_loader) && $dm->page_loader) { ?>
<div id="page-loader" class="show"></div>

<?php } ?>
<div id="page-container"<?php $dm->page_classes(); ?>>
    <?php if(isset($dm->inc_side_overlay) && $dm->inc_side_overlay) { include($dm->inc_side_overlay); } ?>
    <?php if(isset($dm->inc_sidebar) && $dm->inc_sidebar) { include($dm->inc_sidebar); } ?>
    <?php if(isset($dm->inc_header) && $dm->inc_header) { include($dm->inc_header); } ?>

    <main id="main-container">
