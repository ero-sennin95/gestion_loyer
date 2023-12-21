<?php

$success = false;

$pdo = App\Connection::getPDO();
$manager = new App\Model\LocataireManager();
$id = (int) $id;
$selectedLoc = $manager->findLocataireById($id);
var_dump($_POST);
if(!empty($_POST)){
    $selectedLoc->setNom($_POST['lastname']);
    $manager->update($selectedLoc);
    $success = true;
}

?>
<?php if($success) :?>
    <div class="alert alert-success mt-4">
      L'enregistrement a bien été modifié
  </div>
<?php endif?>
<h1>Edit page <?= $selectedLoc->getNom()?></h1>

<form action="" method="post">
    <div class="form-group">
        <label for="lastname">Nom</label>
        <input type="text" class="form-control" name="lastname" value="<?=htmlentities($selectedLoc->getNom())?>">
    </div>

    <div class="form-group">
    <label for="firstname">Prenom</label>
        <input type="text" class="form-control" name="firstname" value="<?=htmlentities($selectedLoc->getPrenom())?>">
    </div>

    <div class="form-group">
    <label for="eMail">Prenom</label>
        <input type="email" class="form-control" name="eMail" value="<?=htmlentities($selectedLoc->getEmail())?>">
    </div>
    
    <button class="btn btn-primary mt-3">Modifier</button>
</form>