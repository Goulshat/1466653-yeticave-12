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

/* ----- Добавляю значения в таблицу "Пользователи" ----- */
INSERT INTO lots (name, description, img, date_register, date_expire, price, bid_step, category_id, author_user_id, winner_user_id)
VALUES ('2014 Rossignol District Snowboard', '2014 Rossignol District Snowboard', 'img/lot-1.jpg', '2021-11-20', '2021-21-11', 10999, 100, 1, 3, 4);

INSERT INTO lots (name, description, img, date_register, date_expire, price, bid_step, category_id, author_user_id, winner_user_id)
VALUES ('DC Ply Mens 2016/2017 Snowboard', 'DC Ply Mens 2016/2017 Snowboard', 'img/lot-2.jpg', '2021-10-20', '2021-12-21', 159999, 1000, 1, 2, 5); /* replace step */

INSERT INTO lots (name, description, img, date_register, date_expire, price, bid_step, category_id, author_user_id, winner_user_id)
VALUES ('Крепления Union Contact Pro 2015 года размер L/XL', 'Крепления Union Contact Pro 2015 года размер L/XL', 'img/lot-3.jpg', '2021-12-02', '2021-12-29', 8000, 200, 3, 4, 1);

INSERT INTO lots (name, description, img, date_register, date_expire, price, bid_step, category_id, author_user_id, winner_user_id)
VALUES ('Ботинки для сноуборда DC Mutiny Charocal', 'Ботинки для сноуборда DC Mutiny Charocal', 'img/lot-4.jpg', '2021-11-15', '2021-12-15', 10999, 500, 4, 2, 1);

INSERT INTO lots (name, description, img, date_register, date_expire, price, bid_step, category_id, author_user_id, winner_user_id)
VALUES ('Куртка для сноуборда DC Mutiny Charocal', 'Куртка для сноуборда DC Mutiny Charocal', 'img/lot-5.jpg', '2021-11-18', '2021-12-19', 8000, 200, 4, 2, 1);

INSERT INTO lots (name, description, img, date_register, date_expire, price, bid_step, category_id, author_user_id, winner_user_id)
VALUES ('Маска Oakley Canopy', 'Маска Oakley Canopy', 'img/lot-6.jpg', '2021-12-05', '2022-01-05', 5400, 200, 4, 2, 1);

/* ----- Добавляю значения в таблицу "Ставки" ----- */
INSERT INTO bid (amount, date_register, user_id, lot_id) VALUES (13199, '2021-12-01', 4, 1);
INSERT INTO bid (amount, date_register, user_id, lot_id) VALUES (13099, '2021-11-30', 3, 1);
INSERT INTO bid (amount, date_register, user_id, lot_id) VALUES (9000, '2021-12-05', 2, 3);
INSERT INTO bid (amount, date_register, user_id, lot_id) VALUES (12999, '2021-12-04', 4, 4);

/* ----- получить все категории ----- */
SELECT * FROM category;

/* ----- обновить expire_date по id ----- */
UPDATE lots SET expire_date='2021-11-30' WHERE id=2;

/* ----- удалить победителей из незакрытых лотов ----- */
UPDATE lots SET winner_user_id=NULL WHERE date_expire > CURDATE();

/* ----- получить самые новые, открытые лоты ----- */
SELECT * FROM (
  SELECT * FROM lots WHERE winner_user_id IS NULL
  ) AS result
  WHERE date_register > CURDATE() -3;

/* ----- обновить название лота по его идентификатору ----- */
UPDATE lots SET name='Куртка для сноуборда Roxxy', description='Куртка для сноуборда Roxxy' WHERE id=5;

/* ----- показать лот по его ID. Получите также название категории, к которой принадлежит лот ----- */
SELECT lots.id, lots.name AS 'Item' from lots JOIN category ON lots.category_id=category.id WHERE lots.id=3;

/* ----- получить список ставок для лота по его идентификатору с сортировкой по дате ----- */
SELECT lots.id, lots.name, bid.amount, lots.date_expire FROM
lots JOIN bid ON lots.id=bid.lot_id
WHERE lots.id=1 ORDER BY lots.date_expire;
