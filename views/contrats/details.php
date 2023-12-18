<?php

use App\Model\Contrat;
use App\Model\ContratManager;
$path = dirname(__DIR__) ; 
echo $path;
$contrMan = new ContratManager();
$id = (int) $id;

/**  @var Contrat|false*/
$result = $contrMan->findContratById($id);
if(!$result){
  throw new Exception("Not a valid Id", 1);
}

?>
<h1>Details page</h1>
<p>Bonjour, <?= $result->getId_contrat_loc()?></p>

<div class="card" >
    <div class="card-body">
    <h5 class="card-title"><?= "a" ?></h5>
    <h6 class="card-title"><?= "a" ?></h6>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
</div>

