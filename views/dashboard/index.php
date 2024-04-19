<?php

?>

<h1>Dashboard</h1>

<table class="table">
<thead>
    <tr>
      <th scope="col">Date</th>
      <th scope="col">Bien</th>
      <th scope="col">De</th>
      <th scope="col">Montant</th>
      <th scope="col">Part locataire</th>
      <th scope="col">Aide</th>
      <th scope="col"></th>

     
    </tr>
  </thead>

<tbody>
    <tr>
      <th scope="row"><?='25/01/24' ?></th>
      <td><?='Mon appart' ?></td>
      <td><?='Le locataire masqué' ?></td>
      <td><?='710' ?></td>
      <td><?='356' ?></td>
      <td>122 </td>
      <td scope="col"><a class="btn btn-primary mt-3" href="<?= $router->generate('locataire_create') ?>">Encaissé</a></td>
    </tr>

  </tbody>
  </table>