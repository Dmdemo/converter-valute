
<?
$f_json = 'config.txt';

if (file_exists($f_json)) {

    $arr = [];
    $arr = ['count' => $_POST['countsetting'], 'arrdelvalute' => implode(',', $_POST['excludevalute'])];
    $json = json_encode($arr, true);
    file_put_contents($f_json, $json);
}
?>

