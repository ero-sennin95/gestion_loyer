<?php
    $v->rule('required',['nom','adresse1','villeInput']);
    $v->rule('lengthBetween',['lastname','firstname'],3,20);
    $v->rule('email','eMail');
    $v->rule('required','date_naissance');
    $v->rule('dateFormat','date_naissance', 'Y-m-d');
    $v->rule('numeric','apl');
    $v->labels(array('lastname' => 'Nom'));
    $v->labels(array('firstname' => 'Prenom'));
   
