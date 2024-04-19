<?php

use App\Model\Biens;
use App\Model\Contrat;
use App\Model\Locataire;
use Valitron\Validator;

$success = false;

$pdo = App\Connection::getPDO();
$manager = new App\Model\BiensManager;

$selectedBiens = new Biens();
//Get all locataire to fill select box
// dump($listLocataires);

//Get all biens to fill select box

//$id = (int) $id;
//dd($selectedLoc);

$errors = [];
var_dump($_POST);
if(!empty($_POST)){
    Validator::lang('fr');
    $v = new Validator($_POST);
    // Disable prepending the labels
    //$v->setPrependLabels(false);
  
    $selectedBiens->setNom($_POST['nameInput'])
                ->setAdresse1($_POST['adresseInput'])
                ->setAdresse2($_POST['adresseInput2'])
                ->setCp($_POST['code_postal_Input'])
                ->setVille($_POST['villeInput'])
                ->setDescription($_POST['descriptionArea'])
                ->setType_biens($_POST['typeInput']);


    if($v->validate()){
         $manager->create($selectedBiens);
        $success = true;
    }else{
        $errors = ($v->errors());
    }
    //dd(isset($errors['firstname']));
    dump($errors);
}

?>
<?php if($success) :?>
    <div class="alert alert-success mt-4">
      L'enregistrement a bien été enregistré
  </div>
<?php endif?>
<?php if(!empty($errors)) :?>
    <div class="alert alert-danger mt-4">
      L'enregistrement n'a pas été enregistré
  </div>
<?php endif?>
<h1>Ajouter un bien</h1>

<form action="" method="post">

    <div class="form-group">
        <label for="typeInput">Type de logement</label>
        <select class="form-select" name="typeInput"  aria-label="Default select example">
              <option value="Appartement" selected>Appartement</option>
              <option value="Box">Box/garage</option>
              <option value="Autres">Autres</option>

    </select>
    <?php if(isset($errors['type'])):?>
                <div class="invalid-feedback">
                    <?=implode('<br>',$errors['type'])?>
                </div>
        <?php endif ?>
    </div>

   <div class="form-group">
            <label for="nameInput" class="form-label">Identifiant</label>
            <input type="text" class="form-control" id="nameInput" name="nameInput" aria-describedby="nameHelp" value="<?=htmlentities($selectedBiens->getNom()) ?>">
            <div id="nameInput" class="form-text">Saisir un identifiant, référence ou numéro unique</div>
            <?php if(isset($errors['name'])):?>
                <div class="invalid-feedback">
                    <?=implode('<br>',$errors['name'])?>
                </div>
        <?php endif ?>
    </div>
        <div class="form-group">
            <label for="adresseInput" class="form-label">Adresse</label>
            <input type="text" class="form-control" id="adresseInput" name="adresseInput"aria-describedby="adresseHelp" value="<?=htmlentities($selectedBiens->getAdresse1()) ?>">
            <?php if(isset($errors['adresse1'])):?>
                <div class="invalid-feedback">
                    <?=implode('<br>',$errors['adresse1'])?>
                </div>
        <?php endif ?>
    </div>

    <div class="form-group">
            <label for="adresseInput2" class="form-label">Adresse 2</label>
            <input type="text" class="form-control" id="adresseInput2" name="adresseInput2" aria-describedby="adresse2Help" value="<?=htmlentities($selectedBiens->getAdresse2()) ?>">
            <?php if(isset($errors['adresse2'])):?>
                <div class="invalid-feedback">
                    <?=implode('<br>',$errors['adresse2'])?>
                </div>
        <?php endif ?>
    </div>

    <div class="form-group">
            <label for="villeInput" class="form-label">Ville</label>
            <input type="text" class="form-control" id="villeInput" name="villeInput" aria-describedby="villeHelp" value="<?=htmlentities($selectedBiens->getVille()) ?>">
            <?php if(isset($errors['ville'])):?>
                <div class="invalid-feedback">
                    <?=implode('<br>',$errors['ville'])?>
                </div>
        <?php endif ?>
    </div>

    <div class="form-group">
            <label for="code_postal_Input" class="form-label">Code postale</label>
            <input type="text" class="form-control" id="code_postal_Input" name="code_postal_Input" aria-describedby="cp_Help" value="<?=htmlentities($selectedBiens->getCp()) ?>">
            <?php if(isset($errors['code'])):?>
                <div class="invalid-feedback">
                    <?=implode('<br>',$errors['code'])?>
                </div>
        <?php endif ?>
    </div>
    
    <div class="form-floating mt-3">
        <textarea class="form-control" placeholder="Leave a comment here" id="descriptionArea" name="descriptionArea" style="height: 100px"><?=htmlentities($selectedBiens->getDescription())?></textarea>
        <label for="floatingTextarea2">Description</label>
        <?php if(isset($errors['description'])):?>
                <div class="invalid-feedback">
                    <?=implode('<br>',$errors['description'])?>
                </div>
        <?php endif ?>
    </div>
    <button class="btn btn-primary mt-3">Modifier</button>
</form>