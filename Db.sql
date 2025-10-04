CREATE TABLE `User` (
	`user_id` INTEGER NOT NULL AUTO_INCREMENT UNIQUE,
	`user_email` TEXT(65535) NOT NULL,
	`user_name` TEXT(65535) NOT NULL,
	`user_password` TEXT(65535) NOT NULL,
	PRIMARY KEY(`user_id`)
) COMMENT='The table used to store user data
';


CREATE TABLE `Past orders` (
	`user_id` INTEGER NOT NULL AUTO_INCREMENT UNIQUE,
	`orders_json` JSON,
	PRIMARY KEY(`user_id`)
);


CREATE TABLE `Current order` (
	`order_id` INTEGER NOT NULL AUTO_INCREMENT UNIQUE,
	`user_id` INTEGER NOT NULL,
	`order` JSON NOT NULL,
	PRIMARY KEY(`user_id`)
);


CREATE TABLE `Booked lesson` (
	`user_id` INTEGER NOT NULL AUTO_INCREMENT UNIQUE,
	`lesson_id` INTEGER,
	`tutor_id` INTEGER NOT NULL,
	PRIMARY KEY(`user_id`, `tutor_id`)
);


CREATE TABLE `Staff accounts` (
	`staff_id` INTEGER NOT NULL AUTO_INCREMENT UNIQUE,
	`user` TEXT(65535),
	`password` TEXT(65535),
	PRIMARY KEY(`staff_id`)
);


ALTER TABLE `User`
ADD FOREIGN KEY(`user_id`) REFERENCES `Past orders`(`user_id`)
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE `User`
ADD FOREIGN KEY(`user_id`) REFERENCES `Current order`(`user_id`)
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE `Current order`
ADD FOREIGN KEY(`order`) REFERENCES `Past orders`(`orders_json`)
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE `User`
ADD FOREIGN KEY(`user_id`) REFERENCES `Booked lesson`(`user_id`)
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE `Staff accounts`
ADD FOREIGN KEY(`staff_id`) REFERENCES `Booked lesson`(`tutor_id`)
ON UPDATE NO ACTION ON DELETE NO ACTION;