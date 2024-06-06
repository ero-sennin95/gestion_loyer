<?php

use Valitron\Validator;

$success = false;

$pdo = App\Connection::getPDO();
$manager = new App\Model\BiensManager();

$id = (int) $id;
$selectedBiens = $manager->findBienById($id);
//$selectedBien = $manager->findBiensById()

$var1 = "Hello";
$var2 = "hello";
if (strcmp($var1, $var2) !== 0) {
   // echo '$var1 is not equal to $var2 in a case sensitive string comparison';
}
// dump(strcmp('Appartement', $selectedBiens->getType_biens()));


$errors = [];
if(!empty($_POST)){
    Validator::lang('fr');
    $v = new Validator($_POST);
    // Disable prepending the labels
    //$v->setPrependLabels(false);
    /*
    Specific rule
    */
    // 'typeInput' => string 'dav' (length=3)
    // 'nameInput' => string 'dav' (length=3)
    // 'adresseInput' => string '12 rue de la paix' (length=17)
    // 'adresseInput2' => string 'rue jaen jaures' (length=15)
    // 'villeInput' => string 'paris' (length=5)
    // 'code_postal_Input' => string '95000' (length=5)
    // 'descriptionArea' => string 'Une villa magnifique' (length=20)
        $selectedBiens->setNom($_POST['nom'])
                        ->setAdresse1($_POST['adresse1'])
                        ->setAdresse2($_POST['adresse2'])
                        ->setType_biens($_POST['typeInput'])
                        ->setVille($_POST['villeInput'])
                        ->setCp($_POST['code_postal'])
                        ->setDescription($_POST['descriptionArea']);

    if($v->validate()){
         $manager->update($selectedBiens);
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

<h1>Edition du bien : <?= $selectedBiens->getPrefix() .' '. $selectedBiens->getNom()?> </h1>

<?php
include '_form.php';
?>
</form>