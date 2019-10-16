-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema opisk_c8ikja00
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema opisk_c8ikja00
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `opisk_c8ikja00` DEFAULT CHARACTER SET utf8 ;
USE `opisk_c8ikja00` ;

-- -----------------------------------------------------
-- Table `opisk_c8ikja00`.`Kayttajat`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `opisk_c8ikja00`.`Kayttajat` (
  `kayttajatunnus` VARCHAR(255) NOT NULL,
  `salasanaHash` VARCHAR(255) NOT NULL,
  `etunimi` VARCHAR(255) NULL DEFAULT NULL,
  `sukunimi` VARCHAR(255) NULL DEFAULT NULL,
  `kuva` VARCHAR(255) NULL DEFAULT 'kayttaja-placeholder.png',
  `kuvaus` TEXT NULL DEFAULT NULL,
  PRIMARY KEY (`kayttajatunnus`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `opisk_c8ikja00`.`Vaikeustasot`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `opisk_c8ikja00`.`Vaikeustasot` (
  `vaikeustasoId` INT(11) NOT NULL AUTO_INCREMENT,
  `nimi` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`vaikeustasoId`),
  UNIQUE INDEX `nimi_UNIQUE` (`nimi` ASC))
ENGINE = InnoDB
AUTO_INCREMENT = 11
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `opisk_c8ikja00`.`Ohjelmat`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `opisk_c8ikja00`.`Ohjelmat` (
  `ohjelmaId` INT(11) NOT NULL AUTO_INCREMENT,
  `kayttajatunnus` VARCHAR(255) NULL DEFAULT NULL,
  `nimi` VARCHAR(255) NOT NULL,
  `luotu` DATETIME NOT NULL,
  `vaikeustasoId` INT(11) NULL DEFAULT NULL,
  `kuva` VARCHAR(255) NOT NULL DEFAULT 'ohjelma-placeholder.png',
  PRIMARY KEY (`ohjelmaId`),
  INDEX `fk_ohjelmat_kayttajat` (`kayttajatunnus` ASC),
  INDEX `fk_ohjelmat_vaikeustasot` (`vaikeustasoId` ASC),
  CONSTRAINT `FK_Ohjelmat_kayttajatunnus`
    FOREIGN KEY (`kayttajatunnus`)
    REFERENCES `opisk_c8ikja00`.`Kayttajat` (`kayttajatunnus`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `FK_Ohjelmat_vaikeustasoId`
    FOREIGN KEY (`vaikeustasoId`)
    REFERENCES `opisk_c8ikja00`.`Vaikeustasot` (`vaikeustasoId`)
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 34
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `opisk_c8ikja00`.`Harjoitukset`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `opisk_c8ikja00`.`Harjoitukset` (
  `harjoitusId` INT(11) NOT NULL AUTO_INCREMENT,
  `ohjelmaId` INT(11) NOT NULL,
  `nimi` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`harjoitusId`, `ohjelmaId`),
  INDEX `fk_Harjoitukset_Ohjelmat1_idx` (`ohjelmaId` ASC),
  CONSTRAINT `FK_Harjoitukset_ohjelmaId`
    FOREIGN KEY (`ohjelmaId`)
    REFERENCES `opisk_c8ikja00`.`Ohjelmat` (`ohjelmaId`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 75
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `opisk_c8ikja00`.`Lisaykset`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `opisk_c8ikja00`.`Lisaykset` (
  `ohjelmaId` INT(11) NOT NULL,
  `kayttajatunnus` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`ohjelmaId`, `kayttajatunnus`),
  INDEX `fk_lisaykset_kayttajat1_idx` (`kayttajatunnus` ASC),
  INDEX `fk_Lisaykset_Ohjelmat1_idx` (`ohjelmaId` ASC),
  CONSTRAINT `FK_Lisaykset_kayttajatunnus`
    FOREIGN KEY (`kayttajatunnus`)
    REFERENCES `opisk_c8ikja00`.`Kayttajat` (`kayttajatunnus`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `FK_Lisaykset_ohjelmaId`
    FOREIGN KEY (`ohjelmaId`)
    REFERENCES `opisk_c8ikja00`.`Ohjelmat` (`ohjelmaId`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `opisk_c8ikja00`.`Seuraukset`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `opisk_c8ikja00`.`Seuraukset` (
  `seuraaja` VARCHAR(255) NOT NULL,
  `seurattava` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`seuraaja`, `seurattava`),
  INDEX `fk_kayttajat_has_kayttajat_kayttajat2_idx` (`seurattava` ASC),
  INDEX `fk_kayttajat_has_kayttajat_kayttajat1_idx` (`seuraaja` ASC),
  CONSTRAINT `FK_Seuraukset_seuraaja`
    FOREIGN KEY (`seuraaja`)
    REFERENCES `opisk_c8ikja00`.`Kayttajat` (`kayttajatunnus`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `FK_Seuraukset_seurattava`
    FOREIGN KEY (`seurattava`)
    REFERENCES `opisk_c8ikja00`.`Kayttajat` (`kayttajatunnus`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `opisk_c8ikja00`.`Suoritukset`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `opisk_c8ikja00`.`Suoritukset` (
  `suoritusId` INT(11) NOT NULL AUTO_INCREMENT,
  `kayttajatunnus` VARCHAR(255) NOT NULL,
  `suoritusPvm` DATE NOT NULL,
  `kesto` INT(11) NOT NULL,
  `harjoitusId` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`suoritusId`, `kayttajatunnus`),
  INDEX `fk_suoritukset_kayttajat1_idx` (`kayttajatunnus` ASC),
  INDEX `fk_suoritukset_harjoitukset1_idx` (`harjoitusId` ASC),
  CONSTRAINT `FK_Suoritukset_harjoitusId`
    FOREIGN KEY (`harjoitusId`)
    REFERENCES `opisk_c8ikja00`.`Harjoitukset` (`harjoitusId`)
    ON DELETE SET NULL
    ON UPDATE SET NULL,
  CONSTRAINT `FK_Suoritukset_kayttajatunnus`
    FOREIGN KEY (`kayttajatunnus`)
    REFERENCES `opisk_c8ikja00`.`Kayttajat` (`kayttajatunnus`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 19
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `opisk_c8ikja00`.`Vaiheet`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `opisk_c8ikja00`.`Vaiheet` (
  `vaiheId` INT(11) NOT NULL AUTO_INCREMENT,
  `harjoitusId` INT(11) NOT NULL,
  `nimi` VARCHAR(255) NOT NULL,
  `ohjelinkki` VARCHAR(255) NULL DEFAULT NULL,
  `kuvaus` TEXT NULL DEFAULT NULL,
  PRIMARY KEY (`vaiheId`, `harjoitusId`),
  INDEX `fk_Vaiheet_Harjoitukset1_idx` (`harjoitusId` ASC),
  CONSTRAINT `FK_Vaiheet_harjoitusId`
    FOREIGN KEY (`harjoitusId`)
    REFERENCES `opisk_c8ikja00`.`Harjoitukset` (`harjoitusId`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 40
DEFAULT CHARACTER SET = utf8;

USE `opisk_c8ikja00` ;

-- -----------------------------------------------------
-- Placeholder table for view `opisk_c8ikja00`.`KayttajatJulkinen`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `opisk_c8ikja00`.`KayttajatJulkinen` (`kayttajatunnus` INT, `etunimi` INT, `sukunimi` INT, `kuva` INT, `kuvaus` INT);

-- -----------------------------------------------------
-- Placeholder table for view `opisk_c8ikja00`.`OhjelmatPitka`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `opisk_c8ikja00`.`OhjelmatPitka` (`ohjelmaId` INT, `kayttajatunnus` INT, `nimi` INT, `luotu` INT, `vaikeustasoId` INT, `kuva` INT, `Vaikeustaso` INT);

-- -----------------------------------------------------
-- Placeholder table for view `opisk_c8ikja00`.`SuorituksetPitka`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `opisk_c8ikja00`.`SuorituksetPitka` (`suoritusId` INT, `kayttajatunnus` INT, `suoritusPvm` INT, `kesto` INT, `harjoitusId` INT, `ohjelmaId` INT, `ohjelma` INT, `harjoitus` INT);

-- -----------------------------------------------------
-- Placeholder table for view `opisk_c8ikja00`.`SuosituimmatOhjelmat`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `opisk_c8ikja00`.`SuosituimmatOhjelmat` (`ohjelmaId` INT, `kayttajatunnus` INT, `nimi` INT, `luotu` INT, `vaikeustasoId` INT, `kuva` INT);

-- -----------------------------------------------------
-- Placeholder table for view `opisk_c8ikja00`.`UusimmatOhjelmat`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `opisk_c8ikja00`.`UusimmatOhjelmat` (`ohjelmaId` INT, `kayttajatunnus` INT, `nimi` INT, `luotu` INT, `vaikeustasoId` INT, `kuva` INT, `Vaikeustaso` INT);

-- -----------------------------------------------------
-- procedure HaeKayttaja
-- -----------------------------------------------------

DELIMITER $$
USE `opisk_c8ikja00`$$
CREATE DEFINER=`c8ikja00`@`%` PROCEDURE `HaeKayttaja`(
	IN iKayttajatunnus VARCHAR(255)
)
BEGIN
	SELECT 
		*
	FROM 
		KayttajatJulkinen	
	WHERE 
		kayttajatunnus = iKayttajatunnus;
END$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure HaeKayttajanOhjelmat
-- -----------------------------------------------------

DELIMITER $$
USE `opisk_c8ikja00`$$
CREATE DEFINER=`c8ikja00`@`%` PROCEDURE `HaeKayttajanOhjelmat`(
	IN iKayttajatunnus VARCHAR(255)
)
BEGIN
	SELECT OhjelmatPitka.*,
        COUNT(Harjoitukset.harjoitusId) AS harjoituksia
	FROM 
		OhjelmatPitka 
	LEFT JOIN
		Harjoitukset
	ON
		OhjelmatPitka.ohjelmaId = Harjoitukset.ohjelmaId
    WHERE 
		kayttajatunnus = iKayttajatunnus
	GROUP BY
		OhjelmatPitka.ohjelmaId;
END$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure HaeKayttajanSuorituksetPitka
-- -----------------------------------------------------

DELIMITER $$
USE `opisk_c8ikja00`$$
CREATE DEFINER=`c8ikja00`@`%` PROCEDURE `HaeKayttajanSuorituksetPitka`(
	IN iKayttajatunnus VARCHAR(255)
)
BEGIN
	SELECT 
		*
    FROM 
		SuorituksetPitka
	WHERE
		kayttajatunnus = iKayttajatunnus;
END$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure HaeKayttajanViimeisimmatSuoritukset
-- -----------------------------------------------------

DELIMITER $$
USE `opisk_c8ikja00`$$
CREATE DEFINER=`c8ikja00`@`%` PROCEDURE `HaeKayttajanViimeisimmatSuoritukset`(
	IN iKayttajatunnus VARCHAR(255)
)
BEGIN
	SELECT
		Suoritukset.*,
        Ohjelmat.nimi AS ohjelma,
        Ohjelmat.ohjelmaId AS ohjelmaId,
        Harjoitukset.nimi AS harjoitus
	FROM 
		Suoritukset
	JOIN
		Harjoitukset
	ON
		Suoritukset.harjoitusId = Harjoitukset.harjoitusId
	JOIN
		Ohjelmat
	ON
		Harjoitukset.ohjelmaId = Ohjelmat.ohjelmaId
	WHERE
		Suoritukset.kayttajatunnus = iKayttajatunnus
	ORDER BY
		Suoritukset.suoritusPvm DESC
	LIMIT
		5;
END$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure HaeSeuratut
-- -----------------------------------------------------

DELIMITER $$
USE `opisk_c8ikja00`$$
CREATE DEFINER=`c8ikja00`@`%` PROCEDURE `HaeSeuratut`(
	IN iSeuraaja VARCHAR(255)
)
BEGIN
	SELECT 
		KayttajatJulkinen.*
    FROM 
		Seuraukset
	JOIN
		KayttajatJulkinen
	ON
		Seuraukset.seurattava = KayttajatJulkinen.kayttajatunnus
    WHERE
		Seuraukset.seuraaja = iSeuraaja;
END$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure PaivitaHarjoitus
-- -----------------------------------------------------

DELIMITER $$
USE `opisk_c8ikja00`$$
CREATE DEFINER=`c8ikja00`@`%` PROCEDURE `PaivitaHarjoitus`(
	IN iharjoitusId INT(11),
    IN inimi VARCHAR(255),
	IN iohjelmaId INT(11)
)
BEGIN
	UPDATE harjoitukset
	SET 
	  ohjelmaId = iohjelmaId, 
	  nimi = iNimi
	WHERE harjoitusId = iharjoitusId;
END$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure PaivitaKayttaja
-- -----------------------------------------------------

DELIMITER $$
USE `opisk_c8ikja00`$$
CREATE DEFINER=`c8ikja00`@`%` PROCEDURE `PaivitaKayttaja`(
	IN ikayttajatunnus VARCHAR(255),
    IN ietunimi VARCHAR(255),
    IN isukunimi VARCHAR(255),
    IN ikuva VARCHAR(255),
    IN ikuvaus VARCHAR(255)
)
BEGIN
	UPDATE Kayttajat 
    SET
		etunimi = ietunimi,
        sukunimi = isukunimi,
        kuva = ikuva,
        kuvaus = ikuvaus
	WHERE kayttajatunnus = ikayttajatunnus;
END$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure PaivitaSuoritus
-- -----------------------------------------------------

DELIMITER $$
USE `opisk_c8ikja00`$$
CREATE DEFINER=`c8ikja00`@`%` PROCEDURE `PaivitaSuoritus`(
	IN iSuoritusId INT(11),
    IN iKayttajatunnus VARCHAR(255),
    IN iSuoritusPvm DATETIME,
    IN iKesto INT(11),
    IN iHarjoitusId INT(11)
)
BEGIN
	UPDATE Suoritukset
    SET
		kayttajatunnus = iKayttajatunnus,
        suoritusPvm = iSuoritusPvm,
        kesto = iKesto,
        harjoitusId = iHarjoitusId
	WHERE suoritusId = iSuoritusId;
END$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure UusiHarjoitus
-- -----------------------------------------------------

DELIMITER $$
USE `opisk_c8ikja00`$$
CREATE DEFINER=`c8ikja00`@`%` PROCEDURE `UusiHarjoitus`(
	IN iNimi VARCHAR(255),
    IN iOhjelmaId INT(11),
	OUT oHarjoitusId INT(11)
)
BEGIN

	INSERT INTO Harjoitukset
		(ohjelmaId, nimi)
	VALUES
		(iOhjelmaId, niNimi);

	SELECT LAST_INSERT_ID() INTO oHarjoitusId;
END$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure UusiKayttaja
-- -----------------------------------------------------

DELIMITER $$
USE `opisk_c8ikja00`$$
CREATE DEFINER=`c8ikja00`@`%` PROCEDURE `UusiKayttaja`(
	IN iKayttajatunnus VARCHAR(255),
    IN iSalasanaHash VARCHAR(255)
)
BEGIN
	INSERT INTO
		Kayttajat (kayttajatunnus, salasanaHash)
	VALUES
		(iKayttajatunnus, iSalasanaHash);
END$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure UusiSuoritus
-- -----------------------------------------------------

DELIMITER $$
USE `opisk_c8ikja00`$$
CREATE DEFINER=`c8ikja00`@`%` PROCEDURE `UusiSuoritus`(
	IN iKayttajatunnus VARCHAR(255),
    IN iSuoritusPvm DATE,
    IN iKesto INT(11),
    IN iHarjoitusId INT(11),
    OUT oSuoritusId INT(11)
)
BEGIN

INSERT INTO Suoritukset
	(kayttajatunnus, suoritusPvm, kesto, harjoitusId)
VALUES
	(iKayttajatunnus, iSuoritusPvm, iKesto, iHarjoitusId);

SELECT LAST_INSERT_ID() INTO oSuoritusId;

END$$

DELIMITER ;

-- -----------------------------------------------------
-- View `opisk_c8ikja00`.`KayttajatJulkinen`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `opisk_c8ikja00`.`KayttajatJulkinen`;
USE `opisk_c8ikja00`;
CREATE  OR REPLACE ALGORITHM=UNDEFINED DEFINER=`c8ikja00`@`%` SQL SECURITY DEFINER VIEW `opisk_c8ikja00`.`KayttajatJulkinen` AS select `opisk_c8ikja00`.`Kayttajat`.`kayttajatunnus` AS `kayttajatunnus`,`opisk_c8ikja00`.`Kayttajat`.`etunimi` AS `etunimi`,`opisk_c8ikja00`.`Kayttajat`.`sukunimi` AS `sukunimi`,`opisk_c8ikja00`.`Kayttajat`.`kuva` AS `kuva`,`opisk_c8ikja00`.`Kayttajat`.`kuvaus` AS `kuvaus` from `opisk_c8ikja00`.`Kayttajat`;

-- -----------------------------------------------------
-- View `opisk_c8ikja00`.`OhjelmatPitka`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `opisk_c8ikja00`.`OhjelmatPitka`;
USE `opisk_c8ikja00`;
CREATE  OR REPLACE ALGORITHM=UNDEFINED DEFINER=`c8ikja00`@`%` SQL SECURITY DEFINER VIEW `opisk_c8ikja00`.`OhjelmatPitka` AS select `opisk_c8ikja00`.`Ohjelmat`.`ohjelmaId` AS `ohjelmaId`,`opisk_c8ikja00`.`Ohjelmat`.`kayttajatunnus` AS `kayttajatunnus`,`opisk_c8ikja00`.`Ohjelmat`.`nimi` AS `nimi`,`opisk_c8ikja00`.`Ohjelmat`.`luotu` AS `luotu`,`opisk_c8ikja00`.`Ohjelmat`.`vaikeustasoId` AS `vaikeustasoId`,`opisk_c8ikja00`.`Ohjelmat`.`kuva` AS `kuva`,`opisk_c8ikja00`.`Vaikeustasot`.`nimi` AS `Vaikeustaso` from (`opisk_c8ikja00`.`Ohjelmat` join `opisk_c8ikja00`.`Vaikeustasot` on((`opisk_c8ikja00`.`Ohjelmat`.`vaikeustasoId` = `opisk_c8ikja00`.`Vaikeustasot`.`vaikeustasoId`)));

-- -----------------------------------------------------
-- View `opisk_c8ikja00`.`SuorituksetPitka`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `opisk_c8ikja00`.`SuorituksetPitka`;
USE `opisk_c8ikja00`;
CREATE  OR REPLACE ALGORITHM=UNDEFINED DEFINER=`c8ikja00`@`%` SQL SECURITY DEFINER VIEW `opisk_c8ikja00`.`SuorituksetPitka` AS select `opisk_c8ikja00`.`Suoritukset`.`suoritusId` AS `suoritusId`,`opisk_c8ikja00`.`Suoritukset`.`kayttajatunnus` AS `kayttajatunnus`,`opisk_c8ikja00`.`Suoritukset`.`suoritusPvm` AS `suoritusPvm`,`opisk_c8ikja00`.`Suoritukset`.`kesto` AS `kesto`,`opisk_c8ikja00`.`Suoritukset`.`harjoitusId` AS `harjoitusId`,`opisk_c8ikja00`.`Ohjelmat`.`ohjelmaId` AS `ohjelmaId`,`opisk_c8ikja00`.`Ohjelmat`.`nimi` AS `ohjelma`,`opisk_c8ikja00`.`Harjoitukset`.`nimi` AS `harjoitus` from ((`opisk_c8ikja00`.`Suoritukset` left join `opisk_c8ikja00`.`Harjoitukset` on((`opisk_c8ikja00`.`Harjoitukset`.`harjoitusId` = `opisk_c8ikja00`.`Suoritukset`.`harjoitusId`))) left join `opisk_c8ikja00`.`Ohjelmat` on((`opisk_c8ikja00`.`Harjoitukset`.`ohjelmaId` = `opisk_c8ikja00`.`Ohjelmat`.`ohjelmaId`)));

-- -----------------------------------------------------
-- View `opisk_c8ikja00`.`SuosituimmatOhjelmat`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `opisk_c8ikja00`.`SuosituimmatOhjelmat`;
USE `opisk_c8ikja00`;
CREATE  OR REPLACE ALGORITHM=UNDEFINED DEFINER=`c8ikja00`@`%` SQL SECURITY DEFINER VIEW `opisk_c8ikja00`.`SuosituimmatOhjelmat` AS select `opisk_c8ikja00`.`Ohjelmat`.`ohjelmaId` AS `ohjelmaId`,`opisk_c8ikja00`.`Ohjelmat`.`kayttajatunnus` AS `kayttajatunnus`,`opisk_c8ikja00`.`Ohjelmat`.`nimi` AS `nimi`,`opisk_c8ikja00`.`Ohjelmat`.`luotu` AS `luotu`,`opisk_c8ikja00`.`Ohjelmat`.`vaikeustasoId` AS `vaikeustasoId`,`opisk_c8ikja00`.`Ohjelmat`.`kuva` AS `kuva` from (`opisk_c8ikja00`.`Ohjelmat` join `opisk_c8ikja00`.`Lisaykset` on((`opisk_c8ikja00`.`Ohjelmat`.`ohjelmaId` = `opisk_c8ikja00`.`Lisaykset`.`ohjelmaId`)));

-- -----------------------------------------------------
-- View `opisk_c8ikja00`.`UusimmatOhjelmat`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `opisk_c8ikja00`.`UusimmatOhjelmat`;
USE `opisk_c8ikja00`;
CREATE  OR REPLACE ALGORITHM=UNDEFINED DEFINER=`c8ikja00`@`%` SQL SECURITY DEFINER VIEW `opisk_c8ikja00`.`UusimmatOhjelmat` AS select `OhjelmatPitka`.`ohjelmaId` AS `ohjelmaId`,`OhjelmatPitka`.`kayttajatunnus` AS `kayttajatunnus`,`OhjelmatPitka`.`nimi` AS `nimi`,`OhjelmatPitka`.`luotu` AS `luotu`,`OhjelmatPitka`.`vaikeustasoId` AS `vaikeustasoId`,`OhjelmatPitka`.`kuva` AS `kuva`,`OhjelmatPitka`.`Vaikeustaso` AS `Vaikeustaso` from `opisk_c8ikja00`.`OhjelmatPitka` order by `OhjelmatPitka`.`luotu` desc limit 4;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
