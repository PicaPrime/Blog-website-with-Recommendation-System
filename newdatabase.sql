
CREATE TABLE `user` (
    `user_id` INT AUTO_INCREMENT NULL ,
    `user_name` VARCHAR(50)  NOT NULL ,
    `user_password` VARCHAR(20)  NOT NULL ,
    `email` VARCHAR(100)  NOT NULL ,
    `dob` DATE  NULL 
);

CREATE TABLE `tag` (
    `tag_id` INT AUTO_INCREMENT NULL ,
    `name` VARCHAR(50)  NOT NULL ,
    `popularity_points` INT  NULL 
);

CREATE TABLE `user_tag` (
    `user_id` INT  NULL ,
    `tag_id` INT  NULL ,
    `tag_priority` INT  NULL ,
    PRIMARY KEY (
        `user_id`,`tag_id`
    )
);

CREATE TABLE `admin` (
    `admin_id` INT AUTO_INCREMENT NULL ,
    `admin_username` VARCHAR(20)  NULL ,
    `admin_password` VARCHAR(20)  NULL 
);

CREATE TABLE `content` (
    `content_id` INT AUTO_INCREMENT NULL ,
    `title` VARCHAR(100)  NOT NULL ,
    `author` VARCHAR(50)  NOT NULL ,
    `content_date` DATE  NULL ,
    `sub_title` VARCHAR(50)  NULL ,
    `body` TEXT  NOT NULL 
);

CREATE TABLE `content_tag` (
    `content_id` INT  NULL ,
    `tag_id` INT  NULL ,
    PRIMARY KEY (
        `content_id`,`tag_id`
    )
);

CREATE TABLE `comments` (
    `comment_id` INT AUTO_INCREMENT NULL ,
    `content_id` INT  NULL ,
    `user_id` INT  NULL ,
    `comment_text` TEXT  NOT NULL ,
    `comment_date` TIMESTAMP  NULL 
);

ALTER TABLE `user_tag` ADD CONSTRAINT `fk_user_tag_user_id` FOREIGN KEY(`user_id`)
REFERENCES `user` (`user_id`);

ALTER TABLE `user_tag` ADD CONSTRAINT `fk_user_tag_tag_id` FOREIGN KEY(`tag_id`)
REFERENCES `tag` (`tag_id`);

ALTER TABLE `content_tag` ADD CONSTRAINT `fk_content_tag_content_id` FOREIGN KEY(`content_id`)
REFERENCES `content` (`content_id`);

ALTER TABLE `content_tag` ADD CONSTRAINT `fk_content_tag_tag_id` FOREIGN KEY(`tag_id`)
REFERENCES `tag` (`tag_id`);

ALTER TABLE `comments` ADD CONSTRAINT `fk_comments_content_id` FOREIGN KEY(`content_id`)
REFERENCES `content` (`content_id`);

ALTER TABLE `comments` ADD CONSTRAINT `fk_comments_user_id` FOREIGN KEY(`user_id`)
REFERENCES `user` (`user_id`);



-- insertions 
-- Insert sample users
INSERT INTO `user` (`user_name`, `user_password`, `email`, `dob`) VALUES
    ('john_doe', 'password123', 'john@example.com', '1990-05-15'),
    ('jane_smith', 'securepass', 'jane@example.com', '1988-10-20'),
    ('bob_johnson', '123456', 'bob@example.com', '1995-03-12');

-- Insert sample tags
INSERT INTO `tag` (`name`, `popularity_points`) VALUES
    ('Technology', 100),
    ('Science', 75),
    ('Art', 50),
    ('Sports', 60);

-- Insert user-tag relationships
INSERT INTO `user_tag` (`user_id`, `tag_id`, `tag_priority`) VALUES
    (1, 1, 1),
    (1, 2, 2),
    (2, 2, 1),
    (2, 3, 2),
    (3, 1, 1),
    (3, 4, 2);

-- Insert sample admin
INSERT INTO `admin` (`admin_username`, `admin_password`) VALUES
    ('admin1', 'adminpass'),
    ('admin2', 'admin123');

-- Insert sample content
INSERT INTO `content` (`title`, `author`, `content_date`, `sub_title`, `body`) VALUES
    ('Introduction to AI', 'John Doe', '2023-08-15', 'AI Basics', 'Artificial intelligence is...'),
    ('The Science of Stars', 'Jane Smith', '2023-08-10', 'Stellar Phenomena', 'Stars are luminous celestial...'),
    ('Mastering the Guitar', 'Bob Johnson', '2023-08-18', 'Music Skills', 'Learning to play the guitar...');

-- Insert content-tag relationships
INSERT INTO `content_tag` (`content_id`, `tag_id`) VALUES
    (1, 1),
    (2, 2),
    (3, 3);

-- Insert sample comments
INSERT INTO `comments` (`content_id`, `user_id`, `comment_text`, `comment_date`) VALUES
    (1, 1, 'Great article!', '2023-08-16 10:30:00'),
    (2, 2, 'I love studying stars!', '2023-08-12 14:15:00'),
    (3, 3, 'Awesome guitar tips!', '2023-08-19 18:45:00');
