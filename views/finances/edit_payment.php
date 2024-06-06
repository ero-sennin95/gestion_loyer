<?php
use Valitron\Validator;

dump((int)$id);

$paymentManager = new \App\Model\ReglementManager();
$reglement = $paymentManager->findReglementById((int)$id);
dump($reglement);
$errors = [];
dump($_POST);
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

    $reglement->setMontantRegl($_POST['montant_regl'])
                ->setDateReglement($_POST['date_regl'])
                ->setDescription_regl($_POST['description_regl']);

   // dump($selectedContrat);

    if($v->validate()){
        $paymentManager->update($reglement);
        $success = true;
        header('Location: ' . $router->generate('finance_edit',['id' =>$reglement->getIdFacture()]) . '?delete=1');
    }else{
        $errors = ($v->errors());
    }
    
    //dump($errors);
}

?>


<h1>Modifier paiement</h1>

<p><?=$reglement->getDateReglement() . ' ' . $reglement->getMontantRegl() . ' ' . $reglement->getDescription_regl()?></p>
<form method="post">
  <div class="mb-3">
    <label for="date_regl" class="form-label" >Date de paiement</label>
    <input type="date" class="form-control" id="date_regl" name="date_regl" value="<?= $reglement->getDateReglement() ?>" >
   
  </div>
  <div class="mb-3">
    <label for="montant_regl" class="form-label" >Montant</label>
    <input  type="text" class="form-control" id="montant_regl" name="montant_regl" value="<?= $reglement->getMontantRegl() ?>">
  </div>
  <div class="mb-3">
    <label class="form-label" for="description_regl" >Description</label>
    <input type="text" class="form-control" id="description_regl"  name="description_regl" value="<?=$reglement->getDescription_regl()?>">
  </div>
  <button type="submit" class="btn btn-primary">Modifier</button>
</form>
      
     
      
   