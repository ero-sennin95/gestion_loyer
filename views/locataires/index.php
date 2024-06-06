<?php 
//  echo dirname(__DIR__) ;
//  require  dirname(__DIR__) . '/vendor/autoload.php';

 $title = "locataires";
 $menuPages = "locataires";
//App\Auth::check();

$pdo = App\Connection::getPDO();
$lman = new \App\Model\LocataireManager();
// $query = $pdo->query("SELECT * FROM locataire ORDER BY nom DESC LIMIT 12");
// $locataires = $query->fetchAll(PDO::FETCH_OBJ);
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
if($count>0){
  $pages = ceil($count / $perPage) ;
  if($currentPage > $pages){
    throw new Exception("Page doesn't exist", 1);
  }
  $offset = $perPage * ($currentPage - 1);
  $locataires = $lman->findAllPaginated($perPage,$offset);
}

//  dump($locataires);
// exit;
?>

<?php if(isset($_GET['delete'])): ?>
  <div class="alert alert-success mt-4">
      L'enregistrement a bien été supprimé
  </div>
<?php endif; ?>


<?php if($count>0):?>
 
    <?php if(!empty($_SESSION['flash']['message'])) :?>
      <div class="alert alert-success mt-4">
        <?php echo $_SESSION['flash']['message'] ;
          unset($_SESSION['flash']['message']);
        ?>
      </div>

    <?php endif?>

<table class="table">
<thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nom</th>
      <th scope="col">Prenom</th>
      <th scope="col">email</th>
      <th scope="col">Date de naissance</th>
      <th scope="col"><a class="btn btn-primary btn-sm " href="<?= $router->generate('locataire_create') ?>">Ajouter</a></th>
    </tr>
  </thead>

<tbody>
<?php

foreach($locataires as $locataire): ?>
    <tr>
      <th scope="row"><?=$locataire->getId_locataire() ?></th>
      <td><?=htmlentities($locataire->getNom()) ?></td>
      <td><?=htmlentities($locataire->getPrenom()) ?></td>
      <td><?=htmlentities($locataire->getEmail()) ?></td>
      <td><?=($locataire->getDate_naissance()) ?></td>
      <td><a class="btn btn-outline-success btn-sm " href="<?= $router->generate('locataire_details', ['id' => $locataire->getId_locataire()]) ?>">Voir</a>
          <a class="btn btn-outline-warning btn-sm " href="<?= $router->generate('locataire_edit', ['id' => $locataire->getId_locataire()]) ?>">Editer</a>
          <form method="POST"  style="display:inline"action="<?= $router->generate('locataire_delete', ['id' => $locataire->getId_locataire()]) ?>" 
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
      $link = $router->generate('locataires_index');
      if($currentPage>2) $link .= '?page=' . ($currentPage -1);
      ?>
      <a class="btn btn-primary"href="<?=$link?>">&laquo; Page précédente</a>
    <?php endif?>
    <?php if($currentPage < $pages):?>
      <a class="btn btn-primary ms-auto" href="<?=$router->generate('locataires_index')?>?page=<?=$currentPage + 1?>">Page suivante &raquo;</a>
    <?php endif?>
  </div>

  <?php else : ?>
    <h2>Veuillez créer un nouveau client <a class="btn btn-primary mt-3" href="<?= $router->generate('locataire_create') ?>">Ajouter</a> </h2>
    
    

<?php endif ?>
