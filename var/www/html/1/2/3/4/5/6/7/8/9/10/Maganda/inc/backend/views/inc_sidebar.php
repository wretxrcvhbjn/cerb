<?php
?>

<nav id="sidebar" aria-label="Main Navigation">
    <!-- Side Header -->
    <div class="bg-header-dark">
        <div class="content-header bg-white-10">
            <!-- Logo -->
            <a class="font-w600 text-white tracking-wide" href="index.php">
                <span class="smini-visible">
                    V<span class="opacity-75">4</span>
                </span>
                <span class="smini-hidden">
                    V4 Yöne<span class="opacity-75">tim Panel</span>
                </span>
            </a>
            <div>
                <a class="js-class-toggle text-white-75" data-target="#sidebar-style-toggler" data-class="fa-toggle-off fa-toggle-on" onclick="Dashmix.layout('sidebar_style_toggle');Dashmix.layout('header_style_toggle');" href="javascript:void(0)">
                    <i class="fa fa-toggle-off" id="sidebar-style-toggler"></i>
                </a>
                <a class="d-lg-none text-white ml-2" data-toggle="layout" data-action="sidebar_close" href="javascript:void(0)">
                    <i class="fa fa-times-circle"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="js-sidebar-scroll">
        <!-- Side Navigation -->
        <div class="content-side">
            <ul class="nav-main">
			    <img src="assets/img/basic/logo.png" alt="" width="220px" height="160px">
				<p style="text-align:center"><span style="font-size:26px"><span style="font-family:Impact,Charcoal,sans-serif">Cerberus V4<br />
				Admin Panel</span></span></p>
            </ul>            
			<ul class="nav-main">
                <?php $dm->build_nav(); ?>
            </ul>
        </div>
    </div>
</nav>
