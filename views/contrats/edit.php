<?php

use Valitron\Validator;

$success = false;

$pdo = App\Connection::getPDO();
$manager = new App\Model\ContratManager();

$id = (int) $id;
$selectedContrat = $manager->findContratById($id);
//$selectedBien = $manager->findBiensById()
// dump($selectedContrat);

//Get all locataire to fill select box
$listLocataires = $manager->findAllLocataires();
// dump($listLocataires);

//Get all biens to fill select box
$listBiens = $manager->findAllBiens();
// dump($listBiens);

//memorise selected locataire and biens to check the correct select
$id_selected_loc =(int) $selectedContrat->getid_locataire();
$id_selected_bien =(int) $selectedContrat->getid_bien();
// dump($id_selected_bien);

// $selectedLocataire = $manager->findLocataireById($id_selected_loc);

// dump($listLocataires);

$errors = [];
// var_dump($_POST);
if(!empty($_POST)){
    Validator::lang('fr');
    $v = new Validator($_POST);
    // Disable prepending the labels
    //$v->setPrependLabels(false);
    //dump($selectedContrat);
    /*
    Specific rule
    */
    // 'bail_type' => string '1' (length=1)
    // 'select_locataire' => string '4' (length=1)
    // 'select_bien' => string '5' (length=1)
    // 'loyer' => string '721.5' (length=5)
    // 'charges' => string '68' (length=2)
    // 'caution' => string '551' (length=3)
    // 'duree' => string '7' (length=1)
    // 'date_entree' => string '1980-03-30' (l
    //require "_rules.php" ;
    // ->setNotes($_POST['note'])
    // ->setJour_versement($_POST['jour'])

 $selectedContrat->setId_locataire((int)$_POST['select_locataire'])
                ->setId_bien((int)$_POST['select_bien'])
                ->setLoyer_mensuel($_POST['loyer'])
                ->setProv_charges($_POST['charges'])
                ->setCaution($_POST['caution'])
                ->setDate_entree($_POST['date_entree'])
                ->setDuree_bail($_POST['duree']);

   // dump($selectedContrat);

    if($v->validate()){
        $manager->update($selectedContrat);
        $success = true;
    }else{
        $errors = ($v->errors());
    }
    
    //dump($errors);
}

?>
<?php if($success) :?>
    <div class="alert alert-success mt-4">
      L'enregistrement a bien été modifié
  </div>
<?php endif?>

<h1>Edition du Contrat : <?= $selectedContrat->getId_contrat_loc()?> </h1>

<form action="" method="post">
    <div class="form-group">
        <label for="bail_type">Type de bail</label>
        <select class="form-select" name="bail_type"  aria-label="Default select example">
              <option value="1">Bail particulier</option>
              <option value="2">Bail Commercial</option>
              <option value="3">Box,garage</option>

    </select>
    </div>

    
    <div class="form-group">
    <label for="select_locataire">Locataire</label>
        <select class="form-select" name="select_locataire"  aria-label="Default select example">
            
            <?php foreach($listLocataires as $listLocataire): ?>
               <?php $id_locataire = (int)$listLocataire->getId_locataire();?>
                <option value="<?=$id_locataire?>"<?=$id_locataire === $id_selected_loc ? 'selected' : ''?>><?=htmlentities($id_locataire .' ' .$listLocataire->getNom() . ' ' .$listLocataire->getPrenom()) ?></option>
            <?php endforeach;?>
        </select>
    </div>
    <div class="form-group">
    <label for="select_bien">Biens</label>
        <select class="form-select" name="select_bien"  aria-label="Default select example">
        <option value="">-- Selectionner un bien --</option>
            <?php foreach($listBiens as $listBien): 
            dump($id_selected_bien);
                $id_bien = (int)$listBien->getId_bien()?>
                <option value="<?=$id_bien?>"<?=$id_bien === $id_selected_bien ? 'selected' : ''?>><?=htmlentities($id_bien  .' ' . $listBien->getAdresse1() ) ?></option>
            <?php endforeach;?>
        </select>
    </div>
    <div class="form-group">
    <label for="loyer">Montant du loyer</label>
        <input type="text" class="form-control <?=isset($errors['loyer']) ? 'is-invalid' : '' ?>" name="loyer" value="<?=htmlentities($selectedContrat->getLoyer_mensuel())?>">
        <?php if(isset($errors['loyer'])):?>
                <div class="invalid-feedback">
                    <?=implode('<br>',$errors['loyer'])?>
                </div>
        <?php endif ?>
    </div>

    <div class="form-group">
    <label for="charges">Montant des charges</label>
        <input type="number" class="form-control <?=isset($errors['charges']) ? 'is-invalid' : '' ?>" name="charges" value="<?=htmlentities($selectedContrat->getProv_charges())?>">
        <?php if(isset($errors['charges'])):?>
                <div class="invalid-feedback">
                    <?=implode('<br>',$errors['charges'])?>
                </div>
        <?php endif ?>
    </div>

    <div class="form-group">
    <label for="caution">Depot de garantie</label>
        <input type="number" class="form-control <?=isset($errors['caution'])? 'is-invalid' : '' ?>" name="caution" value="<?=htmlentities($selectedContrat->getCaution())?>">
        <?php if(isset($errors['caution'])):?>
                <div class="invalid-feedback">
                    <?=implode('<br>',$errors['caution'])?>
                </div>
        <?php endif ?>
    </div>
    <div class="form-group">
    <label for="duree">Durée du bail</label>
        <input type="number" class="form-control <?=isset($errors['duree'])? 'is-invalid' : '' ?>" name="duree" value="<?=htmlentities($selectedContrat->getDuree_bail())?>">
        <?php if(isset($errors['duree'])):?>
                <div class="invalid-feedback">
                    <?=implode('<br>',$errors['duree'])?>
                </div>
        <?php endif ?>
    </div>

    <div class="form-group">
    <label for="date_entree">Date d'entrée'</label>
        <input type="date" class="form-control <?=isset($errors['date_entree'])? 'is-invalid' : '' ?>" name="date_entree" value="<?=htmlentities($selectedContrat->getDate_entree())?>">
        <?php if(isset($errors['date_entree'])):?>
                <div class="invalid-feedback">
                    <?=implode('<br>',$errors['date_entree'])?>
                </div>
        <?php endif ?>
    </div>
    <button class="btn btn-primary mt-3">Modifier</button>
</form>