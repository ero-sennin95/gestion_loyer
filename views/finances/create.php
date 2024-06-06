<?php

use App\Model\Biens;
use App\Model\Contrat;
use App\Model\Factures2;
use App\Model\Locataire;
use App\Utils;
use Valitron\Validator;

$success = false;

$pdo = App\Connection::getPDO();
$manager = new App\Model\FactureManager;

$currentFacture = new Factures2();
$factures = [
        'loyer' => new Factures2(),
        'charges' => new Factures2()
];

$listLocataires= $manager->findAllLocataireWithContrat();
$listContrats = $manager->findAllContrat();
$allTypes = $manager->findAlltype();  //fill select field with all available type

//Get all locataire to fill select box
// dump($listLocataires);
$currentDate = date('Y-m-d');
$firstDate = (Utils::getFirstDateOfMonth($currentDate));
$endDate = Utils::getLasttDateOfMonth($currentDate);
//Get all biens to fill select box

//$id = (int) $id;
//dd($selectedLoc);

$errors = [];
if(!empty($_POST)){
    Validator::lang('fr');
    $v = new Validator($_POST);
    // Disable prepending the labels
    //$v->setPrependLabels(false);
  
   
    $currentDate = $_POST['current_date_input'] ;
    $firstDate =  $_POST['period_start_Input'] ;
    $endDate = $_POST['period_end_Input'] ;
    if(isset($_POST['select_type'])){
        $data = explode("_",$_POST['select_type']);
        $id_type_fact = $data[0];
        $nom_type_fact = $data[1];
      }

    $currentFacture->setId_contrat_loc($_POST['select_contrat'])
                    ->setDate_emission($_POST['current_date_input'])
                    ->setDate_debut($_POST['period_start_Input'])
                    ->setDate_fin($_POST['period_end_Input'])
                    ->setMontant_fact($_POST['montant_Input'])
                    ->setId_type_fact($id_type_fact)
                    ->setDescription_ligne($_POST['description']);
                  
    if($v->validate()){
       
      $manager->create($currentFacture);
      $success = true;
    }else{
        $errors = ($v->errors());
    }
    //dd(isset($errors['firstname']));
   // dump($errors);
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
    <div class="mb-3 col-md-6">
        <label for="select_contrat">Contrat</label>
        <select class="form-select" name="select_contrat"  aria-label="Default select example">
            <?php foreach($listContrats as $listContrat):?>

                <option value="<?=$listContrat->getId_contrat_loc()?>"><?=htmlentities($listContrat->getNameId() ?? "") ?></option>
            <?php endforeach;?>
        </select>
    </div>

 

    <div class="mb-3 col-md-6">
    <label for="select_type" class="form-label ">Type</label>
      <select class="form-select" id="select_type"  name="select_type" aria-label="Default select example">
        <!-- Mettre la valeur par defaut sous la forme ID_NOM pour la recuperer dans le POST -->
        <option value="<?=$allTypes[0]->id_type_fact.'_'.$allTypes[0]->nom_type_fact?>" selected><?=$allTypes[0]->nom_type_fact?></option>
        <?php foreach($allTypes as $type): ?>
            <option value="<?=$type->id_type_fact.'_'.$type->nom_type_fact ?>"><?=$type->nom_type_fact ?></option>
        <?php endforeach?>
      </select>
    
  </div>
    <div class="mb-3 visually-hidden">
        <label for="select_locataire" class="form-label" >Locataire</label>
        <select class="form-select" name="select_locataire"  aria-label="Default select example">
            <?php foreach($listLocataires as $listLocataire): 
                $id_locataire = $listLocataire->getId_locataire()?>
                <option value="<?=$id_locataire?>"><?=htmlentities($listLocataire->getFullName()) ?></option>
            <?php endforeach;?>
        </select>
    </div>

    <div class="mb-3 col-md-6">
        <label for="current_date_input" class="form-label" >Date d'emission</label>
        <input type="date" class="form-control" id="current_date_input" name="current_date_input" aria-describedby="dateHelp" value="<?=htmlentities($currentDate) ?>">
                <?php if(isset($errors['current_date_input'])):?>
                        <div class="invalid-feedback">
                            <?=implode('<br>',$errors['current_date_input'])?>
                        </div>
                <?php endif ?>  
        </select>
    </div>

   
    <div class="row mb-3">
        <div class="col-md-3">
            <label for="period_start_Input" class="form-label">De</label>
            <input type="date" class="form-control" id="period_start_Input" name="period_start_Input" aria-describedby="period1Help" value="<?=htmlentities($firstDate) ?>">
                <?php if(isset($errors['startdate'])):?>
                    <div class="invalid-feedback">
                        <?=implode('<br>',$errors['startdate'])?>
                    </div>
                <?php endif ?>  
        </div>
        <div class="col-md-3">
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
        <div class="mb-3 col-md-6">
                <label for="montant_Input" class="form-label">Montant</label>
                <input type="text" class="form-control" id="montant_Input" name="montant_Input" aria-describedby="montant_help" value="<?=htmlentities($currentFacture->getMontant_fact()) ?>">
                    <?php if(isset($errors['montant_Input'])):?>
                        <div class="invalid-feedback">
                            <?=implode('<br>',$errors['montant_Input'])?>
                        </div>
                <?php endif ?>
        </div>
       
     </div>

    <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" class="form-control" id="description" name="description" placeholder="Description">
    </div>

        <button class="btn btn-primary mt-3">Ajouter</button>
</form>