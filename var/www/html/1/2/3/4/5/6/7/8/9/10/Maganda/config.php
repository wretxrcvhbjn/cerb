<?php
error_reporting(0);
?>
<?php
require_once 'medoo.php';

// Using Medoo namespace
use Medoo\Medoo;

$database = new Medoo([
	// required
    'database_type' => 'mysql',
    'database_name' => 'bot',
    'server' => 'localhost',
    'username' => 'non-root',
    'password' => 'H3Q3sS@@@234P'
]);

function getValidDaysSubscribe($infos) {
    $mytime = strtotime($infos) - time();
    if($mytime > 0) {
        return round(abs($mytime)/60/60/24);
    }
    return 0;
}
?>