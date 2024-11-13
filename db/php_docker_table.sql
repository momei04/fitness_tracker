-- Create Language Tables
ALTER DATABASE php_docker CHARACTER SET utf8 COLLATE utf8_unicode_ci;
SET character_set_client = utf8;

CREATE TABLE language_languages(
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL UNIQUE,
    img_path VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE language_strings(
    id INT NOT NULL AUTO_INCREMENT,
    language_key VARCHAR(255) NOT NULL UNIQUE,
    language_id INT NOT NULL,
    language_string VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
);

-- User Table
CREATE TABLE users(
    id INT NOT NULL AUTO_INCREMENT,
    user_name VARCHAR(255) NOT NULL UNIQUE,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    ort VARCHAR(255) ,
    street VARCHAR(255) ,
    plz VARCHAR(255),
    password VARCHAR(255) NOT NULL,
    language_id INT NOT NULL DEFAULT 1,
    PRIMARY KEY (id),
    FOREIGN KEY (language_id) REFERENCES language_languages(id)
);



-- muscle group
CREATE TABLE muscle_group(
    id INT NOT NULL AUTO_INCREMENT,
    muscle_name VARCHAR(255) NOT NULL,
    label_color VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
);

-- exercise Table
CREATE TABLE exercise(
    id INT NOT NULL AUTO_INCREMENT,
    exercise_name VARCHAR(255) NOT NULL UNIQUE,
    muscle_id INT NOT NULL DEFAULT 1,
    background_img VARCHAR(255) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (muscle_id) REFERENCES muscle_group(id)
);

-- workout
CREATE TABLE workout_type(
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE workout_cover_images(
    img_id INT NOT NULL AUTO_INCREMENT,
    path VARCHAR(255) NOT NULL,
    PRIMARY KEY (img_id)
);

CREATE TABLE workout(
    id INT NOT NULL AUTO_INCREMENT,
    workout_name VARCHAR(255) NOT NULL UNIQUE,
    workout_description TEXT NOT NULL,
    user_id INT NOT NULL,
    workout_type INT NOT NULL,
    cover_img_id INT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (workout_type) REFERENCES workout_type(id),
    FOREIGN KEY (cover_img_id) REFERENCES workout_cover_images(img_id)
);

CREATE TABLE workout_exercise(
    user_id INT NOT NULL,
    workout_id INT NOT NULL,
    exercise_id INT NOT NULL,
    sets INT NOT NULL DEFAULT 3,
    reps INT NOT NULL DEFAULT 10,
    weight DOUBLE NOT NULL,
    created_at DATETIME DEFAULT NOW(),
    updated_at DATETIME DEFAULT NOW(),
    PRIMARY KEY (user_id, workout_id, exercise_id, updated_at),
    FOREIGN KEY (exercise_id) REFERENCES exercise(id),
    FOREIGN KEY (workout_id) REFERENCES workout(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

ALTER TABLE `language_strings` DROP INDEX `language_key`, ADD UNIQUE `language_key` (`language_key`, `language_id`);



INSERT INTO `language_languages` (`id`, `name`, `img_path`)
VALUES (NULL, 'Deutsch', 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/ba/Flag_of_Germany.svg/2560px-Flag_of_Germany.svg.png'),
       (NULL, 'Englisch', 'https://cdn.britannica.com/44/344-050-94536674/Flag-England.jpg');

INSERT INTO `users` (`id`, `user_name`, `first_name`, `last_name`, `email`, `ort`, `street`, `plz`, `password`, `language_id`) VALUES
    (1, 'mmeier', 'Moritz', 'Meier', 'moritzmeiermac@gmail.com', 'Hirschau', 'Hauptstraße', '92242', '$2y$10$wKpdXftX98n6.93KjzmMCuV99./7AUNyZN/3F1lQC8CKXCKtw1ks.', 1);


INSERT INTO `language_strings`(`language_key`, `language_id`, `language_string`)
VALUES ('INVALID_EMAIL', 1,'Die angegebene Email Adresse ist ungültig');

INSERT INTO `language_strings`(`language_key`, `language_id`, `language_string`)
VALUES ('INVALID_EMAIL', 2,'The given email is not valid');

INSERT INTO `language_strings`(`language_key`, `language_id`, `language_string`)
VALUES ('PASSWORD_TOO_SHORT', 1,'Das Passwort ist zu kurz');

INSERT INTO `language_strings`(`language_key`, `language_id`, `language_string`)
VALUES ('PASSWORD_TOO_SHORT', 2,'The Password is too short');

INSERT INTO `language_strings`(`language_key`, `language_id`, `language_string`)
VALUES ('PASSWORD_NO_SPECIALCHARS_OR_CAPITAL_LETTER', 1,'Das angebene Passwort beinhaltet kein Sonderzeichen oder Großbuchstaben');

INSERT INTO `language_strings`(`language_key`, `language_id`, `language_string`)
VALUES ('PASSWORD_NO_SPECIALCHARS_OR_CAPITAL_LETTER', 2,'The given password does not have a special character or capitalized letter');

INSERT INTO `language_strings`(`language_key`, `language_id`, `language_string`)
VALUES ('LOGOUT_SUCCESS',1,'Erfolgreich ausgeloggt');

INSERT INTO `language_strings`(`language_key`, `language_id`, `language_string`)
VALUES ('LOGOUT_SUCCESS',2,'Logout sucessfull');

INSERT INTO `language_strings`(`language_key`, `language_id`, `language_string`)
VALUES ('GENERAL_ERROR',1,'Es ist ein Fehler aufgetreten'),
       ('GENERAL_ERROR',2,'An error occured');

INSERT INTO language_strings(language_key, language_string, language_id)
VALUES('EXERCISES', 'Übungen', 1), ('EXERCISES', 'Exercises', 2),
      ('STATISTICS', 'Statistiken', 1), ('STATISTICS', 'Statistics', 2),
      ('WORKOUTS', 'Workouts', 1), ('WORKOUTS', 'Workouts', 2),
      ('SETTINGS', 'Einstellungen', 1), ('SETTINGS', 'Settings', 2);

INSERT INTO workout_cover_images(path)
VALUES('https://fitnessgym-group.de/wp-content/uploads/2021/11/fitness-gym-freihantel.jpg'),
      ('https://i.ytimg.com/vi/uDPPcjWlzyw/maxresdefault.jpg');

INSERT INTO workout_type(name)
VALUES('Fußball Training'),
      ('Kraft Training'),
      ('Cardio Training');


INSERT INTO muscle_group(muscle_name, label_color)
VALUES('Brust', '#004b23'),('Bauch', '#006400'),('Trizeps', '#007200'),('Bizeps', '#008000'),('Schultern', '#38b000'),('Rücken', '#70e000'),('Po', '#9ef01a'),('Nacken', '#ccff33');

INSERT INTO exercise(exercise_name, muscle_id, background_img)
VALUES
    ('Bench Press', 1, 'https://modusx.de/wp-content/uploads/bankdruecken-langhantel.jpg'),
    ('Situps', 2, 'https://www.fitnessfirst.de/sites/g/files/tbchtk381/files/2022-03/Sit-ups_vs_Crunches_Header.jpg'),
    ('Dips', 1, 'https://www.pullup-dip.de/cdn/shop/articles/straight-bar-dips-parallettes_600x600_a6d0362a-f0c8-49f1-98ea-a445011132e4.jpg?v=1690960849'),
    ('Shoulder Shrugs', 8, 'https://kinxlearning.com/cdn/shop/files/exercise-40_1000x.jpg?v=1613157925'),
    ('Inclined Bench Press', 1, 'https://kinxlearning.com/cdn/shop/files/exercise-40_1000x.jpg?v=1613157925'),
    ('Leg Press', 8, 'https://kinxlearning.com/cdn/shop/files/exercise-40_1000x.jpg?v=1613157925'),
    ('Push ups', 1, 'https://kinxlearning.com/cdn/shop/files/exercise-40_1000x.jpg?v=1613157925'),
    ('Lastzug', 6, 'https://www.uebungen.ws/wp-content/uploads/2011/07/latzug-1.jpg');

INSERT INTO language_strings(language_key, language_string, language_id)
VALUES ('DESCRIPTION', 'Beschreibung', 1),
       ('DESCRIPTION', 'Description', 2),
       ('SETS', 'Sätze', 1),
       ('REPS', 'Wiederholungen', 1),
       ('WEIGHT', 'Gewicht', 1),
       ('SETS', 'Sets', 2),
       ('REPS', 'Reps', 2),
       ('WEIGHT', 'Weight', 2),
       ('EDIT', 'Bearbeiten', 1),
       ('EDIT', 'Edit', 2),
       ('DELETE', 'Löschen', 1),
       ('DELETE', 'Delete', 2),
       ('WEIGHT_PROGRESSION', 'Gewichtsverlauf', 1),
       ('WEIGHT_PROGRESSION', 'Weight Progreesion', 2),
       ('EXERCISE', 'Übung', 1),
       ('EXERCISE', 'Exercise', 2);