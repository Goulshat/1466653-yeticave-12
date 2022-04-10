/* ----- Добавляю значения в таблицу "Категории" ----- */
INSERT INTO category (name, title) VALUES ('boards', 'Доски и лыжи');
INSERT INTO category (name, title) VALUES ('attachment', 'Крепления');
INSERT INTO category (name, title) VALUES ('boots', 'Ботинки');
INSERT INTO category (name, title) VALUES ('clothing', 'Одежда');
INSERT INTO category (name, title) VALUES ('tools', 'Инструменты');
INSERT INTO category (name, title) VALUES ('other', 'Разное');

/* ----- Добавляю значения в таблицу "Пользователи" ----- */
INSERT INTO users (email, password, name, contacts, date_register) VALUES ('goulshat@yandex.ru', '12345!Qw', 'Гульшат', '89171234578', '2021-11-01');
INSERT INTO users (email, password, name, contacts, date_register) VALUES ('some-email@yandex.ru', '1234!!Qw', 'Татьяна', '89191234578', '2021-10-03');
INSERT INTO users (email, password, name, contacts, date_register) VALUES ('email@mail.ru', '123!!!Qw', 'Машенька', '89171122222', '2020-10-01');
INSERT INTO users (email, password, name, contacts, date_register) VALUES ('mail@mail.ru', '12345!Qwe', 'Алексей', '89171234578', '2021-11-01');
INSERT INTO users (email, password, name, contacts, date_register) VALUES ('mail@gmail.com', '12345!Zx', 'Иван Васильевич', '89171234578', '2021-11-02');

/* ----- Добавляю значения в таблицу "Лоты" ----- */
INSERT INTO lots (name, description, img, date_register, date_expire, price, bid_step, category_id, author_user_id, winner_user_id)
VALUES ('2014 Rossignol District Snowboard', '2014 Rossignol District Snowboard', 'img/lot-1.jpg', '2021-11-20', '2021-12-02', 10999, 100, 1, 3, null);

INSERT INTO lots (name, description, img, date_register, date_expire, price, bid_step, category_id, author_user_id, winner_user_id)
VALUES ('DC Ply Mens 2016/2017 Snowboard', 'DC Ply Mens 2016/2017 Snowboard', 'img/lot-2.jpg', '2021-10-20', '2021-11-30', 159999, 1000, 1, 2, null); /* replace step */

INSERT INTO lots (name, description, img, date_register, date_expire, price, bid_step, category_id, author_user_id, winner_user_id)
VALUES ('Крепления Union Contact Pro 2015 года размер L/XL', 'Крепления Union Contact Pro 2015 года размер L/XL', 'img/lot-3.jpg', '2021-12-02', '2021-12-29', 8000, 200, 3, 4, null);

INSERT INTO lots (name, description, img, date_register, date_expire, price, bid_step, category_id, author_user_id, winner_user_id)
VALUES ('Ботинки для сноуборда DC Mutiny Charocal', 'Ботинки для сноуборда DC Mutiny Charocal', 'img/lot-4.jpg', '2021-12-07', '2021-12-15', 10999, 500, 4, 2, null);

INSERT INTO lots (name, description, img, date_register, date_expire, price, bid_step, category_id, author_user_id, winner_user_id)
VALUES ('Куртка для сноуборда DC Mutiny Charocal', 'Куртка для сноуборда DC Mutiny Charocal', 'img/lot-5.jpg', '2021-11-18', '2021-12-19', 8000, 200, 4, 2, null);

INSERT INTO lots (name, description, img, date_register, date_expire, price, bid_step, category_id, author_user_id, winner_user_id)
VALUES ('Маска Oakley Canopy', 'Маска Oakley Canopy', 'img/lot-6.jpg', '2021-12-05', '2022-01-05', 5400, 200, 4, 2, null);

/* ----- Добавляю значения в таблицу "Ставки" ----- */
INSERT INTO bid (amount, date_register, user_id, lot_id) VALUES (13199, '2021-12-01', 4, 1);
INSERT INTO bid (amount, date_register, user_id, lot_id) VALUES (13099, '2021-11-30', 3, 1);

INSERT INTO bid (amount, date_register, user_id, lot_id) VALUES (160999, '2021-12-01', 4, 2);
INSERT INTO bid (amount, date_register, user_id, lot_id) VALUES (161999, '2021-12-03', 3, 2);
INSERT INTO bid (amount, date_register, user_id, lot_id) VALUES (162999, '2021-12-05', 4, 2);

INSERT INTO bid (amount, date_register, user_id, lot_id) VALUES (8200, '2021-12-03', 2, 3);
INSERT INTO bid (amount, date_register, user_id, lot_id) VALUES (8400, '2021-12-05', 3, 3);
INSERT INTO bid (amount, date_register, user_id, lot_id) VALUES (8600, '2021-12-05', 2, 3);
INSERT INTO bid (amount, date_register, user_id, lot_id) VALUES (8800, '2021-12-05', 1, 3);
INSERT INTO bid (amount, date_register, user_id, lot_id) VALUES (9000, '2021-12-06', 2, 3);
INSERT INTO bid (amount, date_register, user_id, lot_id) VALUES (9200, '2021-12-06', 5, 3);

INSERT INTO bid (amount, date_register, user_id, lot_id) VALUES (10999, '2021-11-20', 4, 4);
INSERT INTO bid (amount, date_register, user_id, lot_id) VALUES (11499, '2021-11-30', 5, 4);
INSERT INTO bid (amount, date_register, user_id, lot_id) VALUES (11999, '2021-12-01', 6, 4);
INSERT INTO bid (amount, date_register, user_id, lot_id) VALUES (12499, '2021-12-03', 5, 4);
INSERT INTO bid (amount, date_register, user_id, lot_id) VALUES (12999, '2021-12-06', 6, 4);

INSERT INTO bid (amount, date_register, user_id, lot_id) VALUES (8200, '2021-11-21', 4, 5);
INSERT INTO bid (amount, date_register, user_id, lot_id) VALUES (8400, '2021-11-30', 3, 5);
INSERT INTO bid (amount, date_register, user_id, lot_id) VALUES (8600, '2021-12-05', 5, 5);

INSERT INTO bid (amount, date_register, user_id, lot_id) VALUES (5600, '2021-12-04', 1, 6);
INSERT INTO bid (amount, date_register, user_id, lot_id) VALUES (5800, '2021-12-04', 3, 6);
INSERT INTO bid (amount, date_register, user_id, lot_id) VALUES (6000, '2021-12-04', 4, 6);
INSERT INTO bid (amount, date_register, user_id, lot_id) VALUES (6200, '2021-12-04', 3, 6);
INSERT INTO bid (amount, date_register, user_id, lot_id) VALUES (6400, '2021-12-04', 5, 6);

UPDATE bid SET amount=5800 WHERE id=25;
UPDATE bid SET amount=6000 WHERE id=26;
UPDATE bid SET amount=6200 WHERE id=27;
UPDATE bid SET amount=6400 WHERE id=28;

/* ----- все запросы по заданию  ----- */
SELECT * FROM category;

/* ----- обновить название лота по его идентификатору ----- */
UPDATE lots SET name='Куртка для сноуборда Roxxy', description='Куртка для сноуборда Roxxy' WHERE id=5;

/* ----- показать лот по его ID. Получите также название категории, к которой принадлежит лот ----- */
SELECT lots.name, category.name AS `category`
FROM lots JOIN category ON lots.category_id=category.id WHERE lots.id=3;

/* ----- получить список ставок для лота по его идентификатору с сортировкой по дате ----- */
SELECT amount, date_register
FROM bid WHERE lot_id=3 ORDER BY date_register DESC;

/* ---- добавить еще один лот ----- */
INSERT INTO lots (name, description, img, date_register, date_expire, price, bid_step, category_id, author_user_id, winner_user_id)
VALUES ('Крутой такой шлем с ярким принтом вот здесь', 'Крутой такой шлем с ярким принтом вот здесь', 'img/lot-7.jpg', '2021-12-10', '2022-01-10', 5000, 250, 6, 1, null);

/* ----- получить самые новые, открытые лоты ----- */
SELECT lots.name, lots.price, lots.img AS `url`,
category.name AS `category`, lots.date_expire AS `date_expire`,
IFNULL(MAX(bid.amount), lots.price) AS `price`,
lots.date_register
FROM lots
JOIN category ON lots.category_id=category.id
LEFT OUTER JOIN bid ON lots.id=bid.lot_id
WHERE winner_user_id IS NULL
GROUP BY lots.name, lots.price, lots.img, category.name, lots.date_register, lots.date_expire
ORDER BY lots.date_register DESC;

/* ----- обновить время date_expire ----- */
UPDATE lots SET date_expire='2022-04-14' WHERE id=1;
UPDATE lots SET date_expire='2022-04-12' WHERE id=2;
UPDATE lots SET date_expire='2022-04-15' WHERE id=3;
UPDATE lots SET date_expire='2022-04-18' WHERE id=4;
UPDATE lots SET date_expire='2022-04-23' WHERE id=5;
UPDATE lots SET date_expire='2022-04-19' WHERE id=6;

/* ----- Добавить свежие ставки для лота #2 ----- */
INSERT INTO bid (amount, date_register, user_id, lot_id) VALUES (163999, '2022-04-09 21:10:00', 4, 2);
INSERT INTO bid (amount, date_register, user_id, lot_id) VALUES (164999, '2022-04-09 23:15:00', 3, 2);
INSERT INTO bid (amount, date_register, user_id, lot_id) VALUES (165999, '2022-04-10 06:10:10', 2, 2);
INSERT INTO bid (amount, date_register, user_id, lot_id) VALUES (166999, '2022-04-10 09:25:03', 3, 2);
INSERT INTO bid (amount, date_register, user_id, lot_id) VALUES (167999, '2022-04-10 10:37:05', 1, 2);
INSERT INTO bid (amount, date_register, user_id, lot_id) VALUES (168999, '2022-04-10 10:50:00', 4, 2);

UPDATE lots SET description='Легкий маневренный сноуборд, готовый дать жару в любом парке, растопив снег мощным щелчком и четкими дугами. Стекловолокно Bi-Ax, уложенное в двух направлениях, наделяет этот снаряд отличной гибкостью и отзывчивостью, а симметричная геометрия в сочетании с классическим прогибом кэмбер позволит уверенно держать высокие скорости. А если к концу катального дня сил совсем не останется, просто посмотрите на Вашу доску и улыбнитесь, крутая графика от Шона Кливера еще никого не оставляла равнодушным.' WHERE id=2;

/* ----- Добавить новых пользователей ----- ? может не понадобабится - не добавляй*/
INSERT INTO users (email, password, name, contacts, date_register) VALUES ('onemail@gmail.com', '12345!Zx', 'Владимир', '89171234578', '2021-11-02');
INSERT INTO users (email, password, name, contacts, date_register) VALUES ('supermail@gmail.com', '12345!Zx', 'Константин', '89171234578', '2021-11-02');
INSERT INTO users (email, password, name, contacts, date_register) VALUES ('superman@gmail.com', '12345!Zx', 'Евгений', '89171234578', '2021-11-02');
INSERT INTO users (email, password, name, contacts, date_register) VALUES ('hero@gmail.com', '12345!Zx', 'Семён', '89171234578', '2021-11-02');
INSERT INTO users (email, password, name, contacts, date_register) VALUES ('oneandonlyone@gmail.com', '12345!Zx', 'Владислав', '89171234578', '2021-11-02');

/* ----- Получить данные об одном лоте ----- */
SELECT lots.name, lots.price, lots.img AS `url`, lots.description,
category.name AS `category_name`, category.title AS `category_title`, lots.date_expire AS `date_expire`,
IFNULL(MAX(bid.amount), lots.price) AS `current_price`,
lots.date_register, lots.bid_step
FROM lots
JOIN category ON lots.category_id=category.id
LEFT OUTER JOIN bid ON lots.id=bid.lot_id
WHERE lots.id=3
GROUP BY lots.name, lots.price, lots.img, lots.description, lots.date_register, lots.date_expire;

/* ----- получить список всех ставок по одному лоту  ----- */
SELECT bid.amount, bid.date_register, bid.lot_id AS `bid_lot_id`, users.name AS `bid_user_name`
FROM bid
JOIN users ON bid.user_id=users.id
WHERE lot_id=3 ORDER BY date_register DESC;

/* ----- Добавить свежие ставки для лота #2 ----- */
INSERT INTO bid (amount, date_register, user_id, lot_id) VALUES (169999, '2022-04-10 13:40:00', 2, 2);
UPDATE bid SET date_register="2022-04-10 13:45:00", amount='169999' WHERE id=25;
INSERT INTO bid (amount, date_register, user_id, lot_id) VALUES (170999, '2022-04-10 19:50:00', 1, 2);
