<?php require 'inc/_global/config.php'; ?>
<?php require 'inc/backend/config.php'; ?>
<?php require 'inc/_global/views/head_start.php'; ?>

<!-- Page JS Plugins CSS -->
<?php $dm->get_css('js/plugins/select2/css/select2.min.css'); ?>
<?php require 'inc/_global/views/head_end.php'; ?>
<?php require 'inc/_global/views/page_start.php'; ?>
<?php
    require_once 'config.php';
?>

<?php
                if(isset($_GET['edituser'])) {
                    
                    if(
                        "" != trim($_POST['privatekey']) && 
                        "" != trim($_POST['contact']) && 
                        "" != trim($_POST['serverinfo']) && 
                        "" != trim($_POST['domain']) && 
                        "" != trim($_POST['apicryptkey']) && 
                        "" != trim($_POST['other']) && 
                        "" != trim($_POST['end_subscribe'])
                        )
                        {
                            $database->update("users", [
                                "privatekey" => $_POST['privatekey'],
                                "contact" => $_POST['contact'],
                                "serverinfo" => $_POST['serverinfo'],
                                "domain" => $_POST['domain'],
                                "apicryptkey" => $_POST['apicryptkey'],
                                "other" => $_POST['other'],
                                "end_subscribe" => $_POST['end_subscribe']
                            ], [
                                "id" => $_GET['edituser']
                            ]);
                            echo 'Düzenlendi';
                        }
                    $userdata = $database->get("users", "*", [
                        "id" => $_GET['edituser']
                    ]);
            ?>

<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Alt Bayi Ekle</h1>
        </div>
   </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content">
    <!-- jQuery Validation (.js-validation class is initialized in js/pages/be_forms_validation.min.js which was auto compiled from _js/pages/be_forms_validation.js) -->
    <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
    <form class="js-validation" action="?edituser=<?php echo $userdata['id']; ?>" method="post" autocomplete="off">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Alt Bayi Ekle</h3>
            </div>
            <div class="block-content block-content-full">
                <div class="">
                    <!-- Advanced -->
                    <div class="row items-push">
                        <div class="col-lg-4">
                            <p class="text-muted">
                            <h5>Düzenlenilen Bayi id = <?php echo $userdata['id']; ?></h5>
                            </p>
                        </div>
                        <div class="col-lg-8 col-xl-5">
                            <div class="form-group bluredit">
                                <label for="val-suggestions">Key</label>
                                <textarea type="text" id="privatekey" name="privatekey"  class="form-control" placeholder=""><?php echo $userdata['privatekey']; ?></textarea></a>
								<a class="btn" onclick="document.getElementById('privatekey').value=randomString(128);">Key Üret</a>
                            </div>
                            <div class="form-group bluredit">
                                <label for="val-currency">İletişim Bilgisi *</label>
                                <input type="text" class="form-control" id="contact" name="contact" value="<?php echo $userdata['contact']; ?>">
                            </div>
                            <div class="form-group bluredit">
                                <label for="val-website">Alt Bayi Adı</label>
                                <textarea type="text" name="serverinfo" cols="40" rows="5"><?php echo $userdata['serverinfo']; ?></textarea>
                            </div>                            
							<div class="form-group bluredit">
                                <label for="val-website">Domain</label>
                                <input type="text" class="form-control" id="domain" name="domain" value="<?php echo $userdata['domain']; ?>">
                            </div>
                            <div class="form-group bluredit">
                                <label for="val-phoneus">Api Crypt Key</label>
                                <input type="text" class="form-control" id="apicryptkeyed" name="apicryptkey" value="<?php echo $userdata['apicryptkey']; ?>"></a>
								<a class="btn" onclick="document.getElementById('apicryptkey').value=randomString(13);">Generate</a>
                            </div>
                            <div class="form-group bluredit">
                                <label for="val-digits">Diğer Bilgiler</label>
                                <textarea type="text" name="other" cols="40" rows="5"><?php echo $userdata['other']; ?></textarea>
                            </div>
                            <div class="form-group bluredit">
                                <label for="val-number">Süre</label>
                                <input type="text" class="form-control" id="end_subscribe" name="end_subscribe" value="<?php echo $userdata['end_subscribe']; ?>">
                            </div>
                            <div class="form-group">
                            <button type="submit" class="btn btn-sm btn-light"> 
                                <i class="fa fa-fw fa-check"></i> Bayi Ekle </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Advanced -->
                </div>
            </div>
        </div>
    </form>
<?php 
}
else {
    ?>

    <h5 style="color:orange;">Düzenlemek İçin Üye Seç</h5>
    <?php
}
?>
    <!-- jQuery Validation -->
</div>
<!-- END Page Content -->

<?php require 'inc/_global/views/page_end.php'; ?>
<?php require 'inc/_global/views/footer_start.php'; ?>
<?php require 'inc/_global/views/footer_end.php'; ?>

<script>
function randomString(length) {
    var chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    var result = '';
    for (var i = length; i > 0; --i) result += chars[Math.floor(Math.random() * chars.length)];
    return result;
}
</script>