
<?
require 'config.php';

$pathToFile = 'log.txt';
$stringres = '';
if (file_exists($pathToFile)) {
    // $GetContentFile = file_get_contents($pathToFile);
    $GetContentFile = file($pathToFile);
    $GetContentFile = array_reverse($GetContentFile);
    for ($i = 0; $i < $countStringHistory; $i++) $stringres = $stringres . $GetContentFile[$i];
}
echo $stringres;
?>
