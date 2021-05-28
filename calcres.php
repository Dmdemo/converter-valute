<?
require 'CurrencyConverter.php';

if (isset($_POST['val']) && $_POST['val']!=null ) {
    
    $curConv = new CurrencyConverter;
    $res=$curConv->from($_POST['valfrom'])->to($_POST['valto'])->convert($_POST['val']);
    $resarr=array('res' => $res);
    
    //запись в лог
    $log = date('Y-m-d H:i:s') . '  Сумма  ' . $_POST['val'] .' '.  $_POST['valfrom'] . ' в ' . $_POST['valto']. ' = ' . $res;
    file_put_contents(__DIR__ . '/log.txt', $log . PHP_EOL, FILE_APPEND);

    echo json_encode($resarr);
    
} else {
    $resarr=array('status' => 'ошибка');
    return json_encode($resarr);
}
