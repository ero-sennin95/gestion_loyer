<?php

use App\Model\Biens;
use App\Model\Contrat;
use App\Model\Factures;
use App\Model\Locataire;
use App\Utils;
use Valitron\Validator;

$success = false;

$pdo = App\Connection::getPDO();
$manager = new App\Model\FactureManager;

$currentFacture = new Factures();
$factures = [
        'loyer' => new Factures(),
        'charges' => new Factures()
];

$listLocataires= $manager->findAllLocataireWithContrat();
$listContrats = $manager->findAllContrat();
dump($listContrats);
//Get all locataire to fill select box
// dump($listLocataires);
$currentDate = date('Y-m-d');
$firstDate = (Utils::getFirstDateOfMonth($currentDate));
$endDate = Utils::getLasttDateOfMonth($currentDate);
//Get all biens to fill select box

//$id = (int) $id;
//dd($selectedLoc);

$errors = [];
 dump($_POST);
if(!empty($_POST)){
    Validator::lang('fr');
    $v = new Validator($_POST);
    // Disable prepending the labels
    //$v->setPrependLabels(false);
  
   
    $currentDate = $_POST['current_date_input'] ;
    $firstDate =  $_POST['period_start_Input'] ;
    $endDate = $_POST['period_end_Input'] ;

        if(!empty($_POST['montant_loyer_Input'])){
                    //unset($reglements['locataire']);
                    $factures['loyer']->setId_contrat_loc($_POST['select_contrat'])
                    ->setDate_emission($_POST['current_date_input'])
                    ->setDate_debut($_POST['period_start_Input'])
                    ->setDate_fin($_POST['period_end_Input'])
                    ->setMontant($_POST['montant_loyer_Input']);
         }
                 
        if(!empty($_POST['montant_charges_Input'])){
            $factures['charges']->setId_contrat_loc($_POST['select_contrat'])
                    ->setDate_emission($_POST['current_date_input'])
                    ->setDate_debut($_POST['period_start_Input'])
                    ->setDate_fin($_POST['period_end_Input'])
                    ->setMontant($_POST['montant_charges_Input']);
           // unset($reglements['locataire']);
            //$reglements['aide'] = new Reglement();
        }


    if($v->validate()){
       
       //  $manager->create($currentFacture);
       if(!empty($_POST['montant_loyer_Input']) && $_POST['montant_loyer_Input'] !== 0){
        dump("loyer");
        dump( $factures['loyer']);
        $manager->create($factures['loyer']);
    }
    if(!empty($_POST['montant_charges_Input'])){
        dump("charges");
        dump($factures['charges']);
        $manager->create( $factures['charges']);
    }

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
<h1>Ajouter une facture</h1>

<form action="" method="post">
    <div class="mb-3">
        <label for="select_contrat">Contrat</label>
        <select class="form-select" name="select_contrat"  aria-label="Default select example">
            <?php foreach($listContrats as $listContrat):?>

                <option value="<?=$listContrat->getId_contrat_loc()?>"><?=htmlentities($listContrat->getNameId() ?? "") ?></option>
            <?php endforeach;?>
        </select>
    </div>

    <div class="mb-3">
        <label for="select_type" class="form-label" >Type</label>
        <select class="form-select" name="select_type"  aria-label="Default select example">
            <option value="Loyer">Loyer</option>
            <option value="Loyer">indemnité d'assurance</option>
            <option value="Loyer">Depot de garantie</option>
            <option value="Loyer">Remboursement locataire</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="select_locataire" class="form-label" >Locataire</label>
        <select class="form-select" name="select_locataire"  aria-label="Default select example">
            <?php foreach($listLocataires as $listLocataire): 
                $id_locataire = $listLocataire->getId_locataire()?>
                <option value="<?=$id_locataire?>"><?=htmlentities($listLocataire->getFullName()) ?></option>
            <?php endforeach;?>
        </select>
    </div>

    <div class="mb-3">
        <label for="current_date_input" class="form-label" >Date</label>
        <input type="date" class="form-control" id="current_date_input" name="current_date_input" aria-describedby="dateHelp" value="<?=htmlentities($currentDate) ?>">
                <?php if(isset($errors['current_date_input'])):?>
                        <div class="invalid-feedback">
                            <?=implode('<br>',$errors['current_date_input'])?>
                        </div>
                <?php endif ?>  
        </select>
    </div>

   
    <div class="row mb-3">
        <div class="col">
            <label for="period_start_Input" class="form-label">De</label>
            <input type="date" class="form-control" id="period_start_Input" name="period_start_Input" aria-describedby="period1Help" value="<?=htmlentities($firstDate) ?>">
                <?php if(isset($errors['startdate'])):?>
                    <div class="invalid-feedback">
                        <?=implode('<br>',$errors['startdate'])?>
                    </div>
                <?php endif ?>  
        </div>
        <div class="col">
            <label for="period_end_Input" class="form-label">A</label>
            <input type="date" class="form-control" id="period_end_Input" name="period_end_Input" aria-describedby="period2Help" value="<?=htmlentities($endDate ) ?>">
                    <?php if(isset($errors['endtdate'])):?>
                            <div class="invalid-feedback">
                                <?=implode('<br>',$errors['enddate'])?>
                            </div>
                    <?php endif ?>  
        </div>
    </div>
  

     <div class="row">
        <div class="col">
                <label for="montant_loyer_Input" class="form-label">Montant</label>
                <input type="text" class="form-control" id="montant_loyer_Input" name="montant_loyer_Input" aria-describedby="montant_help" value="<?=htmlentities($factures['loyer']->getMontant()) ?>">
                    <?php if(isset($errors['montant'])):?>
                        <div class="invalid-feedback">
                            <?=implode('<br>',$errors['montant'])?>
                        </div>
                <?php endif ?>
        </div>
        <div class="col">
            <label for="montant_charges_Input" class="form-label">Charges</label>
            <input type="text" class="form-control" id="montant_charges_Input" name="montant_charges_Input" aria-describedby="montant_charges_help" value="<?=htmlentities($factures['charges']->getMontant()) ?>">
                <?php if(isset($errors['montant_charges'])):?>
                    <div class="invalid-feedback">
                        <?=implode('<br>',$errors['montant_charges'])?>
                    </div>
            <?php endif ?>
        </div>
     </div>

    <div class="mb-3">
    <label for="formGroupExampleInput2" class="form-label">Another label</label>
    <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Another input placeholder">
    </div>

        <button class="btn btn-primary mt-3">Ajouter</button>
</form>