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
    `admin_email` VARCHAR(100)
  );

  CREATE TABLE `content` (
    `content_id` INT PRIMARY KEY AUTO_INCREMENT,
    `title` VARCHAR(100) NOT NULL,
    `author` VARCHAR(50) NOT NULL,
    `content_date` DATE,
    `sub_title` VARCHAR(50),
    `adult_tag` INT DEFAULT 0,
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

-- Dummy data for `user` table
INSERT INTO `user` (`user_name`, `user_password`, `email`, `dob`, `age`, `ageRestriction`, `country`)
VALUES
    ('user1', 'password1', 'user1@example.com', '1990-01-15', 32, 1, 'USA'),
    ('user2', 'password2', 'user2@example.com', '1985-05-20', 37, 0, 'Canada'),
    ('user3', 'password3', 'user3@example.com', '2000-09-10', 23, 1, 'UK');

-- Dummy data for `tag` table
INSERT INTO `tag` (`name`, `popularity_points`)
VALUES
    ('Tag1', 10),
    ('Tag2', 5),
    ('Tag3', 8);

-- Dummy data for `user_tag` table
INSERT INTO `user_tag` (`user_id`, `tag_id`, `tag_priority`)
VALUES
    (1, 1, 2),
    (1, 2, 1),
    (2, 2, 3),
    (3, 1, 1);

-- Dummy data for `admin` table
INSERT INTO `admin` (`admin_username`, `admin_password`, `admin_email`)
VALUES
    ('admin1', 'adminpass1', 'admin1@example.com'),
    ('admin2', 'adminpass2', 'admin2@example.com');

-- Dummy data for `content` table
INSERT INTO `content` (`title`, `author`, `content_date`, `sub_title`, `adult_tag`, `body`)
VALUES
    ('Article 1', 'Author 1', '2023-08-15', 'Subtitle 1', 0, 'This is the body of Article 1.'),
    ('Article 2', 'Author 2', '2023-08-20', 'Subtitle 2', 1, 'This is the body of Article 2.'),
    ('Article 3', 'Author 3', '2023-08-25', 'Subtitle 3', 0, 'This is the body of Article 3.');

-- Dummy data for `content_tag` table
INSERT INTO `content_tag` (`content_id`, `tag_id`)
VALUES
    (1, 1),
    (1, 2),
    (2, 2),
    (3, 1);

-- Dummy data for `content_rating` table
INSERT INTO `content_rating` (`content_id`, `AverageRating`, `rating_date`)
VALUES
    (1, 4.5, '2023-08-16 12:30:00'),
    (2, 3.2, '2023-08-21 14:45:00'),
    (3, 4.8, '2023-08-26 10:15:00');

-- Dummy data for `comments` table
INSERT INTO `comments` (`content_id`, `user_id`, `comment_text`, `comment_date`)
VALUES
    (1, 1, 'Great article!', '2023-08-16 13:00:00'),
    (1, 2, 'I enjoyed reading this.', '2023-08-16 13:15:00'),
    (2, 3, 'Not my cup of tea.', '2023-08-21 15:00:00');
