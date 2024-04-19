<?php

use App\Model\User;

$user = new User();



?>


<h1>Se connecter</h1>

<form action="" method="POST">

<div class="mb-3">
    <label for="inputName" class="form-label">Nom d'utilistateur</label>
    <input type="text" class="form-control" id="inputName" aria-describedby="usernameHelp">
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