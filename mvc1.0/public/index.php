<?php
/**
 * Created by PhpStorm.
 * User: HFGHOST
 * Date: 2018. 01. 12.
 * Time: 20:48
 * Developer: Savanya Sándor József
 * A webadmin a HFG.hu tulajdonosa és Savanya Sándor József tulajdona.
 * Sem eladni, sem módostani nem lehet a fent emlitett személyek engedélye nélkül
 */

use webadminv3\App;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../core/App.php';

$url = $_SERVER['REQUEST_URI'];
$uri = preg_split('[\\/]',$url,3,PREG_SPLIT_NO_EMPTY);

/* Debug section */

echo $_SERVER['REQUEST_URI'];
echo '<br /> <pre>';

print_r($uri);

echo '<br /> </pre>';

/* End of debug section */

if(count($uri) == 1) {
    $controller = $uri[0];
}
if(count($uri) == 2) {
    $controller = $uri[0];
    $method = $uri[1];
}
if(count($uri) == 3) {
    $controller = $uri[0];
    $method = $uri[1];
    $params = $uri[2];
}

$app = count($uri) ? new App($controller, $method, $params) : new App();

$app->setDebug(true);


