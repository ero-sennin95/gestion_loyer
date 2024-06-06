<form action="" method="post">

    <div class="mb-3">
        <label for="typeInput">Type de logement</label>
        <select class="form-select" name="typeInput"  aria-label="Default select example">
              <option value="Appartement" selected>Appartement</option>
              <option value="Box">Box/garage</option>
              <option value="Autres">Autres</option>

    </select>
    <?php if(isset($errors['type'])):?>
                <div class="invalid-feedback">
                    <?=implode('<br>',$errors['type'])?>
                </div>
        <?php endif ?>
    </div>

   <div class="mb-3">
            <label for="nom" class="form-label">Identifiant</label>
            <div class="input-group">
                <span class="input-group-text" id="basic-addon1"><?=htmlentities($selectedBiens->getPrefix() ??'' ) ?></span>
                <input type="text" class="form-control <?=isset($errors['nom']) ? 'is-invalid' : '' ?>" id="nom" name="nom" aria-describedby="nameHelp" value="<?=htmlentities($selectedBiens->getNom() ??'' ) ?>">
                <?php if(isset($errors['nom'])):?>
                <div class="invalid-feedback">
                    <?=implode('<br>',$errors['nom'])?>
                </div>
            <?php endif ?>
            </div>
            <div id="nom" class="form-text">Saisir un identifiant, référence ou numéro unique</div>
            
    </div>
        <div class="mb-3">
            <label for="adresse1" class="form-label">Adresse</label>
            <input type="text" class="form-control <?=isset($errors['adresse1']) ? 'is-invalid' : '' ?>" id="adresse1" name="adresse1"aria-describedby="adresseHelp" value="<?=htmlentities($selectedBiens->getAdresse1() ?? '') ?>">
            <?php if(isset($errors['adresse1'])):?>
                <div class="invalid-feedback">
                    <?=implode('<br>',$errors['adresse1'])?>
                </div>
        <?php endif ?>
    </div>

    <div class="mb-3">
            <label for="adresse2" class="form-label">Adresse 2</label>
            <input type="text" class="form-control  <?=isset($errors['adresse2']) ? 'is-invalid' : '' ?>" id="adresse2" name="adresse2" aria-describedby="adresse2Help" value="<?=htmlentities($selectedBiens->getAdresse2() ?? '') ?>">
            <?php if(isset($errors['adresse2'])):?>
                <div class="invalid-feedback">
                    <?=implode('<br>',$errors['adresse2'])?>
                </div>
        <?php endif ?>
    </div>

    <div class="mb-3">
            <label for="villeInput" class="form-label">Ville</label>
            <input type="text" class="form-control <?=isset($errors['villeInput']) ? 'is-invalid' : '' ?>" id="villeInput" name="villeInput" aria-describedby="villeHelp" value="<?=htmlentities($selectedBiens->getVille() ?? '') ?>">
            <?php if(isset($errors['ville'])):?>
                <div class="invalid-feedback">
                    <?=implode('<br>',$errors['ville'])?>
                </div>
        <?php endif ?>
    </div>

    <div class="mb-3">
            <label for="code_postal" class="form-label">Code postale</label>
            <input type="text" class="form-control  <?=isset($errors['code_postal']) ? 'is-invalid' : '' ?>" id="code_postal" name="code_postal" aria-describedby="cp_Help" value="<?=htmlentities($selectedBiens->getCp() ?? '') ?>">
            <?php if(isset($errors['code'])):?>
                <div class="invalid-feedback">
                    <?=implode('<br>',$errors['code'])?>
                </div>
        <?php endif ?>
    </div>
    
    <div class="mb-3">
        <label for="floatingTextarea2">Description</label>
        <textarea class="form-control"  rows="4" placeholder="Leave a comment here" id="descriptionArea" name="descriptionArea" style=""><?=htmlentities($selectedBiens->getDescription() ?? '')?></textarea>

        <?php if(isset($errors['description'])):?>
                <div class="invalid-feedback">
                    <?=implode('<br>',$errors['description'])?>
                </div>
        <?php endif ?>
    </div>
    <button class="btn btn-primary mt-3">Modifier</button>
</form>