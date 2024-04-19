<?php
 
 require  dirname(__DIR__) . '/vendor/autoload.php';
    echo  dirname(__DIR__) ;
 $pdo = App\Connection::getPDO();
 echo("init");
$create= 1;
$dropTableLoc = "DROP TABLE IF EXISTS Locataire ; ";
$dropTableContrat = "DROP TABLE IF EXISTS Contrat_location" ; 
$dropTableBiens = "DROP TABLE IF EXISTS Biens" ;
$dropTableFactures = "DROP TABLE IF EXISTS Facture" ;
$dropTableReglement = "DROP TABLE IF EXISTS Reglement" ;
$dropTableLigne_fact = "DROP TABLE IF EXISTS ligne_fact";
$dropTableLigne_regl = "DROP TABLE IF EXISTS ligne_regl";
$dropTablePayeur = "DROP TABLE IF EXISTS payeur";
$pdo->exec('SET FOREIGN_KEY_CHECKS = 0');

echo("drop");
if($create === 1){
    dump("create");
        $tableLoc = "CREATE TABLE Locataire (
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
            apl BOOL, allocation VARCHAR(15),
            PRIMARY KEY (id_locataire)) ENGINE=InnoDB;";


        $tableContrat = "CREATE TABLE Contrat_location (
            id_contrat_loc INT AUTO_INCREMENT NOT NULL,
            prov_charges DOUBLE, loyer_mensuel DOUBLE,
            caution DOUBLE,
            jour_versement INT,
            date_entree DATE,
            fin_bail DATE,
            notes VARCHAR(250),
            id_locataire INT,
            id_bien INT,
            PRIMARY KEY (id_contrat_loc)) ENGINE=InnoDB;"; 


        $tableBiens = "CREATE TABLE Biens (id_bien INT AUTO_INCREMENT NOT NULL,
                        nom VARCHAR(20),
                        type_Biens VARCHAR(20),
                        adresse1 VARCHAR(40),
                        adresse2 VARCHAR(40),
                        ville VARCHAR(30),
                        cp INT,
                        description VARCHAR(255),
                        id_contrat_loc INT,
                        PRIMARY KEY (id_bien)) ENGINE=InnoDB;";
        
        $tableFactures = "CREATE TABLE Facture (id_facture INT AUTO_INCREMENT NOT NULL,
                                                date_emission DATE,
                                                montant DOUBLE,
                                                id_contrat_loc INT,
                                                PRIMARY KEY (id_facture)) ENGINE=InnoDB; ";

        $tableReglement = "CREATE TABLE Reglement (id_reglement INT AUTO_INCREMENT NOT NULL,
                                                id_payeur INT,
                                                id_facture INT,
                                                PRIMARY KEY (id_reglement)) ENGINE=InnoDB;";

        $tableLigneFacture ="CREATE TABLE ligne_fact (id_ligne INT AUTO_INCREMENT NOT NULL,
                                                    montant DOUBLE, 
                                                    tva DOUBLE,
                                                    type VARCHAR(16),
                                                    description VARCHAR(128),
                                                    id_facture INT,
                                                    PRIMARY KEY (id_ligne)) ENGINE=InnoDB;";

        $tableLigneReglement = "CREATE TABLE ligne_regl (id_ligne INT AUTO_INCREMENT NOT NULL,
                                                    montant INT,
                                                    date DATE,
                                                    description VARCHAR(256),
                                                    id_reglement INT,
                                                     PRIMARY KEY (id_ligne)) ENGINE=InnoDB; ";
        
        $tablePayeur = "CREATE TABLE payeur (id_payeur INT AUTO_INCREMENT NOT NULL,
                                             nom VARCHAR(32),
                                             PRIMARY KEY (id_payeur_payeur)) ENGINE=InnoDB";
        $pdo->exec($dropTableContrat);
        $pdo->exec($dropTableLoc);
        $pdo->exec($dropTableFactures);
        $pdo->exec($dropTableBiens);
        $pdo->exec($dropTableReglement);
        $pdo->exec($dropTableLigne_fact);
        $pdo->exec($dropTableLigne_regl);
        $pdo->exec($dropTablePayeur);


        $pdo->exec($tableContrat);
        $pdo->exec($tableLoc);
        $pdo->exec($tableFactures);
        $pdo->exec($tableBiens);
        $pdo->exec($tableReglement);
        $pdo->exec($tableLigneFacture);
        $pdo->exec($tableLigneReglement);
        $pdo->exec($tablePayeur);

        $alterContrat = "ALTER TABLE Contrat_location ADD CONSTRAINT FK_Contrat_location_id_locataire FOREIGN KEY (id_locataire) REFERENCES Locataire (id_locataire)";
        $alterContrat02 = "ALTER TABLE Contrat_location ADD CONSTRAINT FK_Contrat_location_biens_id_bien_biens FOREIGN KEY (id_bien) REFERENCES Biens (id_bien)";
        $alterBiens = "ALTER TABLE Biens ADD CONSTRAINT FK_Biens_id_contrat_loc FOREIGN KEY (id_contrat_loc) REFERENCES Contrat_location (id_contrat_loc)";
        $alterFactures ="ALTER TABLE Facture ADD CONSTRAINT FK_Facture_id_contrat_loc FOREIGN KEY (id_contrat_loc) REFERENCES Contrat_location (id_contrat_loc)";
        $alterReglements = "ALTER TABLE Reglement ADD CONSTRAINT FK_Reglement_id_facture FOREIGN KEY (id_facture) REFERENCES Facture (id_facture)";
        $alterReglements02 ="ALTER TABLE Reglement ADD CONSTRAINT FK_Reglement_payeur_id_payeur_payeur FOREIGN KEY (id_payeur) REFERENCES payeur (id_payeur);";
        $alterLigneFact ="ALTER TABLE ligne_fact ADD CONSTRAINT FK_ligne_fact_id_facture FOREIGN KEY (id_facture) REFERENCES Facture (id_facture);";
        $alterLigneRegl = "ALTER TABLE ligne_regl ADD CONSTRAINT FK_ligne_regl_id_reglement FOREIGN KEY (id_reglement) REFERENCES Reglement (id_reglement);";
        
        
        $pdo->exec($alterContrat);
        $pdo->exec($alterContrat02);
        $pdo->exec($alterBiens);
        $pdo->exec($alterFactures);
        $pdo->exec($alterReglements);
        $pdo->exec($alterReglements02);
        $pdo->exec($alterLigneFact);
        $pdo->exec($alterLigneRegl);
        

        $pdo->exec('SET FOREIGN_KEY_CHECKS = 1');

}

// use the factory to create a Faker\Generator instance
$faker = Faker\Factory::create('fr_FR');

$truncateLocataires = "TRUNCATE TABLE `locataire`";
$truncateBiens = "TRUNCATE TABLE `biens`";
$truncateContrat = "TRUNCATE TABLE `contrat_location`";
$pdo->exec('SET FOREIGN_KEY_CHECKS = 0');
$pdo->exec($truncateLocataires);
$pdo->exec($truncateBiens);
$pdo->exec($truncateContrat);

//echo  $faker->date();
//echo $faker->time();

$locatairesId=[];
$biensId=[];
htmlspecialchars($faker->jobtitle());

// $sql = "INSERT INTO locataire(civilite,nom,prenom,fixe,portable,email,profession,date_naissance,apl,allocation)
//         VALUES ('{$faker->title()}','{$faker->lastName()}','{$faker->firstName()}','{$faker->phoneNumber()}','{$faker->phoneNumber()}','{$faker->email()}',`{htmlspecialchars($faker->jobtitle())}`','{$faker->date()}','{$faker->numberBetween(0, 1)}','{$faker->numberBetween(0, 1000)}')";
//echo $sql;

for($i = 0 ;$i<5;$i++){
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
   VALUES ('{$faker->domainName()}',
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

   $pdo->exec("INSERT INTO Contrat_location(prov_charges,loyer_mensuel,caution,jour_versement,date_entree,fin_bail,notes,id_locataire,id_bien)
   VALUES ('{$faker->numberBetween(10, 300)}',
            '{$faker->randomFloat(1, 200, 1000)}',
            '{$faker->numberBetween(0, 1000)}',
            '{$faker->numberBetween(1, 31)}',
            '{$faker->date()}',
            '{$faker->date()}',
            '{$note}',
            '{$faker->randomElement($locatairesId)}',
            '{$faker->randomElement($biensId)}')");

}

$password = password_hash('admin',PASSWORD_BCRYPT);
$pdo->exec("INSERT INTO users SET username='admin' ,user_password='$password' ");

$pdo->exec('SET FOREIGN_KEY_CHECKS = 1');
