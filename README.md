# user_stories


**Fields Table**

``CREATE  TABLE IF NOT EXISTS `Fields` (
`id` INT  AUTO_INCREMENT ,
`name` VARCHAR(255),
PRIMARY KEY (`id`) );``

**Users table**
``CREATE  TABLE IF NOT EXISTS `Users` (
`id` INT  AUTO_INCREMENT ,
`name` VARCHAR(255) NOT NULL ,
`surname` VARCHAR(255) NOT NULL ,
`email` VARCHAR(255) NOT NULL UNIQUE,
`password` VARCHAR(255) NOT NULL,
`type` enum('mentor','mentee') NOT NULL,
`position` VARCHAR(255),
`field_id` INT NOT NULL,
`description` VARCHAR(255),
`education` VARCHAR(255),
`experience` VARCHAR(255),
`about` VARCHAR(255),
`about` VARCHAR(255),
`registered_at` DATETIME DEFAULT CURRENT_TIMESTAMP  NOT NULL,
PRIMARY KEY (`id`),
FOREIGN KEY (`field_id`) REFERENCES Fields(`id`)
);``