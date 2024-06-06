<?php
// Edit the contract


use Valitron\Validator;

$success = false;

//Get connection to the database
$pdo = App\Connection::getPDO();
$manager = new App\Model\ContratManager();
$id = (int) $id;
$selectedContrat = $manager->findContratById($id); //Get the selected contract

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
   
    $v->rule('required', ['bail_name','loyer','charges'])
      ->rule('numeric',['loyer','charges','caution','duree'])
      ->rule('alphaNum',[])
      ->rule('integer',['select_locataire','select_bien'])
      ->rule('date',['date_entree']);

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
        header('Location: ' .$router->generate('contrats_index'));
    }else{
        $errors = ($v->errors());
    }
    
    //dump($errors);
}

?><?php if($success) :?>
    <?php $_SESSION['flash'] = ['message' => "Le contrat a bien été enregistré"] ?>
<?php endif?>

<?php if(!empty($errors)) :?>
    <div class="alert alert-danger mt-4">
          L'enregistrement n'a pas été enregistré
  </div>
  <?php $_SESSION['flash'] = ['message' => "Le contrat n'a bien été enregistré"] ?>
<?php endif?>

<h2>Edition du Contrat : <?= $selectedContrat->getNameId()?> </h2>

<?php 
$SubmitText = 'Editer';
include '_form.php';?>