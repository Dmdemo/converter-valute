
<?
$f_json = 'config.txt';

if (file_exists($f_json)) {
    $json = file_get_contents("$f_json");
    $obj = json_decode($json, true);

    $countStringHistory = $obj['count'];
    $arrDelValute = explode(',', $obj['arrdelvalute']);
}
?>