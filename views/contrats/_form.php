<form action="" method="post">
    <div class="form-group">
        <label for="bail_type">Type de bail</label>
        <select class="form-select" name="bail_type"  aria-label="Default select example">
              <option value="1">Bail particulier</option>
              <option value="2">Bail Commercial</option>
              <option value="3">Box,garage</option>

    </select>
    </div>

    
    <div class="form-group">
    <label for="select_locataire">Locataire</label>
        <select class="form-select" name="select_locataire"  aria-label="Default select example">
            <?php foreach($listLocataires as $listLocataire): 
                $id_locataire = $listLocataire->getId_locataire()?>
                <option value="<?=$id_locataire?>"<?=$id_locataire === $id_selected_loc ? 'selected' : ''?>><?=htmlentities($listLocataire->getNom() . ' ' .$listLocataire->getPrenom()) ?></option>
            <?php endforeach;?>
        </select>
    </div>
    <div class="form-group">
    <label for="select_bien">Biens</label>
        <select class="form-select" name="select_locataire"  aria-label="Default select example">
            
            <?php foreach($listBiens as $listBien): 
            dump($id_selected_bien);
                $id_bien = $listBien->getId_bien()?>
                <option value="<?=$id_bien?>"<?=$id_bien === $id_selected_bien ? 'selected' : ''?>><?=htmlentities($listBien->getAdresse1() ) ?></option>
            <?php endforeach;?>
        </select>
    </div>
    <div class="form-group">
    <label for="loyer">Montant du loyer</label>
        <input type="number" class="form-control <?=isset($errors['loyer']) ? 'is-invalid' : '' ?>" name="loyer" value="<?=htmlentities($selectedContrat->getLoyer_mensuel())?>">
        <?php if(isset($errors['loyer'])):?>
                <div class="invalid-feedback">
                    <?=implode('<br>',$errors['loyer'])?>
                </div>
        <?php endif ?>
    </div>

    <div class="form-group">
    <label for="charges">Montant des charges</label>
        <input type="number" class="form-control <?=isset($errors['charges']) ? 'is-invalid' : '' ?>" name="charges" value="<?=htmlentities($selectedContrat->getProv_charges())?>">
        <?php if(isset($errors['charges'])):?>
                <div class="invalid-feedback">
                    <?=implode('<br>',$errors['charges'])?>
                </div>
        <?php endif ?>
    </div>

    <div class="form-group">
    <label for="caution">Depot de garantie</label>
        <input type="number" class="form-control <?=isset($errors['caution'])? 'is-invalid' : '' ?>" name="caution" value="<?=htmlentities($selectedContrat->getCaution())?>">
        <?php if(isset($errors['caution'])):?>
                <div class="invalid-feedback">
                    <?=implode('<br>',$errors['caution'])?>
                </div>
        <?php endif ?>
    </div>
    <div class="form-group">
    <label for="duree">Durée du bail</label>
        <input type="number" class="form-control <?=isset($errors['duree'])? 'is-invalid' : '' ?>" name="duree" value="<?=htmlentities($selectedContrat->getDuree_bail())?>">
        <?php if(isset($errors['duree'])):?>
                <div class="invalid-feedback">
                    <?=implode('<br>',$errors['duree'])?>
                </div>
        <?php endif ?>
    </div>

    <div class="form-group">
    <label for="date_entree">Date d'entrée'</label>
        <input type="date" class="form-control <?=isset($errors['date_entree'])? 'is-invalid' : '' ?>" name="date_entree" value="<?=htmlentities($selectedContrat->getDate_entree())?>">
        <?php if(isset($errors['date_entree'])):?>
                <div class="invalid-feedback">
                    <?=implode('<br>',$errors['date_entree'])?>
                </div>
        <?php endif ?>
    </div>