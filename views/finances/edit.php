<?php

use Valitron\Validator;

$success = false;

$pdo = App\Connection::getPDO();
$manager = new App\Model\FactureManager;

$id = (int) $id;
dump($id);
$selectedFacture = $manager->findFactureById($id);
//$selectedBien = $manager->findBiensById()




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
    // 'typeInput' => string 'dav' (length=3)
    // 'nameInput' => string 'dav' (length=3)
    // 'adresseInput' => string '12 rue de la paix' (length=17)
    // 'adresseInput2' => string 'rue jaen jaures' (length=15)
    // 'villeInput' => string 'paris' (length=5)
    // 'code_postal_Input' => string '95000' (length=5)
    // 'descriptionArea' => string 'Une villa magnifique' (length=20)
        $selectedBiens->setNom($_POST['nameInput'])
                        ->setAdresse1($_POST['adresseInput'])
                        ->setAdresse2($_POST['adresseInput2'])
                        ->setType_biens($_POST['typeInput'])
                        ->setVille($_POST['villeInput'])
                        ->setCp($_POST['code_postal_Input'])
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

<h2>Modifier le revenu </h2>
<form action="" method="post">
<h3>Facture</h3>
<div class="mb-3 row">
    <label for="exampleInputEmail1" class="col-sm-2 col-form-label">Email address</label>
    <div class="col-sm-10">
    <select class="form-select" aria-label="Default select example">
      <option selected>Open this select menu</option>
      <option value="1">One</option>
      <option value="2">Two</option>
      <option value="3">Three</option>
    </select>
    </div>
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
</div>
<h2>Reglement</h2>
<div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
      <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="email@example.com">
    </div>
  </div>
  <div class="mb-3 row">
    <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="inputPassword">
    </div>
  </div>

</form>