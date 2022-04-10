<?php
date_default_timezone_set("Asia/Yekaterinburg");

$product_name = $product[0]["name"];
$product_category_name = $product[0]["category_name"];
$product_category_title = $product[0]["category_title"];
$product_description = $product[0]["description"];
$current_price = $product[0]["current_price"];
$product_url = $product[0]["url"];
$bid_step = $product[0]["bid_step"];
list($hours, $minutes) = countLeftTime($product[0]["date_expire"]);

?>

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
        <h2><?= html_sc($product_name); ?></h2>
        <div class="lot-item__content">
            <div class="lot-item__left">
                <div class="lot-item__image">
                    <img src="<?= html_sc($product_url); ?>" width="730" height="548" alt="<?= html_sc($product_name); ?>">
                </div>
            <p class="lot-item__category">Категория:
                <span><?= html_sc($product_category_title); ?></span>
            </p>
            <p class="lot-item__description"><?= html_sc($product_description); ?>
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
                        <span class="lot-item__cost"><?= html_sc($current_price);?></span>
                    </div>
                    <div class="lot-item__min-cost">
                        Мин. ставка <span><?= html_sc($bid_step); ?></span>
                    </div>
                </div>
                <form class="lot-item__form" action="https://echo.htmlacademy.ru" method="post" autocomplete="off">
                    <p class="lot-item__form-item form__item form__item--invalid">
                        <label for="cost">Ваша ставка</label>
                        <input id="cost" type="text" name="cost" placeholder="<?= html_sc($current_price + $bid_step); ?>">
                        <span class="form__error">Введите наименование лота</span>
                    </p>

                    <button type="submit" class="button">Сделать ставку</button>
                </form>
            </div>
            <div class="history">
                <h3>История ставок (<span><?= count($product_bids); ?></span>)</h3>
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
