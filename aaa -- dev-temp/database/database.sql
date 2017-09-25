

## USERS TABLE

CREATE TABLE `minuteco_devportal`.`users` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `uid` INT NOT NULL COMMENT 'GLOBAL USER ID -- Spire ID' , 
    `username` VARCHAR(128) NOT NULL COMMENT 'First part of spire email' , 
    `creation_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    `password` VARCHAR(128) NOT NULL , 
    `password_last_change` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    `password_attempts` INT NULL DEFAULT '0' ,
    `locked` BOOLEAN NOT NULL DEFAULT FALSE ,
    `deleted` BOOLEAN NOT NULL DEFAULT FALSE ,
    `login_msg` TEXT NULL DEFAULT NULL ,
    PRIMARY KEY (`id`)
) ENGINE = MyISAM;


##  USER_PRIVILEGES TABLE

CREATE TABLE `minuteco_devportal`.`user_privileges` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `uid` INT NOT NULL COMMENT 'GLOBAL USER ID' , 
    `key_id` INT NOT NULL COMMENT 'refrence key id from keys table', 
    `key_value` INT NULL DEFAULT NULL,
    `src` VARCHAR(128) NOT NULL COMMENT 'Where this key came from' , 
    `creation` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, 
    `last_used` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, 
    PRIMARY KEY (`id`)
) ENGINE = MyISAM;

## PRIVILEGE_KEYS TABLE

CREATE TABLE `minuteco_devportal`.`privilege_keys` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `cat` VARCHAR(64) NOT NULL , 
    `key_char` VARCHAR(64) NOT NULL , 
    `key_type` ENUM('TF','UID','TID', 'PID') NOT NULL ,
    `usage_ref` VARCHAR(256) NOT NULL , 
    `values_ref` VARCHAR(256) NOT NULL COMMENT '0 - Global override, uid - specific user (7 digit), gid - specific group (5 digit)' , 
    PRIMARY KEY (`id`)
) ENGINE = MyISAM;

## USER_INFO TABLE

CREATE TABLE `minuteco_devportal`.`user_info` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `uid` INT NOT NULL COMMENT 'GLOBAL USER ID' , 
    `fname` VARCHAR(30) NULL DEFAULT NULL COMMENT 'First Name' , 
    `lname` VARCHAR(30) NULL DEFAULT NULL COMMENT 'Last Name' , 
    `uemail` VARCHAR(30) NULL DEFAULT NULL COMMENT 'Umass Email' , 
    `pemail` VARCHAR(30) NULL DEFAULT NULL COMMENT 'Personal Email' , 
    `tel` VARCHAR(12) NULL DEFAULT NULL COMMENT 'Phone Number' , 
    `yog` YEAR NULL DEFAULT NULL COMMENT 'Year of Graduation' , 
    `eyear` YEAR NULL DEFAULT NULL COMMENT 'Enrollment Year' , 
    `college` VARCHAR(30) NULL DEFAULT NULL COMMENT 'College (School)' , 
    `major` VARCHAR(30) NULL DEFAULT NULL COMMENT 'Major' , 
    `minor` VARCHAR(30) NULL DEFAULT NULL COMMENT 'Minor' , 
    `cert` VARCHAR(30) NULL DEFAULT NULL COMMENT 'Certificate' , 
    `type` ENUM('Member','Client','Bot') NULL DEFAULT NULL COMMENT 'User Type' , 
    `langs` MEDIUMTEXT NULL DEFAULT NULL ,
    `create_date` DATETIME NULL DEFAULT NULL COMMENT 'User Creation Date' , 
    `onboard_date` DATETIME NULL DEFAULT NULL COMMENT 'Date onboard completed' , 
    `rank` VARCHAR(30) NULL DEFAULT 'Member' ,
    `onboard_stage` INT NOT NULL DEFAULT '0' ,
    `email_code` VARCHAR(12) NULL DEFAULT NULL ,
    `cid` INT NULL DEFAULT NULL COMMENT 'client id' ,
    PRIMARY KEY (`id`)
) ENGINE = MyISAM;

## AUTH_KEYS TABLE

CREATE TABLE `minuteco_devportal`.`auth_keys` (
    `id` INT NOT NULL AUTO_INCREMENT , 
    `uid` INT NULL DEFAULT NULL , 
    `auth_key` VARCHAR(100) NULL DEFAULT NULL , 
    `key_creation` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    `key_expiration` TIMESTAMP NULL DEFAULT NULL , 
    `ip` VARCHAR(15) NULL DEFAULT NULL , 
    PRIMARY KEY (`id`)
) ENGINE = MyISAM;

## PROJECTS TABLE

CREATE TABLE `minuteco_devportal`.`projects` ( 
    `pid` INT(9) NULL AUTO_INCREMENT , 
    `project_name` VARCHAR(30) NOT NULL ,
    `cid` INT(9) NULL DEFAULT NULL , 
    `project_lead` INT NULL DEFAULT NULL COMMENT 'uid' ,
    `creation_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    `active` BOOLEAN NOT NULL DEFAULT FALSE , 
    `stage` ENUM('Devising','In Progress','Final Development','QC - Team','QC - Project Lead','QC - Technical VP','Published w/ Support','Published wo/ Support','Published Support Expired','Canceled','Under Review','Deleted ') NOT NULL DEFAULT 'Devising' ,
    `github` VARCHAR(50) NULL DEFAULT NULL , 
    `trello` VARCHAR(50) NULL DEFAULT NULL , 
    `todo` INT NULL DEFAULT NULL COMMENT 'todo list id' ,
    PRIMARY KEY (`pid`)
) ENGINE = MyISAM;

## TEAMS TABLE

CREATE TABLE `minuteco_devportal`.`teams` ( 
    `tid` INT NOT NULL AUTO_INCREMENT , 
    `team_name` VARCHAR(30) NOT NULL , 
    `team_lead` INT NOT NULL COMMENT '\"admin\" for internal teams' , 
    `creation_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    `active` BOOLEAN NOT NULL DEFAULT TRUE ,
    PRIMARY KEY (`tid`)
) ENGINE = MyISAM;

## CLIENTS TABLE

CREATE TABLE `minuteco_devportal`.`clients` ( 
    `cid` INT(5) NOT NULL COMMENT '5 digit number' , 
    `name` VARCHAR(40) NULL DEFAULT NULL , 
    `address` TEXT NULL DEFAULT NULL , 
    `primary_contact` INT NULL DEFAULT NULL COMMENT 'uid' , 
    `state` ENUM('Contacted ','Prospective','Scheduled','In Progress','Published w/ Support','Published wo/ Support','Canceled ','Re-Applying ','Declined') NOT NULL DEFAULT 'Contacted' ,
    PRIMARY KEY (`cid`)
) ENGINE = MyISAM;

## TEAM ASSIGNMENTS TABLE
CREATE TABLE `minuteco_devportal`.`team_assignments` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `uid` INT NOT NULL , 
    `tid` INT NOT NULL , 
    `src` VARCHAR(30) NULL DEFAULT NULL , 
    PRIMARY KEY (`id`)
) ENGINE = MyISAM;