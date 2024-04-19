<?php

use App\Model\Locataire;
use Valitron\Validator;

$success = false;

$pdo = App\Connection::getPDO();
$manager = new App\Model\LocataireManager();
//$id = (int) $id;
$selectedLoc = new Locataire();
//dd($selectedLoc);
$errors = [];
var_dump($_POST);
if(!empty($_POST)){
    Validator::lang('fr');
    $v = new Validator($_POST);
    // Disable prepending the labels
    //$v->setPrependLabels(false);
    $v->rule(function() use ($manager){
        return !($manager->exist('nom',$_POST['lastname']));
    },"lastname")->message("Ce locataire existe déja"); 
    require "_rules.php" ;
    $selectedLoc->setNom($_POST['lastname'])
                ->setPrenom($_POST['firstname'])
                ->setEmail($_POST['eMail'])
                ->setDate_naissance($_POST['date_naissance'])
                ->setApl($_POST['apl']);
            

    if($v->validate()){
        $manager->create($selectedLoc);
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
<h1>Create page </h1>

<?php require "_form.php" ?>


    <button class="btn btn-primary mt-3">Ajouter</button>
</form>