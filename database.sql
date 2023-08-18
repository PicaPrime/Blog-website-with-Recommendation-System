CREATE TABLE `user` (
  `user_id` INT PRIMARY KEY AUTO_INCREMENT,
  `user_name` VARCHAR(50) NOT NULL,
  `user_password` VARCHAR(20) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `dob` DATE
);

CREATE TABLE `tag` (
  `tag_id` INT PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL
);

CREATE TABLE `user_tag` (
  `user_id` INT,
  `tag_id` INT,
  PRIMARY KEY (`user_id`, `tag_id`)
);

CREATE TABLE `admin` (
  `admin_id` INT PRIMARY KEY AUTO_INCREMENT,
  `admin_username` VARCHAR(20),
  `admin_password` VARCHAR(20)
);

CREATE TABLE `content` (
  `content_id` INT PRIMARY KEY AUTO_INCREMENT,
  `title` VARCHAR(100) NOT NULL,
  `author` VARCHAR(50) NOT NULL,
  `content_date` DATE,
  `sub_title` VARCHAR(50),
  `body` TEXT NOT NULL
);

CREATE TABLE `content_tag` (
  `content_id` INT,
  `tag_id` INT,
  PRIMARY KEY (`content_id`, `tag_id`)
);

CREATE TABLE `comments` (
  `comment_id` INT PRIMARY KEY AUTO_INCREMENT,
  `content_id` INT,
  `user_id` INT,
  `comment_text` TEXT NOT NULL,
  `comment_date` TIMESTAMP
);

ALTER TABLE `user_tag` ADD FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

ALTER TABLE `user_tag` ADD FOREIGN KEY (`tag_id`) REFERENCES `tag` (`tag_id`);

ALTER TABLE `content_tag` ADD FOREIGN KEY (`content_id`) REFERENCES `content` (`content_id`);

ALTER TABLE `content_tag` ADD FOREIGN KEY (`tag_id`) REFERENCES `tag` (`tag_id`);

ALTER TABLE `comments` ADD FOREIGN KEY (`content_id`) REFERENCES `content` (`content_id`);

ALTER TABLE `comments` ADD FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
