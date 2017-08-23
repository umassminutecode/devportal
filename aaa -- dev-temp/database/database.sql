

## USERS TABLE

CREATE TABLE `minuteco_devportal`.`users` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `uid` INT NOT NULL COMMENT 'GLOBAL USER ID -- Spire ID' , 
    `username` VARCHAR(128) NOT NULL COMMENT 'First part of spire email' , 
    `creation_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    `password` VARCHAR(128) NOT NULL , 
    `password_last_change` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , 
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
    `key_type` ENUM('TF','UID','GID') NOT NULL ,
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
    `type` ENUM('member','client','bot') NULL DEFAULT NULL COMMENT 'User Type' , 
    `create_date` DATETIME NULL DEFAULT NULL COMMENT 'User Creation Date' , 
    `onboard_date` DATETIME NULL DEFAULT NULL COMMENT 'Date onboard completed' , 
    PRIMARY KEY (`id`)
) ENGINE = MyISAM;
