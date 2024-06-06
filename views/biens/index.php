<?php
$menuPages = "biens";

$pdo = App\Connection::getPDO();
$biensManager = new \App\Model\BiensManager();

$page = $_GET['page'] ?? 1;

//Check params page
if(!filter_var($page,FILTER_VALIDATE_INT)){
 throw new Exception("Invalid page number", 1);
}

//Set the current page
$currentPage =(int) $page;
if($currentPage <= 0){
  throw new Exception("Invalid page number", 1);
}

$count = (int)$biensManager->count();
$perPage = 10;

if($count>0){
  
  $pages = ceil($count / $perPage) ;
  if($currentPage > $pages){
    throw new Exception("Page doesn't exist", 1);
  }
  $offset = $perPage * ($currentPage - 1);
  $biens = $biensManager->findAllContratJoin($perPage,$offset);
}
 

// $biensManager->updateLoc(1,3);

dump("nombre de page(s) " . $page);
dump("nombre d'entée(s) " . $count);

dump($biens);


?>
<?php if($count>0):?>
<!-- Afficher le message flash -->
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
      <th scope="col">Lot</th>
      <th scope="col">Type</th>
      <th scope="col">Locataire</th>
      
      <th scope="col"><a class="btn btn-primary btn-sm" href="<?= $router->generate('bien_create') ?>">Ajouter</a></th>

    </tr>
  </thead>

<tbody>
  <?php
    foreach($biens as $bien): ?>
        <tr>
        <td><h5 class="text-primary"><?=($bien->getId_bien() . '-' . $bien->getPrefix() .' '. $bien->getNom())?></h5> <?= htmlentities($bien->getAdresse1()) . '<br>' .htmlentities($bien->getVille()) ?></td>     
        <td><?=htmlentities($bien->getType_biens() ) ?></td> 
        <td><?=htmlentities($bien->getFullName()) ?></td>
        <td>
            <a class="btn btn-outline-success btn-sm" href="">Voir</a>
            <a class="btn btn-outline-warning btn-sm" href="<?= $router->generate('bien_edit', ['id' => $bien->getId_bien()]) ?>">Editer</a>
            <form method="POST"  style="display:inline"action="<?= $router->generate('bien_delete', ['id' => $bien->getId_bien()]) ?>" 
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
      $link = $router->generate('biens_index');
      if($currentPage>2) $link .= '?page=' . ($currentPage -1);
      ?>
      <a class="btn btn-primary"href="<?=$link?>">&laquo; Page précédente</a>
    <?php endif?>
    <?php if($currentPage < $pages):?>
      <a class="btn btn-primary ms-auto" href="<?=$router->generate('biens_index')?>?page=<?=$currentPage + 1?>">Page suivante &raquo;</a>
    <?php endif?>
  </div>

<?php else : ?>
  <!-- Si aucun bien -->
    <h2>Veuillez créer un nouveau biens <a class="btn btn-primary mt-3" href="<?= $router->generate('bien_create') ?>">Ajouter</a> </h2>
<?php endif ?>