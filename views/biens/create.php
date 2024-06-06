<?php

use App\Model\Biens;
use App\Model\Contrat;
use App\Model\Locataire;
use Valitron\Validator;

$success = false;

$pdo = App\Connection::getPDO();
$manager = new App\Model\BiensManager;

$selectedBiens = new Biens();
//Get all locataire to fill select box
// dump($listLocataires);

//Get all biens to fill select box

//$id = (int) $id;
//dd($selectedLoc);

$errors = [];
// var_dump($_POST);
if(!empty($_POST)){
    dump($_POST);
    Validator::lang('fr');
    $v = new Validator($_POST);
    // Disable prepending the labels
    //$v->setPrependLabels(false);
    $v->rule(function() use ($manager){
        return !($manager->exist('nom',$_POST['nom']));
    },"nom")->message("Ce bien existe déja"); 
    $v->rule('required',['nom']);

    $selectedBiens->setNom($_POST['nom'])
                ->setAdresse1($_POST['adresse1'])
                ->setAdresse2($_POST['adresse2'])
                ->setCp($_POST['code_postal'])
                ->setVille($_POST['villeInput'])
                ->setDescription($_POST['descriptionArea'])
                ->setType_biens($_POST['typeInput']);


    if($v->validate()){
        $manager->create($selectedBiens);
        $success = true;
        $_SESSION['flash'] = ['message' => "Le bien a été enregistré"];
        header('Location: ' .$router->generate('biens_index'));
    }else{
        $errors = ($v->errors());
    }
    //dd(isset($errors['firstname']));
    dump($errors);
}

?>

<?php if(!empty($errors)) :?>
    <div class="alert alert-danger mt-4">
      L'enregistrement n'a pas été enregistré
  </div>
<?php endif?>
<h1>Ajouter un bien</h1>

<?php include '_form.php'?>