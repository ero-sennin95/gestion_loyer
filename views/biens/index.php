<?php
$menuPages = "biens";

$pdo = App\Connection::getPDO();
$biensManager = new \App\Model\BiensManager();
$biens = $biensManager->findAllContratJoin(10,15);
// dump($biens);
?>

<table class="table">
<thead>
    <tr>
      <th scope="col">Lot</th>
      <th scope="col">Type</th>
      <th scope="col">Locataire</th>
      
      <th scope="col"><a class="btn btn-primary mt-3" href="<?= $router->generate('bien_create') ?>">Ajouter</a></th>

    </tr>
  </thead>

<tbody>
<?php
foreach($biens as $bien): ?>
    <tr>
    <td><h4 class="text-primary"><?=($bien->getId_bien() . '-' .  $bien->getNom())?></h4> <?= htmlentities($bien->getAdresse1()) . '<br>' .htmlentities($bien->getVille()) ?></td>     
    <td><?=htmlentities($bien->getType_biens() ) ?></td> 
    <td><?=htmlentities($bien->getFullName()) ?></td>
    <td>
        <a class="btn btn-primary" href="">Voir</a>
        <a class="btn btn-success" href="<?= $router->generate('bien_edit', ['id' => $bien->getId_bien()]) ?>">Editer</a>
        <form method="POST"  style="display:inline"action="<?= $router->generate('bien_delete', ['id' => $bien->getId_bien()]) ?>" 
              onsubmit="return confirm('Voulez vous vraiment effectuer cette action?')">
                <button type="submit" class="btn btn-danger">Supprimer</button>
          </form>
    </td>
    </tr>
<?php endforeach ?>


    

  </tbody>
  </table>