CREATE TABLE `user` (
  `user_id` INT PRIMARY KEY AUTO_INCREMENT,
  `user_name` VARCHAR(50) NOT NULL,
  `user_password` VARCHAR(20) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `dob` DATE
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



-- data insertion 
-- Inserting data into the 'user' table
INSERT INTO `user` (`user_name`, `user_password`, `email`, `dob`)
VALUES
  ('john_doe', 'password123', 'john@example.com', '1990-05-15'),
  ('jane_smith', 'securepass', 'jane@example.com', '1985-10-20'),
  ('user3', 'mypassword', 'user3@example.com', '1998-02-28');

-- Inserting data into the 'tag' table
INSERT INTO `tag` (`name`)
VALUES
  ('Technology'),
  ('Science'),
  ('Art'),
  ('Travel');

-- Inserting data into the 'user_tag' table
-- not inserting in user_tag

-- Inserting data into the 'admin' table
INSERT INTO `admin` (`admin_username`, `admin_password`)
VALUES
  ('admin1', 'adminpass123'),
  ('admin2', 'adminsecure');

-- Inserting data into the 'content' table
INSERT INTO `content` (`title`, `author`, `content_date`, `sub_title`, `body`)
VALUES
  ('Introduction to SQL', 'John Doe', '2023-08-01', 'Getting Started', 'This is a brief introduction to SQL...'),
  ('The Science of Stars', 'Jane Smith', '2023-07-15', 'Stellar Phenomena', 'Stars are massive celestial objects...'),
  ('Art Techniques', 'Artist123', '2023-08-10', 'Painting Basics', 'Learn the basics of mixing colors and brush techniques...');

-- Inserting data into the 'content_tag' table
INSERT INTO `content_tag` (`content_id`, `tag_id`)
VALUES
  (1, 1),
  (2, 2),
  (3, 3),
  (3, 4);

-- Inserting data into the 'comments' table
INSERT INTO `comments` (`content_id`, `user_id`, `comment_text`, `comment_date`)
VALUES
  (1, 1, 'Great article!', '2023-08-02 10:30:00'),
  (1, 2, 'I found this very helpful.', '2023-08-02 12:45:00'),
  (2, 3, 'I never knew stars had so much to offer.', '2023-07-15 14:20:00');
