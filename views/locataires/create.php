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
// var_dump($_POST);
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
        $_SESSION['flash'] = ['message' => "Le locataire a bien été enregistré"];
        header('Location: ' .$router->generate('locataires_index'));
        exit();
    }else{
        $errors = ($v->errors());
    }
    //dd(isset($errors['firstname']));
    dump($errors);
}

?>

<?php if(!empty($errors)) :?>
    <div class="alert alert-danger mt-4">
      Le locataire n'a pas été enregistré
  </div>
<?php endif?>
<h2>Ajouter un locataire </h2>

<?php require "_form.php" ?>
   
</form>