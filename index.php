<head>
    <link type="text/css" rel="stylesheet" href="style.css">

</head>
<?php

require 'CurrencyConverter.php';
require 'config.php';

if (isset($_POST['countsetting']) && $_POST['countsetting'] != null) {
    $f_json = 'config.txt';
    if (file_exists($f_json)) {
        $arr = [];
        $arr = ['count' => $_POST['countsetting'], 'arrdelvalute' => implode(',', $_POST['excludevalute'])];
        $json = json_encode($arr, true);
        file_put_contents($f_json, $json);
    }
    echo 'Настройки сохранены!';
}

$curConv = new CurrencyConverter;
$listValute = $curConv->GetListFromXML();
$listValutefull = $listValute;
$listValute = array_diff($listValute, $arrDelValute);

?>

<body>
    <div class="wrapper">
        <div style="padding-left: 20px;">
            <div style="padding-top: 5px;">
                <h2>Калькулятор валют</h2>
            </div>
            <form class="contact_form" action="index.php" method="post">
                <p><select size="1" name="valfrom" id="valfrom" style="width:70px; height:27px;">
                        <? foreach ($listValute as $val) {
                            echo "<option value=" . $val . ">" . $val . "</option>";
                        }
                        ?>
                    </select>
                    <input type="number" name="val" size="10" id="val" placeholder="Введите сумму">
                </p>
                <p><select size="1" name="valto" id="valto" style="width:70px;height:27px;">
                        <? foreach ($listValute as $val) {
                            echo "<option value=" . $val . ">" . $val . "</option>";
                        }
                        ?>
                    </select>
                    <input type="number" readonly name="res" size="10" id="res">
                </p>
            </form>

            <div>
                <a href="" id='showlog'>История</a>
                <a href="" id='showsetting'>Настройки</a>
            </div>
            <div>&nbsp;</div>
            <div id='log' style="display:none">
                <textarea id='logarea' readonly cols='50' rows='10'></textarea>
                <div>&nbsp;</div>
            </div>
            <div id='setting' style="display:none">
                <form class="contact_form" action="index.php" method="post">
                    <input type="number" size="5" name="countsetting" id="countsetting"><label> Кол-во строк в логе</label>
                    <p><label> Удерживая нажатой кнопку <b>Ctrl</b> можно выбрать те валюты, которые необходимо исключить</label>
                        <select multiple size="10" name="excludevalute[]" id="excludevalute" style="width:220px;">
                            <? foreach ($listValutefull as $val) {
                                if (in_array($val, $arrDelValute)) {
                                    echo "<option selected value=" . $val . ">" . $val . "</option>";
                                } else {
                                    echo "<option value=" . $val . ">" . $val . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </p>
                    <button class="submit" type="submit">Сохранить настройки</button>
                    <div>&nbsp;</div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="calc.js"></script>
</body>