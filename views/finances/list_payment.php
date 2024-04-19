<?php

use App\Model\Biens;
use App\Model\Contrat;
use App\Model\Factures;
use App\Model\Locataire;
use App\Model\Reglement;
use App\Model\ReglementManager;
use App\Utils;
use Valitron\Validator;

$success = false;

$pdo = App\Connection::getPDO();
$manager = new App\Model\FactureManager;


$reglementManager = new ReglementManager();
$reglementsByFactureId = $reglementManager->findReglementByFacureId($id);
$idFacute = $id;
//var_dump($reglementsByFactureId);
//$id = (int) $id;
//dd($selectedLoc);

$errors = [];
var_dump($_POST);
if(!empty($_POST)){
    Validator::lang('fr');
    $v = new Validator($_POST);
    // Disable prepending the labels
    //$v->setPrependLabels(false);
  
   

    if($v->validate()){
        // $manager->create($currentFacture);
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
<h1>List payment</h1>

<form action="" method="post">
<div class="mb-3">
    <?php foreach($reglementsByFactureId as $reglement): ?>
             <div class="row mb-3">
                <div class="col">
                    <input type="text" id="montant_Input" name="montant_Input" class="form-control" placeholder="Montant" aria-label="Montant" value="<?=htmlentities($reglement->getMontant()) ?>" >
                    <?php if(isset($errors['montant'])):?>
                        <div class="invalid-feedback">
                            <?=implode('<br>',$errors['montant'])?>
                        </div>
                    <?php endif ?>
                </div>
                <div class="col">
                    <input type="text" class="form-control" id="payeur_input" name="payeur_input" placeholder="De" aria-label="De" value="<?=htmlentities($reglement->getPayeur())?>">
                    <?php if(isset($errors['payeur'])):?>
                        <div class="invalid-feedback">
                            <?=implode('<br>',$errors['payeur'])?>
                        </div>
                    <?php endif ?>
                </div>
                <div class="col">
                    <input type="text" id="date_input" name="date_input" class="form-control" placeholder="Date" aria-label="Date" value="<?=htmlentities($reglement->getDate())?>">
                    <?php if(isset($errors['payeur'])):?>
                        <div class="invalid-feedback">
                            <?=implode('<br>',$errors['payeur'])?>
                        </div>
                    <?php endif ?>
                </div>
                <div class="col">
                    <a href="<?= $router->generate('finance_delete',['id' => $reglement->getIdReglement(),'factId' => $idFacute])?>" class="btn btn-primary">Suppimer</a>
                    <a href="" class="btn btn-primary">Suppimer Bis</a>

                    <a href="" class="btn btn-primary">Modifier</a>
                </div>
                
                
            </div>
        
    <?php endforeach ?>
    </div>
    
    <button class="btn btn-primary mt-3">Modifier</button>

</form>