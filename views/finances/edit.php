<?php

use App\Functions;
use App\Model\BiensManager;
use App\Model\ContratManager;
use App\Model\Reglement;
use App\Model\ReglementManager;
use Valitron\Validator;

$success = false;

$pdo = App\Connection::getPDO();
$fact_manager = new App\Model\FactureManager;
$bien_manager = new BiensManager;
$contrat_manager = new ContratManager;
$reglements_manager = new ReglementManager;

// $test = Functions::checked(1,1);

$factId = (int) $id;
// dump($factId);
$selectedFacture = $fact_manager->findFactureById($factId);  //get data of  the facture need to be edited
dump($selectedFacture);
$allBiens = $bien_manager->findAll(); //  fill select field with all available biens
$allContrat = $contrat_manager->findAll(); //fill select field with all available contrat
$allTypes = $fact_manager->findAlltype();  //fill select field with all available type

$factDetail = $fact_manager->findLigneFactById($factId);
$reglements = $reglements_manager->findReglementByFacureId($factId);
dump($reglements);
//$currentContrat = $contrat_manager->findContratWithFactId($factId);
//$selectedBien = $fact_manager->findBiensById();

// dump($allContrat);

// dump($currentContrat);
$showLabel = $reglements >1 ? true : false;
$savedId = '';
// dump($showLabel);
//$reglements = [];

$errors = [];
dump($_POST);
if(!empty($_POST)){
    Validator::lang('fr');
    $v = new Validator($_POST);

      //$reglements[$idregl]->setMontant_regl() ;
      $fielName = ['ligne_regl_id-','date_regl-','montant_regl-','description_regl'];
      //$idList ; 
     
      // Facture part ///////////////////////////////////////////////

      //Get the facture's type and his id
      if(isset($_POST['type_ligne'])){
        $data = explode("_",$_POST['type_ligne']);
        $id_type_fact = $data[0];
        $nom_type_fact = $data[1];
      }

      //Get the facture contract and his id
      if(isset($_POST['inputContrat'])){
        $data = explode("_",$_POST['inputContrat']);
        $id_contrat = $data[0];
        $contrat_name_id = $data[1];
      }
   
      //set the new value
      $selectedFacture->setDate_emission($_POST['date_emission'])
                      ->setMontant_fact((int)$_POST['montant_fact'])
                      ->setNom_type_fact( $nom_type_fact)
                      ->setId_type_fact($id_type_fact)
                      ->setNameId($contrat_name_id)
                      ->setId_contrat_loc($id_contrat)
                      ;
                      
   
    // dump($selectedFacture);
     
    //////////////////////////////////////////////////////////

    // Reglement's part

    if (isset($_POST['update_select'])){
      echo 'post set';
    }
    // ids = each reglement
    if(isset($_POST['ids'])){
      $idList  = explode('-',$_POST['ids']);
    //  dump(gettype($idList),$_POST['ids'],$idList,empty(($idList)));
      $selectedRegl = [];
      if(!empty($idList)){
        foreach((array)$idList as $list){
         // dump('boucle');
          $selectedRegl[$list] =new Reglement();
          $selectedRegl[$list]->setDateReglement($_POST['date_regl-' . $list]);
          $selectedRegl[$list]->setIdReglement($list);
          $selectedRegl[$list]->setMontantRegl($_POST['montant_regl-' . $list]);
          $selectedRegl[$list]->setDescription_regl($_POST['description_regl-' . $list]);
          $selectedRegl[$list]->setIdFacture($selectedFacture->getId_facture());
        }
      }
      dump( $selectedRegl);
    }
    

     
    // $reglements_manager->update($reglements[0])
      
    if($v->validate()){
      // update the facture
       $fact_manager->update($selectedFacture);
       $success = true;
       header('Location: ' .$router->generate('finances_index'));
    }else{
        $errors = ($v->errors());
    }
    
    dump($errors);
}

?>

<script>
  window.addEventListener("load", function () {
    console.log(
      "Cette fonction est exécutée une fois quand la page est chargée.",
    );
  });
  
const checkbox = document.getElementById('update_select[]');

checkbox.addEventListener('change', (event) => {
  if (event.currentTarget.checked) {
    alert('checked');
  } else {
    alert('not checked');
  }
})
</script>

<?php if($success) :?>
    <div class="alert alert-success mt-4">
      L'enregistrement a bien été modifié
  </div>
<?php endif?>

<h2>Modifier le revenu </h2>
<form action="" method="post">
<h3>Facture</h3>

<div class="row mb-3">
  
<div class="col-md-6">
    <label for="inputContrat" class="form-label">Contrat</label>
      <select class="form-select" name='inputContrat' id="inputContrat" aria-label="Default select example">
        <!-- Mettre la valeur par defaut sous la forme ID_NOM pour la recuperer dans le POST -->
        <option value = "<?=  $selectedFacture->getId_contrat_loc() . '_'. $selectedFacture->getNameId() ?>" selected><?= $selectedFacture->getNameId()?></option>
        <?php foreach($allContrat as $contrat):?>
          <option value="<?=  $contrat->getId_contrat_loc() . '_'. $contrat->getNameId() ?>"><?=$contrat->getNameId()?></option>
        <?php endforeach;?>
      </select>
  </div>
  
  <!-- Todo -->
  <div class="col-md-6 invisible">
    <label for="inputBien" class="form-label" >Bien</label>
    <select class="form-select" id="inputBien" name='inputBien' in aria-label="Default select example">
    <option selected><?= $allBiens[0]->getNom()?></option> //TODO set the current bien
      <?php foreach($allBiens as $bien):?>
        <option value="<?=$bien->getId_bien()?>"><?=$bien->getNom()?></option>
      <?php endforeach;?>
    </select>
  </div>
  <!--  -->
  
</div>

<div class="row mb-3">
  <div class="col-md-2">
      <label for="date_emission" class="form-label" >Date</label>
      <input type="date"  class="form-control" id="date" name='date_emission' value="<?=$selectedFacture->getDate_emission()?>" >
  </div>

  <div class="col-md-4">
    <label for="montant_fact" class="form-label">Montant</label>
    <input type="text" class="form-control" id="montant_fact" name="montant_fact" placeholder="" value="<?=$selectedFacture->getMontant_fact()?>" >
  </div>
  
  <div class="col-md-3">
    <label for="type_ligne" class="form-label ">Type</label>
      <select class="form-select" id="type_ligne"  name="type_ligne" aria-label="Default select example">
        <!-- Mettre la valeur par defaut sous la forme ID_NOM pour la recuperer dans le POST -->
        <option value="<?=$selectedFacture->getId_type_fact().'_'. $selectedFacture->getNom_type_fact()?>" selected><?=$selectedFacture->getNom_type_fact()?></option>
        <?php foreach($allTypes as $type): ?>
            <option value="<?=$type->id_type_fact.'_'.$type->nom_type_fact ?>"><?=$type->nom_type_fact ?></option>
        <?php endforeach?>
      </select>
      <input type="hidden" id="type_ligne_name" name="type_ligne_name" value="<?='aaa'  ?>">
  </div>

</div>

<h3>Reglement</h3>
<table class="table table-borderless ">
  <thead>
    <tr>
     
      <th scope="col">Le</th>
      <th scope="col">Montant</th>
      <th scope="col">Description</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($reglements as $reglement):?>
    <tr>
     
      <td>
        <input disabled type="date"  class="form-control" id="date_regl"  name = "date_regl" value="<?= $reglement->getDateReglement() ?>" >
      </td>
      <td>
        <input disabled type="text" class="form-control" id="montant_regl" name="montant_regl" placeholder="" value="<?= $reglement->getMontantRegl() ?>" >
      </td>
      <td>
      <input disabled type="text" class="form-control" id="description_regl" name="description_regl" placeholder="Description" value="<?=$reglement->getDescription_regl() ?> " >
      </td>
      
      <td ><a class="btn btn-primary" href="<?= $router->generate('finance_delete',['id' =>$reglement->getIdReglement(),'factId' => $reglement->getIdFacture()]) ?>">Supprimer</a>
            <a class="btn btn-warning" href="<?= $router->generate('finance_edit_payment',['id' =>$reglement->getIdReglement()])?>">Modifier</a>
      </td>
    </tr>
  <?php endforeach;?>
   
  </tbody>
</table>

 
<button class="btn btn-primary mt-3">Valider</button>
</form>