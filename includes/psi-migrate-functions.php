<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function psi_tables() {

	/** @var wpdb $wpdb */
	global $wpdb;

	return array(
		'tblarticle'                 => array(
			'query' => "CREATE TABLE IF NOT EXISTS `tblarticle` (
		`Article_Id` INT(11) NOT NULL AUTO_INCREMENT,
		`Article_Title` VARCHAR(255) NULL DEFAULT NULL,
  		PRIMARY KEY (`Article_Id`))
		ENGINE = InnoDB
		AUTO_INCREMENT = 1
		DEFAULT CHARACTER SET = utf8;",
		),
		'tblmaterial_type'           => array(
			'query' => "CREATE TABLE IF NOT EXISTS `tblmaterial_type` (
  `Material_Type_Id` INT(11) NOT NULL AUTO_INCREMENT,
  `Material_Type_Name` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`Material_Type_Id`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;",
			'column' => 'Material_Type_Name',
		),
		'tblpublisher'               => array(
			'query' => "CREATE TABLE IF NOT EXISTS `tblpublisher` (
  `Publisher_Id` INT(11) NOT NULL AUTO_INCREMENT,
  `Publisher_Name` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`Publisher_Id`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;",
			'column' => 'Publisher_Name',
		),
		'tblauthor'                  => array(
			'query' => "CREATE TABLE IF NOT EXISTS `tblauthor` (
  `Author_Id` INT(11) NOT NULL AUTO_INCREMENT,
  `Author_Name` TEXT NULL DEFAULT NULL,
  PRIMARY KEY (`Author_Id`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;",
			'column' => 'Author_Name',
		),
		'tblfull_text'               => array(
			'query' => "CREATE TABLE IF NOT EXISTS `tblfull_text` (
  `Full_Text_Id` INT(11) NOT NULL AUTO_INCREMENT,
  `Full_Text_Content` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`Full_Text_Id`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;",
			'column' => 'Full_Text_Content',
		),
		'tblindex'                   => array(
			'query' => "CREATE TABLE IF NOT EXISTS `tblindex` (
  `Index_Id` INT(11) NOT NULL AUTO_INCREMENT,
  `Index_Content` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`Index_Id`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;",
			'column' => 'Index_Content',
		),
		'tblsource_type'             => array(
			'query' => "CREATE TABLE IF NOT EXISTS `tblsource_type` (
  `Source_Type_Id` INT(11) NOT NULL AUTO_INCREMENT,
  `Source_Type_Name` VARCHAR(100) NULL DEFAULT NULL,
  PRIMARY KEY (`Source_Type_Id`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;",
			'column' => 'Source_Type_name',
		),
		'tblyear'                    => array(
			'query' => "CREATE TABLE IF NOT EXISTS `tblyear` (
  `Year_Id` INT(11) NOT NULL AUTO_INCREMENT,
  `Year_Name` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`Year_Id`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;",
			'column' => 'Year_Name',
		),
		'tblsource'                  => array(
			'query' => "CREATE TABLE IF NOT EXISTS `tblsource` (
  `Source_Id` INT(11) NOT NULL AUTO_INCREMENT,
  `Source_Title` TEXT NULL DEFAULT NULL,
  `Source_Type_Id` INT(11) NULL DEFAULT NULL,
  `Author_Id` INT(11) NULL DEFAULT NULL,
  `Publisher_Id` INT(11) NULL DEFAULT NULL,
  `Year_Id` INT(11) NULL DEFAULT NULL,
  `Source_Month` VARCHAR(255) NULL DEFAULT NULL,
  `Index_Id` INT(11) NULL DEFAULT NULL,
  `Full_Text_Id` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`Source_Id`),
  INDEX `source_type_fk_idx` (`Source_Type_Id` ASC),
  INDEX `author_FK_idx` (`Author_Id` ASC),
  INDEX `Publisher_Fk_idx` (`Publisher_Id` ASC),
  INDEX `year_FK_idx` (`Year_Id` ASC),
  INDEX `index_fk_idx` (`Index_Id` ASC),
  INDEX `full_text_FK_idx` (`Full_Text_Id` ASC),
  CONSTRAINT `Publisher_Fk`
    FOREIGN KEY (`Publisher_Id`)
    REFERENCES `tblpublisher` (`Publisher_Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `author_FK`
    FOREIGN KEY (`Author_Id`)
    REFERENCES `tblauthor` (`Author_Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `full_text_FK`
    FOREIGN KEY (`Full_Text_Id`)
    REFERENCES `tblfull_text` (`Full_Text_Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `index_fk`
    FOREIGN KEY (`Index_Id`)
    REFERENCES `tblindex` (`Index_Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `source_type_fk`
    FOREIGN KEY (`Source_Type_Id`)
    REFERENCES `tblsource_type` (`Source_Type_Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `year_FK`
    FOREIGN KEY (`Year_Id`)
    REFERENCES `tblyear` (`Year_Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;",
		),
		'tblarticle_source'          => array(
			'query' => "CREATE TABLE IF NOT EXISTS `tblarticle_source` (
  `Article_Source_Id` INT(11) NOT NULL AUTO_INCREMENT,
  `Source_Id` INT(11) NULL DEFAULT NULL,
  `Article_Id` INT(11) NULL DEFAULT NULL,
  `Material_Type_Id` INT(11) NULL DEFAULT NULL,
  `Article_Source_Pages` VARCHAR(255) NULL DEFAULT NULL,
  `Article_Source_Lang` VARCHAR(2) NULL DEFAULT 'en',
  `old_Id` INT(11) NULL DEFAULT NULL,
  `Article_Source_Note` TEXT NULL DEFAULT NULL,
  PRIMARY KEY (`Article_Source_Id`),
  INDEX `articale_FK_idx` (`Article_Id` ASC),
  INDEX `Source_FK_idx` (`Source_Id` ASC),
  INDEX `Matrial_type_FK_idx` (`Material_Type_Id` ASC),
  CONSTRAINT `Matrial_type_FK`
    FOREIGN KEY (`Material_Type_Id`)
    REFERENCES `tblmaterial_type` (`Material_Type_Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `Source_FK`
    FOREIGN KEY (`Source_Id`)
    REFERENCES `tblsource` (`Source_Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `articale_FK`
    FOREIGN KEY (`Article_Id`)
    REFERENCES `tblarticle` (`Article_Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;",
		),
		'tblkeywords'                => array(
			'query' => "CREATE TABLE IF NOT EXISTS `tblkeywords` (
  `Keywords_Id` INT(11) NOT NULL AUTO_INCREMENT,
  `Keywords_Keyword` VARCHAR(255) NULL DEFAULT NULL,
  `Keywords_Type` VARCHAR(1) NULL DEFAULT NULL,
  PRIMARY KEY (`Keywords_Id`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;",
		),
		'tblarticle_source_keywords' => array(
			'query' => "CREATE TABLE IF NOT EXISTS `tblarticle_source_keywords` (
  `Article_Source_Keyword_Id` INT(11) NOT NULL AUTO_INCREMENT,
  `Article_Source_Id` INT(11) NULL DEFAULT NULL,
  `Keywords_Id` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`Article_Source_Keyword_Id`),
  INDEX `articale_source_fk_idx` (`Article_Source_Id` ASC),
  INDEX `keywords_fk_idx` (`Keywords_Id` ASC),
  CONSTRAINT `articale_source_fk`
    FOREIGN KEY (`Article_Source_Id`)
    REFERENCES `tblarticle_source` (`Article_Source_Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `keywords_fk`
    FOREIGN KEY (`Keywords_Id`)
    REFERENCES `tblkeywords` (`Keywords_Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;",
		),
	);
}