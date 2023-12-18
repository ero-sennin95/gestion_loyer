<?php
//Autoload
require_once  dirname(__DIR__) . '/vendor/autoload.php';

//Active debug mode
$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();
//dd($_GET);
if(isset($_GET['page'] ) && $_GET['page']==='1'){
    //Réécrire l'url sans le paramètre ?page
    $uri = explode('?',$_SERVER['REQUEST_URI'])[0];
    $get = $_GET;
    unset($get['page']);
    $query = http_build_query($get);
    if(!empty($query)){
       $uri =  $uri . '?' . $query;
    }
    var_dump($uri);
     header('Location: ' . $uri);
     http_response_code(301);
     exit() ;
}

define('DEBUG_TIME',microtime(true));
define('VIEW_PATH',dirname(__DIR__) . '/views');

session_start();
//var_dump(dirname(__DIR__));

$pdo = App\Connection::getPDO();

$router = new AltoRouter();

$router->map('GET','/',function() use ($router){
    require VIEW_PATH. '/locataires/index.php'; // a changé par dashboard
},'home');
$router->map('GET','/locataires',function() use ($router) {
    require VIEW_PATH. '/locataires/index.php';
},'locataires_index');
$router->map('GET', '/locataire/[i:id]', function($id) use ( $router) {
    $params = ($router->match()['params']);
    require VIEW_PATH. '/locataires/details.php';

} , 'locataire_details');

$router->map('GET','/contrats',function() use ($router){
    require VIEW_PATH . '/contrats/index.php';
},'contrats_index');

$router->map('GET','/contrat/[i:id]',function($id){
    require VIEW_PATH . '/contrats/details.php';
},'contrat_details');
// $router->map( 'GET', '/locataire/[i:id]/', 'UserController#showDetails' );


$match = $router->match();
// var_dump($match);
ob_start();

// call closure or throw 404 status
if( is_array($match) && is_callable( $match['target'] ) ) {
	call_user_func_array( $match['target'], $match['params'] );
   
} else {
	// no route was matched
	header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}

function show($id){
}

//$match['target']();
$content = ob_get_clean();

require VIEW_PATH . DIRECTORY_SEPARATOR . 'layouts/defaut.php';

?>

