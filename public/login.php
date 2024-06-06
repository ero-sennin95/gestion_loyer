<?php

use Symfony\Component\VarDumper\VarDumper;

require '../App/Auth.php';
var_dump(Auth::isConnected());
var_dump($_POST);
if(Auth::isConnected()){
    var_dump('redirect');
   header('Location: ../');
    exit();
 }

 if($_POST){
    Auth::isConnected();
    // session_start();
    $_SESSION['connected']=1;
 }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=h1, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>
<body>
<h1>Se connecter</h1>

<form action="" method="POST">

<div class="mb-3">
    <label for="inputName" class="form-label">Nom d'utilistateur</label>
    <input type="text" class="form-control" id="inputName" name="inputName" aria-describedby="usernameHelp">
  </div>
  <div class="mb-3">
    <label for="inputPassword" class="form-label">Mot de passe</label>
    <input type="password" class="form-control" id="inputPassword">
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="rememberCheck">
    <label class="form-check-label" for="rememberCheck">Se souvenir de moi</label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</body>
</html>