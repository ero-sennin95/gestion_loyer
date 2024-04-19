
<?php

use App\Model\ContratManager;

$pdo = App\Connection::getPDO();
$manager = new App\Model\ContratManager();
var_dump($id);
var_dump($params);
$manager->delete($id); //TODO check constraint to null
header('Location: ' . $router->generate('contrats_index') . '?delete=1')

?>
<h1>Delete</h1>