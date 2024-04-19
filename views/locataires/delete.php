
<?php

use App\Model\LocataireManager;

$pdo = App\Connection::getPDO();
$manager = new App\Model\LocataireManager();
var_dump($id);
var_dump($params);
$manager->delete($id);// TODO check constraint to null
header('Location: ' . $router->generate('locataires_index') . '?delete=1')

?>
<h1>Delete</h1>