<style>
    *,
    *::before,
    *::after {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
      font-size: 16px;
      font-weight: 400;
      line-height: 1.5;
      color: #212529;
      text-align: left;
      background-color: #fff;
    }

    .container {
      max-width: 600px;
      margin-left: auto;
      margin-right: auto;
      padding-left: 15px;
      padding-right: 15px;
    }

    .tabs {
      display: flex;
      flex-direction: column;
    }

    .tabs__links {
      display: flex;
      width: 100%;
      overflow-x: auto;
      overflow-y: hidden;
      margin-left: auto;
      margin-right: auto;
      margin-bottom: 10px;
      order: 0;
      white-space: nowrap;
      background-color: #fff;
      border: 1px solid #e3f2fd;
      box-shadow: 0 2px 4px 0 #e3f2fd;
    }

    .tabs__links>a {
      display: inline-block;
      text-decoration: none;
      padding: 6px 10px;
      text-align: center;
      color: #1976d2;
    }

    .tabs__links>a:hover {
      background-color: rgba(227, 242, 253, 0.3);
    }

    .tabs>#content-1:target~.tabs__links>a[href="#content-1"],
    .tabs>#content-2:target~.tabs__links>a[href="#content-2"],
    .tabs>#content-3:target~.tabs__links>a[href="#content-3"] {
      background-color: #bbdefb;
      cursor: default;
    }

    .tabs>div:not(.tabs__links) {
      display: none;
      order: 1;
    }

    .tabs>div:target {
      display: block;
    }
  </style>

</head>

<div class="container">

<h1 style="font-size: 20px; text-align: center;">Табы на чистом CSS (на основе :target)</h1>

<div class="tabs">
  <div id="content-1">
    Содержимое 1...
  </div>
  <div id="content-2">
    Содержимое 2...
  </div>
  <div id="content-3">
    Содержимое 3...
  </div>

  <div class="tabs__links">
    <a href="#content-1">Вкладка 1</a>
    <a href="#content-2">Вкладка 2</a>
    <a href="#content-3">Вкладка 3</a>
  </div>
</div>

</div>

<?php

require 'CurrencyConverter.php';
require 'config.php';

if (isset($_POST['countsetting']) && $_POST['countsetting']!=null){
    $f_json = 'config.txt';
    if (file_exists($f_json)) {
        $arr=[];
        $arr=['count'=>$_POST['countsetting'], 'arrdelvalute'=> implode(',',$_POST['excludevalute'])];
        $json = json_encode($arr, true);
        file_put_contents($f_json, $json);
    }
    echo 'Настройки сохранены!';
}

$curConv = new CurrencyConverter;
$listValute = $curConv->GetListFromXML();
$listValutefull=$listValute;
$listValute = array_diff($listValute, $arrDelValute);

?>

<div>
    <form action="index.php" method="post">
        <p><select size="1" name="valfrom" id="valfrom">
                <? foreach ($listValute as $val) {
                    echo "<option value=" . $val . ">" . $val . "</option>";
                }
                ?>
            </select>
            <input type="number" name="val" size="10" id="val">
        </p>
        <p><select size="1" name="valto" id="valto">
                <? foreach ($listValute as $val) {
                    echo "<option value=" . $val . ">" . $val . "</option>";
                }
                ?>
            </select>
            <input type="number" readonly name="res" size="10" id="res">
        </p>
    </form>
</div>
<div>
<a href="" id='showlog'>История</a>
<a href="" id='showsetting'>Настройки</a>
</div>
<div id='log' style="display:none">
    <textarea id='logarea' readonly cols='70' rows='10'></textarea>
</div>
<div id='setting' style="display:none">
   <form action="index.php" method="post">
    <input type="number"  size="5" name="countsetting" id="countsetting"><label> Кол-во строк в логе</label>
    <p><select multiple size="10" name="excludevalute[]" id="excludevalute">
                <? foreach ($listValutefull as $val) {
                    if (in_array( $val, $arrDelValute)) {
                         echo "<option selected value=" . $val . ">" . $val . "</option>";
                    } else {
                         echo "<option value=" . $val . ">" . $val . "</option>"; 
                    }
                }
                ?>
    </select></p>
    <button type="submit">Сохранить настройки</button>
    </form>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="calc.js"></script>