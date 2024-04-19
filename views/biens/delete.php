
<?php

use App\Model\BiensManager;

$pdo = App\Connection::getPDO();
$manager = new BiensManager();
var_dump($id);
var_dump($params);
$manager->delete($id); //TODO check constraint to null
header('Location: ' . $router->generate('biens_index') . '?delete=1')

?>
<h1>Delete</h1>