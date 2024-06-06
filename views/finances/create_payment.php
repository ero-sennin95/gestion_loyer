<?php


use App\Model\Reglement;
use Valitron\Validator;

$success = false;
// dump((int)$id);
$pdo = App\Connection::getPDO();
$manager = new App\Model\ReglementManager;
$reglement =  new Reglement();
$allPayeur = $manager->findAllPayeur();
// dump($allPayeur);
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
// var_dump($_POST);
if(!empty($_POST)){
    Validator::lang('fr');
    $v = new Validator($_POST);
    // Disable prepending the labels
    //$v->setPrependLabels(false);
        $reglement->setDateReglement($_POST['datePaiementInput'])
                    ->setMontantRegl($_POST['montant_Input'])
                    ->setIdFacture($id)
                    ->setid_payeur($_POST['payeur_select']);


    // dump($reglements);
    if($v->validate()){
        $manager->create( $reglement);
     
        //$manager->create($currentReglement);
        $success = true;
        header('Location: ' .$router->generate('finances_index'));
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
        <div class="col-md-3">
            <label for="montant_Input" class="form-label">Paiement reçu</label>
            <input type="text" class="form-control" id="montant_Input" name="montant_Input" aria-describedby="montant_help" value="<?=htmlentities($reglement->getMontantRegl()) ?>">
            <?php if(isset($errors['montant_loc'])):?>
                <div class="invalid-feedback">
                    <?=implode('<br>',$errors['montant_loc'])?>
                </div>
            <?php endif ?>
        </div>
        <div class="col-md-3">
            <label for="payeur_select" class="form-label ">Payeur</label>
            <select class="form-select" id="payeur_select"  name="payeur_select" aria-label="Default select example">
                <!-- Mettre la valeur par defaut sous la forme ID_NOM pour la recuperer dans le POST -->
               
                <?php foreach($allPayeur as $payeur): ?>
                    <option value="<?=$payeur->id_payeur ?>"><?=$payeur->nom_payeur ?></option>
                <?php endforeach?>
            </select>
        </div>
        <div class="col-md-3">
            <label for="datePaiementInput" class="form-label">Date de paiement</label>
            <input type="date" class="form-control" id="datePaiementInput" name="datePaiementInput" aria-describedby="dateHelp" value="<?=htmlentities($reglement->getDateReglement()) ?>">
            <?php if(isset($errors['dateLoca'])):?>
                <div class="invalid-feedback">
                    <?=implode('<br>',$errors['dateLoca'])?>
                </div>
        <?php endif ?>
        </div>
    </div>
    
    <button class="btn btn-primary mt-3">Ajouter</button>
</form>