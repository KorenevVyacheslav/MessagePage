CREATE TABLE `messeges`
(
    `id`     int unsigned NOT NULL AUTO_INCREMENT,
    `title`  varchar(25) COLLATE utf8mb4_unicode_520_ci NOT NULL,
    `author` varchar(25) COLLATE utf8mb4_unicode_520_ci NOT NULL,
    `brief`  varchar(40) COLLATE utf8mb4_unicode_520_ci NOT NULL,
    `text_`  text COLLATE utf8mb4_unicode_520_ci        NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

INSERT INTO messeges (title, author, brief, text_)
VALUES ('Lorem 1 par', 'Иванов', 'Lorem ipsum odor amet', 'Lorem ipsum odor amet, consectetuer adipiscing elit. Massa habitasse fusce phasellus placerat turpis blandit ultrices.
Natoque viverra dolor ipsum venenatis eget aliquam donec etiam. Dolor id mauris morbi porttitor porttitor erat id.
Inceptos tristique phasellus volutpat risus lobortis pharetra. Odio accumsan ante imperdiet platea mollis maximus aptent.
Magnis consectetur mauris habitasse ornare; condimentum pretium potenti. Integer taciti curae hendrerit rhoncus tellus.');
INSERT INTO messeges (title, author, brief, text_)
VALUES ('Lorem 2 par', 'Петров', 'Donec congue lectus', 'Donec congue lectus accumsan malesuada
netus ante elementum eu habitant. Interdum malesuada porta dolor semper felis vitae dapibus fringilla. Suspendisse quam torquent potenti blandit,
proin nibh mi parturient aliquet. Cubilia eros tincidunt duis proin nostra tellus urna justo. Maximus platea est interdum;
dictum elit dictum sed viverra nisl.
Ultricies litora scelerisque curae maximus pretium nisi non. Id risus eros rutrum dictum elit nulla quisque nam ullamcorper.');
INSERT INTO messeges (title, author, brief, text_)
VALUES ('Lorem 3 par', 'Сидоров', 'Rutrum fermentum egestas', 'Rutrum fermentum egestas interdum
vulputate, mi diam. Viverra aptent dictumst phasellus tortor finibus pellentesque; odio enim. Fringilla volutpat consequat amet
vestibulum ullamcorper consequat placerat magna. Hac consectetur nisi eget sagittis platea; aliquet malesuada finibus.
Nisi erat pulvinar sodales pellentesque quisque sit viverra. Euismod orci ultricies felis vitae ornare.
Phasellus neque litora luctus viverra aptent sagittis feugiat magnis auctor! Posuere condimentum blandit risus nascetur maecenas.
Luctus curae quam risus blandit eros metus et himenaeos.
');
INSERT INTO messeges (title, author, brief, text_)
VALUES ('Lorem 4 par', 'Иванов', 'Adipiscing purus finibus', 'Adipiscing purus finibus natoque quis ultricies ullamcorper. Eros mus commodo sodales nisi nascetur vitae vitae rutrum.
Metus platea nibh porta litora, tristique efficitur felis. Venenatis fusce massa fringilla urna primis non volutpat accumsan.
');
INSERT INTO messeges (title, author, brief, text_)
VALUES ('Lorem 5 par', 'Петров', 'Nascetur donec diam mattis', 'Nascetur donec diam mattis molestie fames. Velit dui nullam lacinia parturient porta sed aenean. Habitant curabitur rutrum dui est leo parturient semper leo urna.
Ridiculus felis in at per faucibus nisi eleifend sodales.
');
INSERT INTO messeges (title, author, brief, text_)
VALUES ('Lorem 6 par', 'Иванов', 'Lorem ipsum odor amet', 'Lorem ipsum odor amet, consectetuer adipiscing elit. Massa habitasse fusce phasellus placerat turpis blandit ultrices.
Natoque viverra dolor ipsum venenatis eget aliquam donec etiam. Dolor id mauris morbi porttitor porttitor erat id.
Inceptos tristique phasellus volutpat risus lobortis pharetra. Odio accumsan ante imperdiet platea mollis maximus aptent.
Magnis consectetur mauris habitasse ornare; condimentum pretium potenti. Integer taciti curae hendrerit rhoncus tellus.');
INSERT INTO messeges (title, author, brief, text_)
VALUES ('Lorem 7 par', 'Петров', 'Donec congue lectus', 'Donec congue lectus accumsan malesuada
netus ante elementum eu habitant. Interdum malesuada porta dolor semper felis vitae dapibus fringilla. Suspendisse quam torquent potenti blandit,
proin nibh mi parturient aliquet. Cubilia eros tincidunt duis proin nostra tellus urna justo. Maximus platea est interdum;
dictum elit dictum sed viverra nisl.
Ultricies litora scelerisque curae maximus pretium nisi non. Id risus eros rutrum dictum elit nulla quisque nam ullamcorper.');
INSERT INTO messeges (title, author, brief, text_)
VALUES ('Lorem 8 par', 'Сидоров', 'Rutrum fermentum egestas', 'Rutrum fermentum egestas interdum
vulputate, mi diam. Viverra aptent dictumst phasellus tortor finibus pellentesque; odio enim. Fringilla volutpat consequat amet
vestibulum ullamcorper consequat placerat magna. Hac consectetur nisi eget sagittis platea; aliquet malesuada finibus.
Nisi erat pulvinar sodales pellentesque quisque sit viverra. Euismod orci ultricies felis vitae ornare.
Phasellus neque litora luctus viverra aptent sagittis feugiat magnis auctor! Posuere condimentum blandit risus nascetur maecenas.
Luctus curae quam risus blandit eros metus et himenaeos.
');
INSERT INTO messeges (title, author, brief, text_)
VALUES ('Lorem 9 par', 'Иванов', 'Adipiscing purus finibus', 'Adipiscing purus finibus natoque quis ultricies ullamcorper. Eros mus commodo sodales nisi nascetur vitae vitae rutrum.
Metus platea nibh porta litora, tristique efficitur felis. Venenatis fusce massa fringilla urna primis non volutpat accumsan.
');
INSERT INTO messeges (title, author, brief, text_)
VALUES ('Lorem 10 par', 'Петров', 'Nascetur donec diam mattis', 'Nascetur donec diam mattis molestie fames. Velit dui nullam lacinia parturient porta sed aenean. Habitant curabitur rutrum dui est leo parturient semper leo urna.
Ridiculus felis in at per faucibus nisi eleifend sodales.
');

CREATE TABLE `comments`
(
    `id`    int unsigned NOT NULL AUTO_INCREMENT,
    `text_` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

INSERT INTO `comments` (text_)
VALUES ('comment 1');
INSERT INTO `comments` (text_)
VALUES ('comment 2');
INSERT INTO `comments` (text_)
VALUES ('comment 3');
INSERT INTO `comments` (text_)
VALUES ('comment 4');
INSERT INTO `comments` (text_)
VALUES ('comment 5');
INSERT INTO `comments` (text_)
VALUES ('comment 6');
INSERT INTO `comments` (text_)
VALUES ('comment 7');

CREATE TABLE `pivot`
(
    `id`         int unsigned NOT NULL AUTO_INCREMENT,
    `messege_id` int unsigned NOT NULL,
    `comment_id` int unsigned NOT NULL UNIQUE,
    PRIMARY KEY (`id`),
    CONSTRAINT messege_fk FOREIGN KEY (messege_id) REFERENCES messeges (id),
    CONSTRAINT comment_fk FOREIGN KEY (comment_id) REFERENCES comments (id)
) ENGINE=InnoDB AUTO_INCREMENT=1;

INSERT INTO `pivot` (messege_id, comment_id)
VALUES (1, 1);
INSERT INTO `pivot` (messege_id, comment_id)
VALUES (1, 2);
INSERT INTO `pivot` (messege_id, comment_id)
VALUES (2, 3);
INSERT INTO `pivot` (messege_id, comment_id)
VALUES (3, 4);
INSERT INTO `pivot` (messege_id, comment_id)
VALUES (4, 5);
INSERT INTO `pivot` (messege_id, comment_id)
VALUES (5, 6);

