CREATE USER 'animaux_coordinateur'@'localhost' IDENTIFIED BY 'coord';
GRANT SELECT, INSERT ON BdAnimals.* TO 'animaux_coordinateur'@'localhost';

CREATE USER 'animaux_developpeur'@'localhost' IDENTIFIED BY 'devel';
GRANT ALL ON BdAnimals.* TO 'animaux_developpeur'@'localhost' WITH GRANT OPTION;

CREATE USER 'animaux_superviseur'@'localhost' IDENTIFIED BY 'super';
GRANT SELECT, UPDATE, INSERT, DELETE ON BdAnimals.* TO 'animaux_superviseur'@'localhost';