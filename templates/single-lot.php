<?php list($hours, $minutes) = countLeftTime($product["date_expire"]); ?>

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
    <section class="lot-item container">
        <h2><?= html_sc($product["name"]); ?></h2>
        <div class="lot-item__content">
            <div class="lot-item__left">
                <div class="lot-item__image">
                    <img src="<?= html_sc($product["url"]); ?>" width="730" height="548" alt="<?= html_sc($product["name"]); ?>">
                </div>
            <p class="lot-item__category">Категория:
                <span><?= html_sc($product["category_title"]); ?></span>
            </p>
            <p class="lot-item__description"><?= html_sc($product["description"]); ?>
            </p>
        </div>
        <div class="lot-item__right">
            <div class="lot-item__state">
                <div class="lot-item__timer timer <?php if (intval($hours) < 1):?> timer--finishing <?php endif; ?>">
                    <?= html_sc($hours); ?>: <?= html_sc($minutes); ?>
                </div>
                <div class="lot-item__cost-state">
                    <div class="lot-item__rate">
                        <span class="lot-item__amount">Текущая цена</span>
                        <span class="lot-item__cost"><?= html_sc($product["current_price"]);?></span>
                    </div>
                    <div class="lot-item__min-cost">
                        Мин. ставка <span><?= html_sc($product["bid_step"]); ?></span>
                    </div>
                </div>
                <form class="lot-item__form" action="https://echo.htmlacademy.ru" method="post" autocomplete="off">
                    <p class="lot-item__form-item form__item form__item--invalid">
                        <label for="cost">Ваша ставка</label>
                        <input id="cost" type="text" name="cost" placeholder="<?= html_sc($product["current_price"] + $product["bid_step"]); ?>">
                        <span class="form__error">Введите наименование лота</span>
                    </p>

                    <button type="submit" class="button">Сделать ставку</button>
                </form>
            </div>
            <div class="history">
                <h3>История ставок (<span><?= html_sc(count($product_bids)); ?></span>)</h3>
                <table class="history__list">
                    <?php foreach($product_bids as $id => $bid):?>
                    <tr class="history__item">
                        <td class="history__name"><?= html_sc($bid["bid_user_name"]); ?></td>
                        <td class="history__price"><?= html_sc(showPrice($bid["amount"])); ?></td>
                        <td class="history__time">

                        <?php
                        list($hoursPassed, $minutesPassed) = countPassTime($bid["date_register"]);
                        if (intval($hoursPassed) < 1) {
                            if (intval($minutesPassed) === 1) {
                                echo "Минуту назад";
                            } else {
                                echo $minutesPassed . " " . get_noun_plural_form($minutesPassed, "минута", "минуты", "минут") . " назад";
                            }
                        }
                        elseif (intval($hoursPassed) === 1 && intval($minutesPassed) < 30) {
                            echo "Час назад";
                        } else {
                            echo date("d.m.Y", strtotime($bid["date_register"])) . " в " . date("H:i:s", strtotime($bid["date_register"]));
                        }
                        ?>

                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            </div>
        </div>
    </section>
</main>
