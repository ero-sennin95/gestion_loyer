<?php
 
 require  dirname(__DIR__) . '/vendor/autoload.php';
    // echo  dirname(__DIR__) ;
 $pdo = App\Connection::getPDO();

$create= 1;
$fill = 1;
$dropTableLoc = "DROP TABLE IF EXISTS locataire ; ";
$dropTableContrat = "DROP TABLE IF EXISTS contrat_location" ; 
$dropTableBiens = "DROP TABLE IF EXISTS biens" ;
$dropTableFactures = "DROP TABLE IF EXISTS facture" ;
$dropTableReglement = "DROP TABLE IF EXISTS reglement" ;
$dropTableUsers = "DROP TABLE IF EXISTS users" ;
$dropTableLigneFact = "DROP TABLE IF EXISTS ligne_fact" ;
$dropTableLigneRegl = "DROP TABLE IF EXISTS ligne_regl" ;
$dropTablePayeur = "DROP TABLE IF EXISTS payeur" ;
$dropTableTypeFact = "DROP TABLE IF EXISTS type_fact";

$pdo->exec('SET FOREIGN_KEY_CHECKS = 0');
echo "starting...\r\n";

if($create === 1){
        $tableLoc = "CREATE TABLE locataire (
            id_locataire INT AUTO_INCREMENT NOT NULL,
            codeLoc VARCHAR(10),
            civilite VARCHAR(10),
            nom VARCHAR(30),
            prenom VARCHAR(80),
            fixe VARCHAR(16),
            portable VARCHAR(16),
            email VARCHAR(30),
            profession VARCHAR(30),
            date_naissance DATE,
            apl BOOL,
            allocation VARCHAR(15),
            PRIMARY KEY (id_locataire)) ENGINE=InnoDB;";


        $tableContrat = "CREATE TABLE contrat_location (
            id_contrat_loc INT AUTO_INCREMENT NOT NULL,
            nameId VARCHAR(30),
            prov_charges DOUBLE,
             loyer_mensuel DOUBLE,
            caution DOUBLE,
            jour_versement INT,
            date_entree DATE,
            duree_bail INT,
            notes VARCHAR(250),
            id_locataire INT,
            id_bien INT,
            PRIMARY KEY (id_contrat_loc)) ENGINE=InnoDB;"; 


        $tableBiens = "CREATE TABLE biens (id_bien INT AUTO_INCREMENT NOT NULL,
                        nom VARCHAR(20),
                        type_Biens VARCHAR(20),
                        adresse1 VARCHAR(40),
                        adresse2 VARCHAR(40),
                        ville VARCHAR(30),
                        cp INT,
                        description VARCHAR(255),
                        id_contrat_loc INT,
                        PRIMARY KEY (id_bien)) ENGINE=InnoDB;";
        
        $tableFactures = "CREATE TABLE facture (id_facture INT AUTO_INCREMENT NOT NULL,
                                                date_debut DATE,
                                                date_fin DATE,
                                                date_emission DATE,
                                                montant_fact DOUBLE,
                                                description_ligne VARCHAR(128),
                                                tva_ligne INT,
                                                id_contrat_loc INT,
                                                id_type_fact INT,
                                                PRIMARY KEY (id_facture)) ENGINE=InnoDB; ";

        
        $tableTypeFact = "CREATE TABLE type_fact (id_type_fact INT AUTO_INCREMENT NOT NULL, nom_type_fact VARCHAR(64), PRIMARY KEY (id_type_fact)) ENGINE=InnoDB;";
//N'existe plus.....
        // $tableReglement = "CREATE TABLE Reglement (id_reglement INT AUTO_INCREMENT NOT NULL,
        //                                         date DATE,
        //                                         id_facture INT,
        //                                         PRIMARY KEY (id_reglement)) ENGINE=InnoDB;";

        $tableUser = "CREATE TABLE users (
                                username VARCHAR(250) NOT NULL,
                                user_password VARCHAR(255)NOT NULL)
                                ENGINE=InnoDB;";
        

        //Nexiste plus....
        $tableLigneFact = "CREATE TABLE ligne_fact (
                            id_ligne INT AUTO_INCREMENT NOT NULL,
                            montant_ligne DOUBLE,
                            tva_ligne INT,
                            type_ligne VARCHAR(16),
                            id_facture INT,
                            id_type_fact INT,
                            PRIMARY KEY (id_ligne)) ENGINE=InnoDB;";

        $tableLigneRegl = "CREATE TABLE ligne_regl (id_ligne_regl INT AUTO_INCREMENT NOT NULL,
                                                    montant_regl DOUBLE,
                                                    date_regl DATE,
                                                    description_regl VARCHAR(256),
                                                    id_facture INT,
                                                    id_payeur INT,
                                                    PRIMARY KEY (id_ligne_regl)) ENGINE=InnoDB;";

        
        $tablePayeur = "CREATE TABLE payeur (
                            id_payeur INT AUTO_INCREMENT NOT NULL,
                            nom_payeur VARCHAR(32),
                            PRIMARY KEY (id_payeur)) ENGINE=InnoDB";


        echo "delete all table...\r\n";
        $pdo->exec($dropTableContrat);
        $pdo->exec($dropTableLoc);
        $pdo->exec($dropTableFactures);
        $pdo->exec($dropTableBiens);
        //$pdo->exec($dropTableReglement);
        $pdo->exec($dropTableUsers);
        $pdo->exec($dropTablePayeur);
        $pdo->exec($dropTableLigneFact);
        $pdo->exec($dropTableLigneRegl);
        $pdo->exec($dropTableTypeFact);

        echo "Create table...\r\n";
        $pdo->exec($tableContrat);
        $pdo->exec($tableLoc);
        $pdo->exec($tableFactures);
        $pdo->exec($tableBiens);
      //  $pdo->exec($tableReglement);
        $pdo->exec($tableUser);
        $pdo->exec($tablePayeur);
        $pdo->exec($tableLigneFact);
        $pdo->exec($tableLigneRegl);
        $pdo->exec($tableTypeFact);

        $alterContrat = "ALTER TABLE contrat_location ADD CONSTRAINT FK_Contrat_location_id_locataire FOREIGN KEY (id_locataire) REFERENCES locataire (id_locataire)";
        $alterContrat02 = "ALTER TABLE contrat_location ADD CONSTRAINT FK_Contrat_location_biens_id_bien_biens FOREIGN KEY (id_bien) REFERENCES biens (id_bien)";
        $alterBiens = "ALTER TABLE biens ADD CONSTRAINT FK_Biens_id_contrat_loc FOREIGN KEY (id_contrat_loc) REFERENCES contrat_location (id_contrat_loc)";
        $alterFactures01 ="ALTER TABLE facture ADD CONSTRAINT FK_Facture_id_contrat_loc FOREIGN KEY (id_contrat_loc) REFERENCES contrat_location (id_contrat_loc)";
        $alterFactures02="ALTER TABLE facture ADD CONSTRAINT FK_Facture_id_fact_type_fact FOREIGN KEY (id_type_fact) REFERENCES type_fact (id_type_fact);";
        //$alterReglements = "ALTER TABLE Reglement ADD CONSTRAINT FK_Reglement_id_facture FOREIGN KEY (id_facture) REFERENCES Facture (id_facture)";
        $alterLigneFact="ALTER TABLE ligne_fact ADD CONSTRAINT FK_ligne_id_facture FOREIGN KEY (id_facture) REFERENCES facture (id_facture);";
        $alterLigneFact02="ALTER TABLE ligne_fact ADD CONSTRAINT FK_ligne_fact_id_fact_type_fact FOREIGN KEY (id_type_fact) REFERENCES type_fact (id_type_fact);";
        $alterLigneRegl = "ALTER TABLE ligne_regl ADD CONSTRAINT FK_ligne_regl_id_facture FOREIGN KEY (id_facture) REFERENCES facture(id_facture);";
        $alterLigneRegl2 ="ALTER TABLE ligne_regl ADD CONSTRAINT FK_ligne_regl_id_payeur FOREIGN KEY (id_payeur) REFERENCES payeur (id_payeur);";
        
        $pdo->exec($alterContrat);
        $pdo->exec($alterContrat02);
        $pdo->exec($alterBiens);
        $pdo->exec($alterFactures01);
        $pdo->exec($alterFactures02);
        $pdo->exec($alterLigneFact02);
       // $pdo->exec($alterReglements);
        $pdo->exec($alterLigneFact);
        $pdo->exec($alterLigneRegl);
        $pdo->exec($alterLigneRegl2);



        $pdo->exec('SET FOREIGN_KEY_CHECKS = 1');

}
 if($fill===1){
// use the factory to create a Faker\Generator instance
    if(0){
        $faker = Faker\Factory::create('fr_FR');

        $truncateLocataires = "TRUNCATE TABLE `locataire`";
        $truncateBiens = "TRUNCATE TABLE `biens`";
        $truncateContrat = "TRUNCATE TABLE `contrat_location`";
        $pdo->exec('SET FOREIGN_KEY_CHECKS = 0');
        $pdo->exec($truncateLocataires);
        $pdo->exec($truncateBiens);
        $pdo->exec($truncateContrat);
        echo 'delete all table';
        //echo  $faker->date();
        //echo $faker->time();
        
        $locatairesId=[];
        $biensId=[];
        htmlspecialchars($faker->jobtitle());
        
        // $sql = "INSERT INTO locataire(civilite,nom,prenom,fixe,portable,email,profession,date_naissance,apl,allocation)
        //         VALUES ('{$faker->title()}','{$faker->lastName()}','{$faker->firstName()}','{$faker->phoneNumber()}','{$faker->phoneNumber()}','{$faker->email()}',`{htmlspecialchars($faker->jobtitle())}`','{$faker->date()}','{$faker->numberBetween(0, 1)}','{$faker->numberBetween(0, 1000)}')";
        //echo $sql;
        
        for($i = 0 ;$i<25;$i++){
            $job = htmlspecialchars($faker->jobtitle());
           $pdo->exec("INSERT INTO locataire(civilite,nom,prenom,fixe,portable,email,profession,date_naissance,apl,allocation)
           VALUES ('{$faker->title()}','{$faker->lastName()}','{$faker->firstName()}','{$faker->phoneNumber()}','{$faker->phoneNumber()}','{$faker->email()}','{$job}','{$faker->date()}','{$faker->numberBetween(0, 1)}','{$faker->numberBetween(0, 1000)}')");
           $locatairesId[] = $pdo->lastInsertId();
        }
        
        
        $typeDeBiens = ['Appartement','Maison','Garage'];
        
        // $sqlBiens = "INSERT INTO Biens(type_Biens,adresse1,adresse2,ville,cp,description,id_contrat_loc)
        //    VALUES ('{$faker->randomElement($typeDeBiens)}','{$faker->address()}','{$faker->streetAddress()}','{$faker->city()}','{$faker->postcode()}','{$faker->text()}','{$faker->randomElement($locatairesId)}')";
        // echo $sqlBiens;
        for($i = 0 ;$i<10;$i++){
           $pdo->exec("INSERT INTO Biens(nom,type_Biens,adresse1,adresse2,ville,cp,description,id_contrat_loc)
           VALUES ('{$faker->company()}',
                    '{$faker->randomElement($typeDeBiens)}',
                    '{$faker->address()}',
                    '{$faker->streetAddress()}',
                    '{$faker->city()}',
                    '{$faker->postcode()}',
                    '{$faker->text()}',
                    '{$faker->randomElement($locatairesId)}')");
        
        $biensId[] = $pdo->lastInsertId();
         
        }
        
        
        // $tableContrat = "CREATE TABLE Contrat_location (
        //     id_contrat_loc INT AUTO_INCREMENT NOT NULL,
        //     prov_charges DOUBLE,
        //      loyer_mensuel DOUBLE,
        //     caution DOUBLE,
        //     jour_versement INT,
        //     date_entree DATE,
        //     fin_bail DATE,
        //     notes VARCHAR(250),
        //     id_locataire INT,
        //     id_bien INT,
        //     PRIMARY KEY (id_contrat_loc)) ENGINE=InnoDB;"; 
        $note = htmlspecialchars($faker->realText(100));
        
        for($i = 0 ;$i<20;$i++){
            $note = htmlspecialchars($faker->realText(100));
        
           $pdo->exec("INSERT INTO Contrat_location(nameId,prov_charges,loyer_mensuel,caution,jour_versement,date_entree,duree_bail,notes,id_locataire,id_bien)
           VALUES ('{$faker->domainName()}',
                    '{$faker->numberBetween(10, 300)}',
                    '{$faker->randomFloat(1, 200, 1000)}',
                    '{$faker->numberBetween(0, 1000)}',
                    '{$faker->numberBetween(1, 31)}',
                    '{$faker->date()}',
                    '{$faker->numberBetween(1, 10)}',
                    '{$note}',
                    '{$faker->randomElement($locatairesId)}',
                    '{$faker->randomElement($biensId)}')");
        
        }
        
        $pdo->exec('SET FOREIGN_KEY_CHECKS = 1');
    }

    $truncateLocataires = "TRUNCATE TABLE `locataire`";
    $truncateBiens = "TRUNCATE TABLE `biens`";
    $truncateContrat = "TRUNCATE TABLE `contrat_location`";
    $tuncateFactures = "TRUNCATE TABLE `facture`";
    $truncateReglement = "TRUNCATE TABLE `reglement`";
    $truncateLigneFact = "TRUNCATE TABLE `ligne_fact`";
    $truncateLigneRegl = "TRUNCATE TABLE `ligne_regl`";
    $truncatePayeur = "TRUNCATE TABLE `payeur`";

    echo "Empty table...\r\n";
    $pdo->exec('SET FOREIGN_KEY_CHECKS = 0');
    $pdo->exec($truncateLocataires);
    $pdo->exec($truncateBiens);
    $pdo->exec($truncateContrat);
    $pdo->exec($tuncateFactures);
    $pdo->exec($truncateLigneFact);
    $pdo->exec($truncateLigneRegl);
   // $pdo->exec($truncateReglement);
    $pdo->exec($truncatePayeur);

    
    echo "Filling table...\r\n";
    // $pdo->exec("INSERT INTO `locataire` (`id_locataire`, `codeLoc`, `civilite`, `nom`, `prenom`, `fixe`, `portable`, `email`, `profession`, `date_naissance`, `apl`, `allocation`) 
    //             VALUES (NULL, 'LOC001', NULL, 'Einstein', 'Albert', NULL, NULL, 'Einstein@rel.com', NULL, '2004-08-04', '1', NULL);");
    //  $pdo->exec("INSERT INTO `locataire` (`id_locataire`, `codeLoc`, `civilite`, `nom`, `prenom`, `fixe`, `portable`, `email`, `profession`, `date_naissance`, `apl`, `allocation`) 
    //             VALUES (NULL, 'LOC002', NULL, 'Galilei', 'Galileo', NULL, NULL, 'galileo@gps.com', NULL, '1564-02-15', '1', NULL);");  

    $pdo->exec("INSERT INTO `locataire` (`id_locataire`, `codeLoc`, `civilite`, `nom`, `prenom`, `fixe`, `portable`, `email`, `profession`, `date_naissance`, `apl`, `allocation`) VALUES
            (1, 'LOC001', NULL, 'Einstein', 'Albert', NULL, NULL, 'Einstein@rel.com', NULL, '2004-08-04', 1, NULL),
            (2, 'LOC002', NULL, 'Galilei', 'Galileo', NULL, NULL, 'galileo@gps.com', NULL, '1564-02-15', 1, NULL),
            (3, NULL, NULL, 'Pasteur', 'Louis', NULL, NULL, 'vaccin@rage.fr', NULL, '1822-12-27', 0, NULL),
            (4, NULL, NULL, 'Newton', 'Isaac', NULL, NULL, 'attraction@universelle.fr', NULL, '1942-12-25', 0, NULL),
            (5, NULL, NULL, 'Tesla', 'Nikola', NULL, NULL, 'elac@foudre.fr', NULL, '1956-09-10', 0, NULL),
            (6, NULL, NULL, 'Turing', 'Alan', NULL, NULL, 'enigma@cpu.fr', NULL, '1912-06-23', 0, NULL),
            (7, NULL, NULL, 'Curie', 'Marie', NULL, NULL, 'piqure@vaccin.fr', NULL, '1867-11-07', 0, NULL),
            (8, NULL, NULL, 'Hawking', 'Stephen', NULL, NULL, 'voieLactee@space.com', NULL, '1942-01-08', 0, NULL);");

    $pdo->exec("INSERT INTO `biens` (`id_bien`, `nom`, `type_Biens`, `adresse1`, `adresse2`, `ville`, `cp`, `description`, `id_contrat_loc`)
                VALUES (NULL, 'BIEN001', 'Appartement', 'Place de l\'etoile', NULL, 'Paris', '75001', NULL, NULL);");

    $pdo->exec("INSERT INTO `biens` (`id_bien`, `nom`, `type_Biens`, `adresse1`, `adresse2`, `ville`, `cp`, `description`, `id_contrat_loc`)
        VALUES (NULL, 'BIEN002', 'Appartement', 'Rue des meteores', NULL, 'Cergy', '95000', NULL, NULL);");

    $pdo->exec("INSERT INTO `contrat_location` (`id_contrat_loc`, `nameId`, `prov_charges`, `loyer_mensuel`, `caution`, `jour_versement`, `date_entree`, `duree_bail`, `notes`, `id_locataire`) 
            VALUES (NULL, 'CONT002', '75', '835', '800', '10', '2022-07-21', '3', NULL, '2');");
    $pdo->exec("INSERT INTO `contrat_location` (`id_contrat_loc`, `nameId`, `prov_charges`, `loyer_mensuel`, `caution`, `jour_versement`, `date_entree`, `duree_bail`, `notes`, `id_locataire`) 
             VALUES (NULL, 'CONT001', '66', '700', '774', '105', '2021-05-17', '3', NULL,'1');");

    $pdo->exec("INSERT INTO `payeur` (`id_payeur`, `nom_payeur`) 
        VALUES (NULL, 'Locataire'), (NULL, 'Caf')");
        
    $pdo->exec("INSERT INTO `type_fact` (`id_type_fact`, `nom_type_fact`)
        VALUES (NULL, 'Loyer'),
               (NULL, 'Apport en compte courant'),
               (NULL, 'Depot de garantie'),
               (NULL, 'Droit d\'entrée'),
               (NULL, 'Indemnité d\'assurance'),
               (NULL, 'Regularisation des charges'),
               (NULL, 'Remboursement du locataire : Charges locatives'),
               (NULL, 'Remboursement du locataire : Solde'),
               (NULL, 'Remboursement du locataire : Taxe ordure ménagère'),
               (NULL, 'Syndic : Remboursement de charge'),
               (NULL, 'Taxes et impots : Remboursement des impôts'),
               (NULL, 'Autre');");    

//montant DOUBLE,
// description_ligne VARCHAR(128),
// tva_ligne INT,
// id_contrat_loc INT,
// id_type_fact
    $pdo->exec("INSERT INTO `facture` (`id_facture`, `date_debut`, `date_fin`, `date_emission`,`montant_fact`,`description_ligne`,`tva_ligne`, `id_type_fact`,`id_contrat_loc`) 
            VALUES (NULL, '2024-01-01', '2024-01-31', '2024-01-09', '500','Un paiement au hazard','0','1','1'),
                     (NULL, '2024-02-01', '2024-02-29', '2024-04-01', '810','Un deuxieme paiement au hazard','20','3','1')");    

    $pdo->exec("INSERT INTO `ligne_fact` (`id_ligne`, `montant_ligne`, `tva_ligne`, `type_ligne`,`id_type_fact`, `id_facture`)
             VALUES (NULL, '555', '0', 'Loyer','1', '1'), (NULL, '500', '0', 'Depot','3', '1'),
                    (NULL, '498', '0', 'Loyer','1', '2')");

    $pdo->exec(("INSERT INTO `ligne_regl` (`id_ligne_regl`, `montant_regl`, `date_regl`, `description_regl`, `id_facture`, `id_payeur`)
             VALUES (NULL, '700', '2024-01-11', NULL, '1', '1'),
                    (NULL, '10', '2024-01-04', NULL, '1', '2'), 
                    (NULL, '350', '2024-02-10', NULL, '2', '1'),
                    (NULL, '400', '2024-02-24', NULL, '2', '1')
             ;"));



    // $pdo->exec("INSERT INTO `ligne_fact` (`id_ligne`, `montant_ligne`, `tva_ligne`, `type_ligne`, `id_facture`)
    //     VALUES (NULL, '498', '0', 'Loyer', '2'), (NULL, '136', '0', 'Charges', '2')");

        $pdo->exec('SET FOREIGN_KEY_CHECKS = 1');

echo "bdd successfully created\r\n";

 }
