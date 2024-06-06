<?php

use App\Model\CalendarView;
use App\Utils;
use LDAP\Result;

use function PHPSTORM_META\type;

$pdo = App\Connection::getPDO();
$lmanFact = new \App\Model\FactureManager();
$lmanRegl  = new \App\Model\ReglementManager();
//$factures = $lmanFact->findAllFacture();
//$factures = $lmanFact->findAllFactureJoin();
// $result = $lmanFact->findligneByFactureId(2);
$factures = $lmanFact->findAllFacture2(); //Select All facture


dump($factures);

//dd($sumFact = $lmanFact->sumBycolWithId('ligne_fact','montant_ligne',1));
$calendar = new \App\Model\CalendarView;
foreach($factures as $result){
  $facture_date = $result->getDate_emission();
  if($facture_date)
  $calendar->addFacture($result);
 }


foreach($factures as $result){
        $facture_id = $result->getId_facture();
         $lines =  $lmanFact->findligneByFactureId($facture_id);
        // $result->setLigne($lines);

}


    foreach($factures as $result){
        $facture_id = $result->getId_facture();

        $sumRegl = $lmanFact->sumBycolWithId('ligne_regl','montant_regl',$facture_id);
        $sumRegl->montant_regl = $sumRegl->montant_regl ?? 0;
        // //$sumRegl = $sumRegl ?? 0;
        // dump($sumFact,$sumRegl);
        // $payeurs = $lmanFact->findPayeur($facture_id);
        // dump($payeurs);

        $result->setMontant_regl($sumRegl->montant_regl);
        
        // $formated_payeur = '';
        // foreach($payeurs as $payeur){
        // $formated_payeur .= $payeur->nom_payeur .' ';   
        // }
        // $result->setPayeur($formated_payeur);
      
        // $result->setMontant_fact($sumFact->montant_fact);

}


// dump($factures);
// dump($sumRegls);
// dump($reglement);
 


//Inserer la somme dans les resultats de la requete en fonction de chaque id
// foreach($resultsJoin as $result){
  
//     foreach($sumRegls as $sumRegl){
//       if($result->getId_facture() == $sumRegl->getIdFacture()){
//         $result->setTotal_Debit($sumRegl->getcredit_total());
//       }
      
//     }
 
//  }



$menuPages = "finances";
$first_day_month = date('01-01-2023'); // hard-coded '01' for first day
$last_day_month  = date('12-t-2023');


//$date_str = explode('-' ,$factures[0]->date_emission())
//echo $num;

//dump($last_day_this_month);
?>


<table class="table table-borderless table-hover ">
<thead>
    <tr>
      <th scope="col">Periode</th>
      <th scope="col">Bien</th>
      <th scope="col">De</th>
      <th scope="col">Montant</th>
      <th scope="col">Payé</th>
      <th scope="col">Solde</th>
      <th scope="col">Description</th>
      <th scope="col">Etat</th>
      <th scope="col"><a class="btn btn btn-outline-success btn-sm mt-3" href="<?= $router->generate('finance_create') ?>" ?>Ajouter un Loyer</th>

     
    </tr>
  </thead>

<tbody>
<?php
$savedDate = false;
?>

  
    <?php foreach($factures as $result): ?>
    <tr>
      <?php
        $d = $result->getDate_emission();
        $e = explode('-',$d);
        // dump($e);
        $currentDate = $e[0] .'-'.$e[1];
        if ($currentDate != $savedDate){
          // dump('display header' . ' ' . $currentDate);?>
          <tr>
          <th class="table-primary " colspan = "9"><?=Utils::get_fr_month($e[1]) . ' ' . $e[0] ?></th>
          
          </tr>
      <?php
        }
        $savedDate =  $currentDate;
        // dump($currentDate);
       
    ?>
      <td  scope="row"><?= $e[2]. '/'.$e[1].'/'.$e[0]?></td>
      <td><?=$result->getNom_bien() ?? "nom par defaut" ?></td>
      <td><?=$result->getPayeur()?></td>
      <td><?=$result->getMontant_fact(). ' €' ?></td>
      <td><?= $result->getMontant_regl(). ' €' ?></td>
      <td><?=Utils::getBalance_formatedStr($result->getMontant_regl(),$result->getMontant_fact())  ?></td>
      <td class="small"><?= 'x'?> </td>
      <td><?='Etat' ?></td>
      <td scope="col">
        <a class="btn btn-outline-warning btn-sm" href="<?= $router->generate('finance_edit',['id' => $result->getId_Facture()]) ?>">Editer</a>
        <a class="btn btn-outline-primary btn-sm" href="<?= $router->generate('finance_create_payment',['id' => $result->getId_Facture()]) ?>">Encaisser</a>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
  </table>