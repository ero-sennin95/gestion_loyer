<?php 
//  echo  dirname(__DIR__) ;
//  require  dirname(__DIR__) . '/vendor/autoload.php';

 $title = "Contrats";
 //dump($menuPages);
 $menuPages = "contrats";

$pdo = App\Connection::getPDO();
$lman = new \App\Model\ContratManager();
$biensManager = new \App\Model\BiensManager();
// $biensManager->updateLoc(1,9);

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
if($currentPage > $pages && $count!=0){
  throw new Exception("Page doesn't exist", 1);
}
$offset = $perPage * ($currentPage - 1);

//$contrats = $lman->findAllPaginated($perPage,$offset);
$contrats = $lman->findAllContratJoin($perPage,$offset);
if(!$contrats && $count!=0){
  throw new exception("No contract available", 1);
}

// dump($_SESSION);

 //var_dump($currentPage);
// exit;
?>

<?php if(!empty($_SESSION['flash']['message'])) :?>
    <div class="alert alert-success mt-4">
      <?php echo $_SESSION['flash']['message'] ;
      unset($_SESSION['flash']['message']);
      ?>
  </div>

<?php endif?>



<table class="table mt-3">
<thead>
    <tr>
      <th scope="col">Bien</th>
      <th scope="col">Type</th>
      <th scope="col">Locataire</th>
      <th scope="col">Loyer</th>
      <th scope="col">Depot</th>
      <th scope="col">Durée</th>
      <th scope="col"><a class="btn btn-primary btn-sm " href="<?= $router->generate('contrat_create') ?>">Ajouter</a></th>

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
      
      
      <td>
        <a class="btn btn-outline-success btn-sm " href="">Voir</a>
        <a class="btn btn-outline-warning btn-sm" href="<?= $router->generate('contrat_edit', ['id' => $contrat->getId_contrat_loc()]) ?>">Editer</a>
        <form method="POST"  style="display:inline" action="<?= $router->generate('contrat_delete', ['id' => $contrat->getId_contrat_loc()]) ?>" 
              onsubmit="return confirm('Voulez vous vraiment effectuer cette action?')">
                <button type="submit" class="btn btn-outline-danger btn-sm">Supprimer</button>
          </form>
    </td>

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

