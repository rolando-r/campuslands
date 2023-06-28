# campuslands

NOMBRE:
# Rolando Rodriguez Garcia
CURSO:
# Apolo J1


mysql -h localhost -u campus -p

CREATE DATABASE campuslands

USE campuslands

CREATE TABLE departamento(
    idDep INT(11) NOT NULL AUTO_INCREMENT,
    nombreDep VARCHAR(50) UNIQUE NOT NULL,
    idPais int(11),
    CONSTRAINT pk_departamento PRIMARY KEY (idDep),
    CONSTRAINT fk_deppais FOREIGN KEY (idPais) REFERENCES pais(idPais)
);

CREATE TABLE pais(
    idPais INT(11) NOT NULL AUTO_INCREMENT,
    nombrePais VARCHAR(20) UNIQUE NOT NULL,
    CONSTRAINT pk_pais PRIMARY KEY (idPais)
);

CREATE TABLE region(
    idReg INT(11) NOT NULL AUTO_INCREMENT,
    nombreReg VARCHAR(20) UNIQUE NOT NULL,
    idDep INT(11),
    CONSTRAINT pk_region PRIMARY KEY (idReg),
    CONSTRAINT fk_regdep FOREIGN KEY (idDep) REFERENCES departamento(idDep)
);

CREATE TABLE campers(
    idCamper VARCHAR(20) NOT NULL,
    nombreCamper VARCHAR(50) NOT NULL,
    apellidoCamper VARCHAR(50) NOT NULL,
    fechaNac DATE,
    idReg INT(11),
    CONSTRAINT pk_campers PRIMARY KEY (idCamper),
    CONSTRAINT fk_camperreg FOREIGN KEY (IdReg) REFERENCES region(idReg)
);