<?php

use Valitron\Validator;

$success = false;

$pdo = App\Connection::getPDO();
$manager = new App\Model\BiensManager();

$id = (int) $id;
dump($id);
$selectedBiens = $manager->findBienById($id);
//$selectedBien = $manager->findBiensById()
dump($selectedBiens);

$var1 = "Hello";
$var2 = "hello";
if (strcmp($var1, $var2) !== 0) {
    echo '$var1 is not equal to $var2 in a case sensitive string comparison';
}
dump(strcmp('Appartement', $selectedBiens->getType_biens()));
dump(strcmp('Garage', $selectedBiens->getType_biens()));
dump(strcmp('Autres', $selectedBiens->getType_biens()));


$errors = [];
var_dump($_POST);
if(!empty($_POST)){
    Validator::lang('fr');
    $v = new Validator($_POST);
    // Disable prepending the labels
    //$v->setPrependLabels(false);
    /*
    Specific rule
    */
    // 'typeInput' => string 'dav' (length=3)
    // 'nameInput' => string 'dav' (length=3)
    // 'adresseInput' => string '12 rue de la paix' (length=17)
    // 'adresseInput2' => string 'rue jaen jaures' (length=15)
    // 'villeInput' => string 'paris' (length=5)
    // 'code_postal_Input' => string '95000' (length=5)
    // 'descriptionArea' => string 'Une villa magnifique' (length=20)
        $selectedBiens->setNom($_POST['nameInput'])
                        ->setAdresse1($_POST['adresseInput'])
                        ->setAdresse2($_POST['adresseInput2'])
                        ->setType_biens($_POST['typeInput'])
                        ->setVille($_POST['villeInput'])
                        ->setCp($_POST['code_postal_Input'])
                        ->setDescription($_POST['descriptionArea']);


    if($v->validate()){
          $manager->update($selectedBiens);
        $success = true;
    }else{
        $errors = ($v->errors());
    }
    
    dump($errors);
}

?>
<?php if($success) :?>
    <div class="alert alert-success mt-4">
      L'enregistrement a bien été modifié
  </div>
<?php endif?>

<h1>Edition du bien : <?= $selectedBiens->getId_bien()?> </h1>

<form action="" method="post">

    <div class="form-group">
        <label for="typeInput">Type de logement</label>
        <select class="form-select" name="typeInput"   aria-label="Default select example" >
              <option value="Appartement" <?= strcmp('Appartement', $selectedBiens->getType_biens())===0 ?'selected': '' ?> >Appartement</option>
              <option value="Garage "  <?= strcmp('Garage', $selectedBiens->getType_biens())===0 ?'selected': '' ?> >Box/garage</option>
              <option value="Autres"> <?= strcmp('Autres', $selectedBiens->getType_biens())===0 ?'selected': '' ?>Autres</option>
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