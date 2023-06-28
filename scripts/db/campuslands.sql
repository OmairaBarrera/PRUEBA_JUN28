CREATE DATABASE campuslands;
USE campuslands;
CREATE TABLE pais(
    idPais INT NOT NULL PRIMARY KEY, 
    nombrePais VARCHAR(50)UNIQUE
);
CREATE TABLE departamento(
    idDep INT NOT NULL PRIMARY KEY, 
    nombreDep VARCHAR(50) UNIQUE, 
    idPais INT
);
CREATE TABLE region(
    idReg INT NOT NULL PRIMARY KEY, 
    nombreReg VARCHAR(60) UNIQUE, 
    idDep INT
);
CREATE TABLE campers(
    idCamper INT NOT NULL PRIMARY KEY, 
    nombreCamper VARCHAR(50), 
    apellidoCamper VARCHAR(50), 
    fechaNac DATE, 
    idReg INT
);
ALTER TABLE `departamento`
    ADD CONSTRAINT `idPais` FOREIGN KEY (`idPais`) REFERENCES `pais` (`idPais`) ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE `region`   
    ADD CONSTRAINT `idDep` FOREIGN KEY (`idDep`) REFERENCES `departamento` (`idDep`) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE `campers`   
    ADD CONSTRAINT `idReg` FOREIGN KEY (`idReg`) REFERENCES `region` (`idReg`) ON DELETE RESTRICT ON UPDATE CASCADE;
