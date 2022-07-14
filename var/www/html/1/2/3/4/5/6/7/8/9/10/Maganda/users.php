<?php 
$kul[0]['username']="admin"; 
$kul[0]['password']="Sananeamk"; 


//Üstteki Kullanıcı adı ve sifreyi cogaltabilirsiniz

// Dogrulama 

function authenticate() 
{ 
header( 'WWW-Authenticate: Basic realm="LOGİN | Sistem Yetkili Girisi"' ); 
header( 'HTTP/1.0 401 Unauthorized' ); 
echo '<br><br><br><body bgcolor=silver><b><font color=red size=2 face="Tahoma"><center>GiRiS YAPILMADI .. <a href="users.php"><font color=darkgreen size=2 face="Tahoma">Geri Gelip Tekrar Giris icin TIKLAYIN</font></a></b> '; 
exit; 
} 

if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) { authenticate(); } else 
{ 
for($i=0;$i<count($kul);$i++) { if($_SERVER['PHP_AUTH_USER']==$kul[$i]['username'] && $_SERVER['PHP_AUTH_PW']==$kul[$i]['password']){$auth=TRUE;}} 
if($auth !=TRUE) {authenticate();} 
} 
?>
<?php require 'inc/_global/config.php'; ?>
<?php require 'inc/backend/config.php'; ?>
<?php require 'inc/_global/views/head_start.php'; ?>
<?php require 'inc/_global/views/head_end.php'; ?>
<?php require 'inc/_global/views/page_start.php'; ?>
<?php
    require_once 'config.php';
?>
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Alt Bayiler Listesi</h1>
        </div>
   </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content">
    <!-- Small Table -->
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <div class="block-options">
                Alt Bayi Görüntüle
            </div>
        </div>
        <div class="block-content">
            <?php
            if(isset($_GET['removeuser'])) {
                $data = $database->delete("users", [
                    "id" => $_GET['removeuser']
                ]);
                echo '<br><h5 style="color:green"> '.$_GET['removeuser'].' Numaralı Bayi Silindi</h5>';
                }
            ?>
            <table class="table table-sm table-vcenter">
                <thead>
                    <tr>
                        <th>İD</th>
                        <th>Key</th>
                        <th>Bayi Adı</th>
                        <th>Domain</th>
                        <th>Crypt Key</th>
                        <th>Süre</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $datas = $database->select("users", "*");
                        foreach($datas as $data)
                        {
                            echo "<tr class='bluredit'><td>".
                                $data["id"] . "</td><td>" . "<textarea readonly>".
                                $data["privatekey"] . "</textarea></td><td>" .
                                "<textarea readonly>" . $data["serverinfo"] . "</textarea></td><td>" .
                                $data["domain"] . "</td><td>" .
                                $data["apicryptkey"] . "</td><td>" .
                                getValidDaysSubscribe($data["end_subscribe"]) . "</b></td><td>" . 
                                '<a class="far fa-edit" href="usersedit.php?edituser=' . $data["id"] . '"></td><td>' . 
                                '<a class="far fa-trash-alt" href="?removeuser=' . $data["id"] . '"</td><td>' . "</td></tr>";
                        }
                        ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- END Contextual Table -->
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
</html>