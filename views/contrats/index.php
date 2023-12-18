<?php 
//  echo  dirname(__DIR__) ;
//  require  dirname(__DIR__) . '/vendor/autoload.php';

 $title = "Contrats";

$pdo = App\Connection::getPDO();
$lman = new \App\Model\ContratManager();
/** @var array Contrat|false */

$page = $_GET['page'] ?? 1;
if(!filter_var($page,FILTER_VALIDATE_INT)){
 throw new Exception("Invalid page number", 1);
}

// if($page === '1'){
//   header('location: ' .$router->generate('locataires_index'));
//   http_response_code(301);
//   exit();
// }
$currentPage =(int) $page;
if($currentPage <= 0){
  throw new Exception("Invalid page number", 1);
}

$count = (int)$lman->count();
$perPage = 12;
$pages = ceil($count / $perPage) ;
if($currentPage > $pages){
  throw new Exception("Page doesn't exist", 1);
}
$offset = $perPage * ($currentPage - 1);

//$contrats = $lman->findAllPaginated($perPage,$offset);
$contrats = $lman->findAllContratJoin($perPage,$offset);
if(!$contrats){
  throw new exception("No contract available", 1);
}

 var_dump($currentPage);
// exit;
?>
<h1>Contrats</h1>
<table class="table">
<thead>
    <tr>
      <th scope="col">Bien</th>
      <th scope="col">Type</th>
      <th scope="col">Locataire</th>
      <th scope="col">Loyer</th>
      <th scope="col">Depot</th>
      <th scope="col">Durée</th>
      <th scope="col">Action</th>

    </tr>
  </thead>

<tbody>
<?php
foreach($contrats as $contrat): ?>
    <tr>
      <td><?=$contrat->getId_contrat_loc() ?></td>
      <td><?=htmlentities("Bail d'habitation vide") ?></td>  <! -- Ajouter type de bail -->  
      <td><?=htmlentities($contrat->getFullName() ) ?></td>
      <td><?=htmlentities($contrat->getLoyer_mensuel()) ?></td>
      <td><?=htmlentities($contrat->getCaution()) ?></td>
      <td><?=htmlentities($contrat->getDate_entree()) ?></td>
      
      <td><a class="btn btn-primary" href="">Voir</a></td>

    </tr>
<?php endforeach ?>
  </tbody>
  </table>

  <div class="d-flex justify-content-between my-4">
    <?php if($currentPage>1):?>
      <?php
      $link = $router->generate('contrats_index');
      if($currentPage>2) $link .= '?page=' . ($currentPage -1);
      ?>
      <a class="btn btn-primary"href="<?=$link?>">&laquo; Page précédente</a>
    <?php endif?>
    <?php if($currentPage < $pages):?>
      <a class="btn btn-primary ms-auto"href="<?=$router->generate('contrats_index')?>?page=<?=$currentPage + 1?>">Page suivante &raquo;</a>
    <?php endif?>
  </div>

