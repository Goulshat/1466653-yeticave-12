<main>
    <nav class="nav">
        <ul class="nav__list container">
        <?php foreach($categories as $category => $value): ?>
            <li class="nav__item">
                <a href="all-lots.html"> <?= html_sc($value["title"]); ?></a>
            </li>
        <?php endforeach; ?>
        </ul>
    </nav>

    <form class="form form--add-lot container <?php if (count($errors) > 0 ):?> form--invalid <?php endif; ?>" name="add-lot" action="add.php" method="post" enctype="multipart/form-data">
        <h2>Добавление лота</h2>

        <div class="form__container-two">
            <div class="form__item <?php if (isset($errors["lot-name"])):?> form__item--invalid <?php endif; ?>">
                <label for="lot-name">Наименование <sup>*</sup></label>
                <input id="lot-name" type="text" name="lot-name" placeholder="Введите наименование лота"
                        value="<?= isset($new_lot["lot-name"]) ? $new_lot["lot-name"] : "" ; ?>">
                <span class="form__error"><?= $errors["lot-name"] ? $errors["lot-name"] : ""; ?></span>
            </div>

            <div class="form__item <?php if (isset($errors["category"])):?> form__item--invalid <?php endif; ?>">
                <label for="category">Категория <sup>*</sup></label>
                <select id="category" name="category">
                    <option value="0"> - Выберите из списка - </option>
                    <?php foreach($categories as $category => $value): ?>
                    <option value="<?= html_sc($value["id"]); ?>" <?php if(isset($new_lot["category"]) && ($value["id"] === $new_lot["category"])):?> selected <?php endif; ?>><?= html_sc($value["title"]); ?></option>
                    <?php endforeach; ?>
                </select>
                <span class="form__error"><?= isset($errors["category"]) ? $errors["category"] : ""; ?></span>
            </div>
        </div>

        <div class="form__item form__item--wide <?php if(isset($errors["description"])):?> form__item--invalid <?php endif; ?>">
            <label for="message">Описание <sup>*</sup></label>
            <textarea id="message" name="description" placeholder="Напишите описание лота"><?= isset($new_lot["description"]) ? $new_lot["description"] : "" ; ?></textarea>
            <span class="form__error"><?= isset($errors["description"]) ? $errors["description"] : ""; ?></span>
        </div>

        <div class="form__item form__item--file <?php if (isset($errors["lot-img"])) :?> form__item--invalid <?php endif; ?>">
            <label>Изображение <sup>*</sup></label>
            <div class="form__input-file">
                <input class="visually-hidden" name="lot-img" type="file" id="lot-img">
                <label for="lot-img">
                    Добавить
                </label>
            </div>
            <span class="form__error"><?= isset($errors["lot-img"]) ? $errors["lot-img"] : ""; ?></span>
        </div>

        <div class="form__container-three">
            <div class="form__item form__item--small<?php if (isset($errors["start-price"])):?> form__item--invalid <?php endif; ?>">
                <label for="start-price">Начальная цена <sup>*</sup></label>
                <input id="start-price" type="text" name="start-price" placeholder="0"
                    value="<?= isset($new_lot["start-price"]) ? $new_lot["start-price"] : ""; ?>">
                <span class="form__error"><?= isset($errors["start-price"]) ? $errors["start-price"] : ""; ?></span>
            </div>

            <div class="form__item form__item--small<?php if (isset($errors["bid-step"])):?> form__item--invalid <?php endif; ?>">
                <label for="bid-step">Шаг ставки <sup>*</sup></label>
                <input id="bid-step" type="text" name="bid-step"
                    placeholder="от <?= $bid_step_min?> до <?= $bid_step_max?>"
                    value="<?= isset($new_lot["bid-step"]) ? $new_lot["bid-step"] : "";?>">
                <span class="form__error"><?= isset($errors["bid-step"]) ? $errors["bid-step"] : ""; ?></span>
            </div>

            <div class="form__item<?php if (isset($errors["date-expire"])):?> form__item--invalid <?php endif; ?>">
                <label for="date-expire">Дата окончания торгов <sup>*</sup></label>
                <input class="form__input-date" id="date-expire" type="text" name="date-expire" placeholder="Введите дату в формате ГГГГ-ММ-ДД" value="<?= isset($new_lot["date-expire"]) ? $new_lot["date-expire"] : ""; ?>">
                <span class="form__error"><?= isset($errors["date-expire"]) ? $errors["date-expire"] : ""; ?></span>
            </div>
        </div>

        <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
        <button type="submit" class="button">Добавить лот</button>
    </form>
</main>
