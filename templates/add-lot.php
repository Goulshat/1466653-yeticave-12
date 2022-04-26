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
            <div class="form__item <?php if (in_array("lot-name-empty", $errors)):?> form__item--invalid <?php endif; ?>">
                <label for="lot-name">Наименование <sup>*</sup></label>
                <input id="lot-name" type="text" name="lot-name" placeholder="Введите наименование лота" value="<?= $new_lot["lot-name"]; ?>">
                <span class="form__error">Введите наименование лота</span>
            </div>

            <div class="form__item <?php if (in_array("category-empty", $errors)):?> form__item--invalid <?php endif; ?>">
                <label for="category">Категория <sup>*</sup></label>
                <select id="category" name="category">
                    <option value="0"> - Выберите из списка - </option>
                    <?php foreach($categories as $category => $value): ?>
                    <option value="<?= html_sc($value["id"]); ?>"><?= html_sc($value["title"]); ?></option>
                    <?php endforeach; ?>
                </select>
                <span class="form__error">Выберите категорию</span>
            </div>
        </div>

        <div class="form__item form__item--wide <?php if (in_array("description-empty", $errors)):?> form__item--invalid <?php endif; ?>">
            <label for="message">Описание <sup>*</sup></label>
            <textarea id="message" name="description" placeholder="Напишите описание лота"><?= $new_lot["description"]; ?></textarea>
            <span class="form__error">Напишите описание лота</span>
        </div>

        <div class="form__item form__item--file <?php if (in_array("lot-img-empty", $errors) ||  in_array("lot-photo-type", $errors)):?> form__item--invalid <?php endif; ?>">
            <label>Изображение <sup>*</sup></label>
            <div class="form__input-file">
                <input class="visually-hidden" name="lot-img" type="file" id="lot-img">
                <label for="lot-img">
                    Добавить
                </label>
            </div>
            <span class="form__error">
                <?= in_array("lot-photo-type", $errors) ? "Допустимые форматы: jpeg/jpg, png, webp" : "Добавьте изображение лота"; ?>
            </span>
        </div>
        <div class="form__container-three">
            <div class="form__item form__item--small<?php if (in_array("start-price-empty", $errors) || in_array("start-price-unvalid", $errors)):?> form__item--invalid <?php endif; ?>">
                <label for="start-price">Начальная цена <sup>*</sup></label>
                <input id="start-price" type="text" name="start-price" placeholder="0" value="<?= $new_lot["start-price"]; ?>">
                <span class="form__error">Введите начальную цену
                    <?php if(in_array("start-price-unvalid", $errors)):?> - число больше нуля"
                    <?php endif;?>
                </span>
            </div>
            <div class="form__item form__item--small<?php if (in_array("bid-step-empty", $errors) || in_array("bid-step-range-error", $errors)):?> form__item--invalid <?php endif; ?>">
                <label for="bid-step">Шаг ставки <sup>*</sup></label>
                <input id="bid-step" type="text" name="bid-step" placeholder="0" value="<?= $new_lot["bid-step"]; ?>">
                <span class="form__error">Введите шаг ставки - от <?= $bid_step_min?> до <?= $bid_step_max?>руб.</span>
            </div>
            <div class="form__item<?php if (in_array("date-expire-empty", $errors) || in_array("date-expire-error", $errors) || in_array("date-format-error", $errors)):?> form__item--invalid <?php endif; ?>">
                <label for="date-expire">Дата окончания торгов <sup>*</sup></label>
                <input class="form__input-date" id="date-expire" type="text" name="date-expire" placeholder="Введите дату в формате ГГГГ-ММ-ДД" value="<?= $new_lot["date-expire"]; ?>">
                <span class="form__error">
                    <?= in_array("date-expire-error", $errors) ? "Должно быть не менее суток до окончания торгов" : (in_array("date-format-error", $errors) ? "Поправьте формат даты на ГГГГ-ММ-ДД" : "Введите дату завершения торгов в формате ГГГГ-ММ-ДД"); ?>
                </span>
            </div>
        </div>
        <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
        <button type="submit" class="button">Добавить лот</button>
    </form>
</main>
