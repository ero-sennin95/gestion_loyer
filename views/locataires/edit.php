<?php

use Valitron\Validator;

$success = false;

$pdo = App\Connection::getPDO();
$manager = new App\Model\LocataireManager();
$id = (int) $id;
$selectedLoc = $manager->findLocataireById($id);
$errors = [];
var_dump($_POST);
if(!empty($_POST)){
    Validator::lang('fr');
    $v = new Validator($_POST);
    // Disable prepending the labels
    //$v->setPrependLabels(false);
    
    /*
    Specific rule
    */

    
    require "_rules.php" ;
    
// dump($id);
//     $v->rule('required',['lastname','firstname','eMail']);
//      $v->rule('lengthBetween',['lastname','firstname'],3,20);
//      $v->rule('dateFormat','date_naissance', 'Y-m-d');
//    // $v->rule('lengthBetween','firstname',3,20);
//    $v->rule(function() use ($manager,$id){
//     return !($manager->exist('nom',$_POST['lastname'],$id));
// },"lastname")->message("Ce locataire existe déja"); 
//     $v->rule('email','eMail');
//     $v->labels(array('lastname' => 'Nom'));
//     $v->labels(array('firstname' => 'Prenom'));
   
//     dump($v);
    $selectedLoc->setNom($_POST['lastname'])
                ->setPrenom($_POST['firstname'])
                ->setEmail($_POST['eMail'])
                ->setDate_naissance($_POST['date_naissance'])
                ->setApl($_POST['apl']);

    if($v->validate()){
        $manager->update($selectedLoc);
        $success = true;
    }else{
        $errors = ($v->errors());
    }
    
    dump($errors);
}

?>
<?php if($success) :?>
    <div class="alert alert-success mt-4">
      L'enregistrement a bien été modifié
  </div>
<?php endif?>

<h1>Edit page <?= $selectedLoc->getNom()?></h1>

<?php require "_form.php" ?>

    <button class="btn btn-primary mt-3">Modifier</button>
</form>