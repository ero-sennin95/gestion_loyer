<?php

use App\Model\Locataire;
use App\Model\LocataireManager;
$path = dirname(__DIR__) ; 
echo $path;
$locMan = new LocataireManager();
$id = (int) $id;

/**  @var Locataire|false*/
$result = $locMan->findLocataireById($id);
if(!$result){
throw new Exception("Not a valid Id", 1);
}

?>
<h1>Details page</h1>
<p>Bonjour, <?= $result->getNom()?></p>

<div class="card" >
    <div class="card-body">
    <h5 class="card-title"><?= $result->getNom()?></h5>
    <h6 class="card-title"><?= $result->getPrenom()?></h6>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
</div>

