<?php


use App\Model\Reglement;
use Valitron\Validator;

$success = false;
dump((int)$id);
$pdo = App\Connection::getPDO();
$manager = new App\Model\ReglementManager;

$reglements = [
            'locataire' => new Reglement(),
            'aide' => new Reglement()
];

// $currentReglement = new Reglement();
// $currentReglement->setDate(date('Y-m-d'));
// dump($reglements);


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
        $reglements['locataire']->setDate($_POST['dateLocataireInput'])
        ->setMontant($_POST['montant_loc_Input'])
        ->setIdFacture($id);

        $reglements['aide']->setDate($_POST['dateAideInput'])
        ->setMontant($_POST['aideInput'])
        ->setIdFacture($id);

    if(empty($_POST['montant_loc_Input'])){
                //unset($reglements['locataire']);
            }

          
    if(empty($_POST['aide'])){
       
       // unset($reglements['locataire']);
        //$reglements['aide'] = new Reglement();
    }
    dump($reglements);
    if($v->validate()){
        if(!empty($_POST['aideInput'])){
            dump("On ajoute aide"); 
            $manager->create( $reglements['aide']);
        }
        if(!empty($_POST['montant_loc_Input'])){
            dump("On ajoute loyer"); 
            $manager->create( $reglements['locataire']);
        }
        //$manager->create($currentReglement);
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
<h1>Ajouter un reglement</h1>

<form action="" method="post">

    
     <div class="row">
    <div class="col">
            <label for="montant_loc_Input" class="form-label">Part locataire</label>
            <input type="text" class="form-control" id="montant_loc_Input" name="montant_loc_Input" aria-describedby="montant_loc_help" value="<?=htmlentities($reglements['locataire']->getMontant()) ?>">
            <?php if(isset($errors['montant_loc'])):?>
                <div class="invalid-feedback">
                    <?=implode('<br>',$errors['montant_loc'])?>
                </div>
        <?php endif ?>
        </div>
    <div class="col">
            <label for="dateLocataireInput" class="form-label">Date de paiement</label>
            <input type="date" class="form-control" id="dateLocataireInput" name="dateLocataireInput" aria-describedby="dateHelp" value="<?=htmlentities($reglements['locataire']->getDate()) ?>">
            <?php if(isset($errors['dateLoca'])):?>
                <div class="invalid-feedback">
                    <?=implode('<br>',$errors['dateLoca'])?>
                </div>
        <?php endif ?>
    </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="aideInput" class="form-label">Aide</label>
            <input type="text" class="form-control" id="aideInput" name="aideInput"aria-describedby="aideHelp" value="<?=htmlentities($reglements['aide']->getMontant() ) ?>">
            <?php if(isset($errors['aide'])):?>
                    <div class="invalid-feedback">
                        <?=implode('<br>',$errors['aide'])?>
                    </div>
            <?php endif ?>
        </div>
        <div class="col">
                <label for="dateAideInput" class="form-label">Date de paiement</label>
                <input type="date" class="form-control" id="dateAideInput" name="dateAideInput" aria-describedby="dateAideHelp" value="<?=htmlentities($reglements['aide']->getDate()) ?>">
                <?php if(isset($errors['dateAide'])):?>
                    <div class="invalid-feedback">
                        <?=implode('<br>',$errors['dateAide'])?>
                    </div>
            <?php endif ?>
        </div>
    </div>
    <button class="btn btn-primary mt-3">Ajouter</button>
</form>