<!doctype html>
<html lang="fr" class="h-100 ">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$title ?? 'Mon site de gestion'?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>

  <body class="d-flex flex-column h-100">
    
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand " href="<?= $router->generate('dashboard')?>">Dashboard</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link <?=$menuPages === 'contrats' ? 'active' : ''?> "  href="<?= $router->generate('contrats_index')?>">Contrat</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?=$menuPages === 'locataires' ? 'active' : ''?>" href="<?= $router->generate('locataires_index')?>">Locataires</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?=$menuPages === 'biens' ? 'active' : ''?>" href="<?= $router->generate('biens_index')?>">Biens</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?=$menuPages === 'finances' ? 'active' : ''?>" href="<?= $router->generate('finances_index')?>">Finances</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="container">
<?= $content;?>
</div>


<footer class="bg-light py-4 footer mt-auto">
  <div class="container">
    Page générée en ms <?= round(1000 * (microtime(true)-DEBUG_TIME))?>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
