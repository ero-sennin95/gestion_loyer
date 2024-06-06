<?php

use App\Model\Contrat;
use App\Model\Locataire;
use Valitron\Validator;

$success = false;

$pdo = App\Connection::getPDO();
$manager = new App\Model\ContratManager();
$bienManager = new App\Model\BiensManager();

$selectedContrat = new Contrat();
//Get all locataire to fill select box
$listLocataires = $manager->findAllLocataires();
// dump($listLocataires);

//Get all biens to fill select box
$listBiens = $manager->findAllBiens();

//$id = (int) $id;
//dd($selectedLoc);
// session_start();

$errors = [];
dump($_POST);
if(!empty($_POST)){
    Validator::lang('fr');
    $v = new Validator($_POST);
    // Disable prepending the labels
    //$v->setPrependLabels(false);
    $v->rule(function() use ($manager){
        return !($manager->exist('nom',$_POST['lastname']));
    },"lastname")->message("Ce locataire existe déja"); 

    $v->rule(function() use ($manager){
        return !($manager->exist('nameId',$_POST['bail_name']));
    },"bail_name")->message("Ce code existe déja"); 

    $v->rule('required', ['bail_name','loyer','charges'])
      ->rule('numeric',['loyer','charges','caution','duree'])
      ->rule('alphaNum',[])
      ->rule('integer',['select_locataire','select_bien'])
      ->rule('date',['date_entree']);
   // require "_rules.php" ;
   $selectedContrat->setId_locataire((int)$_POST['select_locataire'])
                ->setId_bien((int)$_POST['select_bien'])
                ->setNameId($_POST['bail_name'])
                ->setLoyer_mensuel($_POST['loyer'])
                ->setProv_charges($_POST['charges'])
                ->setCaution($_POST['caution'])
                ->setDate_entree($_POST['date_entree'])
                ->setDuree_bail($_POST['duree'])
                ->setNameId($_POST['bail_name']);
// dd($selectedContrat);
    $locId = $selectedContrat->getId_locataire();
    //  dd( $selectedContrat);
    // $bien = $bienManager->

    if($v->validate()){
        $lastId = $manager->create($selectedContrat);
        // dump( $lastId );
        $bienManager->updateLoc((int)$_POST['select_bien'],$locId);
        $success = true;
       header('Location: ' .$router->generate('contrats_index'));
    }else{
        $errors = ($v->errors());
    }
    // dd(isset($errors['firstname']));
   
}

?>
<?php if($success) :?>
    <?php $_SESSION['flash'] = ['message' => "Le contrat a bien été enregistré"] ?>
<?php endif?>

<?php if(!empty($errors)) :?>
    <div class="alert alert-danger mt-4">
          L'enregistrement n'a pas été enregistré
  </div>
  <?php $_SESSION['flash'] = ['message' => "Le contrat n'a bien été enregistré"] ?>
<?php endif?>
<h1>Ajouter un contrat de location</h1>

<?php 
$SubmitText = 'Ajouter';
include '_form.php';
?>