

## USERS TABLE

CREATE TABLE `minuteco_devportal`.`users` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `uid` INT NOT NULL COMMENT 'GLOBAL USER ID -- Spire ID' , 
    `username` VARCHAR(128) NOT NULL COMMENT 'First part of spire email' , 
    `creation_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    `password` VARCHAR(128) NOT NULL , 
    `password_last_change` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    `deleted` BOOLEAN NOT NULL DEFAULT FALSE , 
    `locked` BOOLEAN NOT NULL DEFAULT FALSE , 
    `change_password` BOOLEAN NOT NULL DEFAULT FALSE , 
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
    `usage_ref` VARCHAR(256) NOT NULL , 
    `values_ref` VARCHAR(256) NOT NULL COMMENT '0 - Global override, uid - specific user (7 digit), gid - specific group (5 digit)' , 
    PRIMARY KEY (`id`)
) ENGINE = MyISAM;

