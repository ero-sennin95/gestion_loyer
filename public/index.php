<?php
//Autoload
require '../App/Auth.php';
// use App\Auth;
// dump(Auth::isConnected());

require_once  dirname(__DIR__) . '/vendor/autoload.php';
// require '../commands/bdd.php';
//Active debug mode
// $_SESSION['connected']=1;


   
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
   // var_dump($uri);
     header('Location: ' . $uri);
     http_response_code(301);
     exit() ;
}

define('DEBUG_TIME',microtime(true));
define('VIEW_PATH',dirname(__DIR__) . '/views');


//var_dump(dirname(__DIR__));

$pdo = App\Connection::getPDO();

$router = new AltoRouter();
$title='';
$menuPages = '';


$router->map('GET','/',function() use ($router){
    require VIEW_PATH. '/dashboard/index.php'; // a changé par dashboard
},'dashboard');
$router->map('GET','/locataires',function() use ($router,&$menuPages) {
    require VIEW_PATH. '/locataires/index.php';
},'locataires_index');
$router->map('GET', '/locataire/[i:id]', function($id) use ($router) {
    $params = ($router->match()['params']);
    require VIEW_PATH. '/locataires/details.php';

} , 'locataire_details');

$router->map('GET | POST', '/locataire/edit/[i:id]', function($id) use ( $router) {
    $params = ($router->match()['params']);
    require VIEW_PATH. '/locataires/edit.php';

} , 'locataire_edit');

$router->map('POST ', '/locataire/delete/[i:id]', function($id) use ( $router) {
    $params = ($router->match()['params']);
    require VIEW_PATH. '/locataires/delete.php';

} , 'locataire_delete');

$router->map('POST |GET ', '/locataire/create', function() use ( $router) {
    $params = ($router->match()['params']);
    require VIEW_PATH. '/locataires/create.php';
} , 'locataire_create');


$router->map('GET','/contrats',function() use ($router,&$menuPages){
   $menuPages = 'contrat';
   require VIEW_PATH . '/contrats/index.php';
},'contrats_index');

$router->map('GET','/contrat/[i:id]',function($id){
    require VIEW_PATH . '/contrats/details.php';
},'contrat_details');

$router->map('GET | POST', '/contrat/edit/[i:id]', function($id) use ( $router) {
    $params = ($router->match()['params']);
    require VIEW_PATH. '/contrats/edit.php';

} , 'contrat_edit');

$router->map('GET | POST', '/contrat/create', function() use ( $router) {
    $params = ($router->match()['params']);
    require VIEW_PATH. '/contrats/create.php';

} , 'contrat_create');

$router->map('POST ', '/contrats/delete/[i:id]', function($id) use ( $router) {
    $params = ($router->match()['params']);
    require VIEW_PATH. '/contrats/delete.php';

} , 'contrat_delete');

// $router->map( 'GET', '/locataire/[i:id]/', 'UserController#showDetails' );
$router->map('GET | POST','/auth/login',function(){
    require VIEW_PATH . '/auth/login.php';
},'auth_login');



$router->map('GET','/biens',function() use ($router,&$menuPages) {
    require VIEW_PATH. '/biens/index.php';
},'biens_index');

$router->map('GET | POST', '/bien/edit/[i:id]', function($id) use ( $router) {
    $params = ($router->match()['params']);
    require VIEW_PATH. '/biens/edit.php';

} , 'bien_edit');

$router->map('GET | POST', '/bien/create', function() use ( $router) {
    $params = ($router->match()['params']);
    require VIEW_PATH. '/biens/create.php';

} , 'bien_create');
$router->map('POST ', '/bien/delete/[i:id]', function($id) use ( $router) {
    $params = ($router->match()['params']);
    require VIEW_PATH. '/biens/delete.php';

} , 'bien_delete');



$router->map('GET','/finances',function() use ($router,&$menuPages) {
    require VIEW_PATH. '/finances/index.php';
},'finances_index');

$router->map('GET | POST', '/finance/edit/[i:id]', function($id) use ( $router) {
    $params = ($router->match()['params']);
    require VIEW_PATH. '/finances/edit.php';

} , 'finance_edit');


//Get the id of the edited payment
$router->map(' GET | POST', '/finance/edit_payment/[i:id]', function($id) use ( $router) {
    $params = ($router->match()['params']);
    require VIEW_PATH. '/finances/edit_payment.php';

} , 'finance_edit_payment');


$router->map('GET | POST', '/finance/create', function() use ( $router) {
    $params = ($router->match()['params']);
    require VIEW_PATH. '/finances/create.php';

} , 'finance_create');

//Id : the id of the reglement to delette
//rId : the facture Id
$router->map('POST | GET ', '/finance/delete/[i:id]/[i:factId]?', function($id,$factId=-1) use ( $router) {
    $params = ($router->match()['params']);
    require VIEW_PATH. '/finances/delete.php';

} , 'finance_delete');

$router->map('GET | POST', '/finance/create_payment/[i:id]', function($id) use ( $router) {
    $params = ($router->match()['params']);
    require VIEW_PATH. '/finances/create_payment.php';

} , 'finance_create_payment');

$router->map('GET | POST', '/finance/list_payment/[i:id]', function($id,$delId=-1) use ( $router) {
    $params = ($router->match()['params']);
    require VIEW_PATH. '/finances/list_payment.php';

} , 'finance_list_payment');



// $router->map('GET|POST', '/finance/list_payment/[i:id]/[i:delId]', function($id,$delId) use($router) {
//     $params = ($router->match()['params']);
//     require VIEW_PATH. '/finances/list_payment.php';
//   }, 'user-details');

$match = $router->match();

dump($match);
ob_start();


// call closure or throw 404 status
if( is_array($match) && is_callable( $match['target'] ) ) {
	call_user_func_array( $match['target'], $match['params'] );
    $content = ob_get_clean();
    require VIEW_PATH . DIRECTORY_SEPARATOR . 'layouts/defaut.php';
   
} else {
	// no route was matched
	echo '404';
    //header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}

function show($id){
}

//$match['target']();


?>

