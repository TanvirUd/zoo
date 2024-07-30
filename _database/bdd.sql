  /**
  * BDAUTHENTIFICATION
  * Base de donnée BdAuthentification
  * Version 1.0
  * 2024-07-24
  * Auteur : Tanvir Uddin, Camille Reverdy, Herinavalona Romy Teixeira
  */ 

  /* Creer l`utilisateur bdauthentification */
  CREATE USER IF NOT EXISTS bdauthentification@localhost IDENTIFIED BY 'BdAuthentification';
  /* Creer la base de donnée BdAuthentification */
  DROP DATABASE IF EXISTS BdAuthentification;
  CREATE DATABASE IF NOT EXISTS BdAuthentification CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci;
  GRANT ALL PRIVILEGES ON BdAuthentification.* TO bdauthentification@localhost;
  GRANT CREATE USER ON *.* TO bdauthentification@localhost;
  GRANT GRANT OPTION ON *.* TO bdauthentification@localhost;
  FLUSH PRIVILEGES;

/* Utiliser la base de donnée BdAuthentification */
  USE BdAuthentification;

/* Creer le table personnel */
  CREATE TABLE IF NOT EXISTS `Personnel` (
    `numMatriculePerso` VARCHAR(4) NOT NULL,
    `melPerso` VARCHAR(50) NOT NULL,
    `mdpPerso` VARCHAR(255) NOT NULL,
    `nomPerso` VARCHAR(50),
    `prenomPerso` VARCHAR(50),
    `dateNaissancePerso` DATE,
    `adressePerso` VARCHAR(255),
    `telPerso` INT(10),
    `numService` INT(10),
    PRIMARY KEY (`numMatriculePerso`)
  ) ENGINE=INNODB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

  /* Creer le table application */
  CREATE TABLE IF NOT EXISTS `Application` (
    `idAppli` INT(10) NOT NULL AUTO_INCREMENT,
    `nomAppli` VARCHAR(50) NOT NULL,
    `dbAppli` VARCHAR(50) NOT NULL,
    PRIMARY KEY (`idAppli`)
  ) ENGINE=INNODB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

/* Creer le table role applicatif */
  CREATE TABLE IF NOT EXISTS `RoleApplicatif` (
    `idAppli` INT(10) NOT NULL,
    `idRoleAppli` VARCHAR(50) NOT NULL,
    `mdpRoleAppli` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`idRoleAppli`),
    FOREIGN KEY (`idAppli`) REFERENCES `Application`(`idAppli`)
  ) ENGINE=INNODB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

/* Creer le table est habilité */
  CREATE TABLE IF NOT EXISTS `EstHabilite` (
    `numMatriculePerso` VARCHAR(4) NOT NULL,
    `idAppli` INT(10) NOT NULL,
    `idRoleAppli` VARCHAR(50) NOT NULL,
    PRIMARY KEY (`numMatriculePerso`, `idAppli`, `idRoleAppli`),
    FOREIGN KEY (`numMatriculePerso`) REFERENCES `Personnel`(`numMatriculePerso`),
    FOREIGN KEY (`idAppli`) REFERENCES `RoleApplicatif`(`idAppli`),
    FOREIGN KEY (`idRoleAppli`) REFERENCES `RoleApplicatif`(`idRoleAppli`)
  ) ENGINE=INNODB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

