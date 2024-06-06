<form action="" method="post">
    <div class="mb-3">
        <label for="lastname">Nom</label>
        <input type="text" class="form-control <?=isset($errors['lastname']) ? 'is-invalid' : '' ?> " name="lastname" value="<?=htmlentities($selectedLoc->getNom() ?? '')?>" >
            <?php if(isset($errors['lastname'])):?>
                <div class="invalid-feedback">
                    <?=implode('<br>',$errors['lastname'])?>
                </div>
            <?php endif ?>
    </div>

    <div class="mb-3">
        <label for="firstname">Prenom</label>
        <input type="text" class="form-control <?=isset($errors['firstname']) ? 'is-invalid' : '' ?>" name="firstname" value="<?=htmlentities($selectedLoc->getPrenom() ?? '' )?>">
            <?php if(isset($errors['firstname'])):?>
                <div class="invalid-feedback">
                    <?=implode('<br>',$errors['firstname'])?>
                </div>
        <?php endif ?>
    </div>

    <div class="mb-3">
    <label for="eMail">Mail</label>
        <input type="email" class="form-control <?=isset($errors['eMail']) ? 'is-invalid' : '' ?>" name="eMail" value="<?=htmlentities($selectedLoc->getEmail() ?? '' )?>">
        <?php if(isset($errors['eMail'])):?>
                <div class="invalid-feedback">
                    <?=implode('<br>',$errors['eMail'])?>
                </div>
        <?php endif ?>
    </div>

    <div class="mb-3">
    <label for="date_naissance">Date de naissance</label>
        <input type="date" class="form-control <?=isset($errors['date_naissance'])? 'is-invalid' : '' ?>" name="date_naissance" value="<?=htmlentities($selectedLoc->getDate_naissance() ?? '')?>">
        <?php if(isset($errors['date_naissance'])):?>
                <div class="invalid-feedback">
                    <?=implode('<br>',$errors['date_naissance'])?>
                </div>
        <?php endif ?>
    </div>
    <div class="mb-3">
    <label for="apl">Montant des APL(Si eligible)</label>
        <input type="text" class="form-control <?=isset($errors['apl'])? 'is-invalid' : '' ?>" name="apl" value="<?=($selectedLoc->getApl() ?? '' ) ?>">
        <?php if(isset($errors['apl'])):?>
                <div class="invalid-feedback">
                    <?=implode('<br>',$errors['apl'])?>
                </div>
        <?php endif ?>
    </div>
    <button class="btn btn-primary mt-3">Ajouter</button>