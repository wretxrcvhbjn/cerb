<?php
$dm->inc_side_overlay           = 'inc/backend/views/inc_side_overlay.php';
$dm->inc_sidebar                = 'inc/backend/views/inc_sidebar.php';
$dm->inc_header                 = 'inc/backend/views/inc_header.php';
$dm->inc_footer                 = 'inc/backend/views/inc_footer.php';
$dm->l_sidebar_dark             = true;
$dm->l_header_style             = 'light';
$dm->l_m_content                = 'narrow';
$dm->main_nav                   = array(
    array(
        'name'  => 'Bayi İşlemleri',
        'icon'  => 'fa fa-border-all',
        'sub'   => array(
            array(
                'name'  => 'Bayileri Listele',
                'url'   => 'users.php'
            ),
            array(
                'name'  => 'Bayi Ekle',
                'url'   => 'usersadd.php'
            ),
        )
    ),
);
