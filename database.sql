CREATE TABLE `user` (
  `user_id` INT PRIMARY KEY AUTO_INCREMENT,
  `user_name` VARCHAR(50) NOT NULL,
  `user_password` VARCHAR(20) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `dob` DATE,
  `age` INT DEFAULT 0,
  `ageRestriction` INT DEFAULT 1,
  `country` VARCHAR(20)
);

CREATE TABLE `tag` (
  `tag_id` INT PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL,
  popularity_points INT DEFAULT 0
);

CREATE TABLE `user_tag` (
  `user_id` INT,
  `tag_id` INT,
  `tag_priority` INT DEFAULT 0,
  PRIMARY KEY (`user_id`, `tag_id`)
);


CREATE TABLE `admin` (
  `admin_id` INT PRIMARY KEY AUTO_INCREMENT,
  `admin_username` VARCHAR(20),
  `admin_password` VARCHAR(20),
  `admin_password` VARCHAR(20),
  `admin_email` VARCHAR(100)
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

CREATE TABLE `content_rating` (
  `rating_id` INT PRIMARY KEY AUTO_INCREMENT,
  `content_id` INT,
  `AverageRating` FLOAT(10),
  `rating_date` TIMESTAMP,
  FOREIGN KEY (`content_id`) REFERENCES `content` (`content_id`)
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


-- insert data

INSERT INTO `user` (`user_name`, `user_password`, `email`, `dob`, `age`, `ageRestriction`, `country`) VALUES
('JohnDoe', 'password123', 'john.doe@example.com', '1990-05-15', 31, 1, 'USA'),
('AliceSmith', 'secret456', 'alice.smith@example.com', '1985-08-20', 36, 0, 'Canada'),
('BobJohnson', 'p@ssw0rd', 'bob.johnson@example.com', '2000-02-10', 21, 1, 'UK');


INSERT INTO `tag` (`name`, `popularity_points`) VALUES
('Technology', 100),
('Travel', 75),
('Food', 50);


INSERT INTO `user_tag` (`user_id`, `tag_id`, `tag_priority`) VALUES
(1, 1, 2),
(1, 2, 1),
(2, 2, 3),
(3, 3, 1);


INSERT INTO `admin` (`admin_username`, `admin_password`, `admin_email`) VALUES
('admin1', 'adminpass1', 'admin1@example.com'),
('admin2', 'adminpass2', 'admin2@example.com');

INSERT INTO `content` (`title`, `author`, `content_date`, `sub_title`, `body`) VALUES
('Introduction to SQL', 'John Doe', '2023-01-15', 'SQL Basics', 'This is an introductory article about SQL...'),
('Travel Tips', 'Alice Smith', '2023-03-20', 'Exploring New Places', 'Learn how to make the most of your travel experience...'),
('Delicious Recipes', 'Bob Johnson', '2023-02-10', 'Cooking Made Easy', 'Discover some mouthwatering recipes for food lovers...');

INSERT INTO `content_tag` (`content_id`, `tag_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(3, 1);

INSERT INTO `content_rating` (`content_id`, `AverageRating`, `rating_date`) VALUES
(1, 4.5, '2023-01-16 09:30:00'),
(2, 5.0, '2023-03-21 14:15:00'),
(3, 4.2, '2023-02-11 18:45:00');

INSERT INTO `comments` (`content_id`, `user_id`, `comment_text`, `comment_date`) VALUES
(1, 1, 'Great article!', '2023-01-17 10:12:00'),
(1, 2, 'I found it very helpful.', '2023-01-18 11:24:00'),
(2, 3, 'Thanks for the tips!', '2023-03-22 15:30:00');


