
<?
require 'config.php';

$resarr = [];
$resarr['count'] = $countStringHistory;
$resarr['arr'] = $arrDelValute;
$res = json_encode($resarr, true);

echo $res;
?>
