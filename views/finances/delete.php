
<?php

use App\Model\BiensManager;
use App\Model\ReglementManager;

$pdo = App\Connection::getPDO();
$manager = new ReglementManager();
dump($id);
dump($factId);
// var_dump($params);
$manager->delete($id); //TODO check constraint to null
header('Location: ' .$router->generate('finance_edit',['id' => $factId]) . '?delete=1')

?>
<h1>Delete</h1>