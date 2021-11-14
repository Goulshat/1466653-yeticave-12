<main class="container">
    <section class="promo">
        <h2 class="promo__title">Нужен стафф для катки?</h2>
        <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
        <ul class="promo__list">
            <!--заполните этот список из массива категорий-->
            <?php foreach($categories as $category => $value): ?>
            <li class="promo__item promo__item--boards">
                <a class="promo__link" href="pages/all-lots.html">
                    <?= html_sc($value); ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
    </section>

    <section class="lots">
        <div class="lots__header">
            <h2>Открытые лоты</h2>
        </div>

        <ul class="lots__list">
            <!--заполните этот список из массива с товарами-->
            <?php foreach($products as $id => $product):?>

            <li class="lots__item lot">
                <div class="lot__image">
                    <img src="<?= html_sc($product["url"])?>" width="350" height="260"
                        alt="<?= html_sc($product["name"]);?>">
                </div>

                <div class="lot__info">
                    <span class="lot__category">
                        <?= html_sc($product["category"]);?>
                    </span>

                    <h3 class="lot__title">
                        <a class="text-link" href="pages/lot.html">
                            <?= html_sc($product["name"]);?>
                        </a>
                    </h3>

                    <div class="lot__state">
                        <div class="lot__rate">
                            <span class="lot__amount">Стартовая цена</span>
                            <span class="lot__cost">
                                <?= html_sc(showPrice($product["price"]))?>
                            </span>
                        </div>
                        <?php $itemExpireDate = countLeftTime($product["expireDate"])?> <!-- вот здесь фактический вывод получаемого массива в переменную без html_sc(). Как можно обезопасить? -->
                        <div class="lot__timer timer
                            <?php if (html_sc($itemExpireDate[0]) < 1){
                                echo "timer--finishing";
                            }?>">
                            <?= html_sc($itemExpireDate[0]) . ": " . html_sc($itemExpireDate[1]); ?>
                        </div>
                    </div>
                </div>
            </li>

            <?php endforeach; ?>
        </ul>
    </section>
</main>
