<main class="container">
    <section class="promo">
        <h2 class="promo__title">Нужен стафф для катки?</h2>
        <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
        <ul class="promo__list">
        <?php foreach($categories as $category => $value): ?>
            <li class="promo__item promo__item--<?= html_sc($value["name"]); ?>">
            <a class="promo__link" href="pages/all-lots.html">
                <?= html_sc($value["title"]); ?>
            </a>
            </li>
        <?php endforeach; ?>
        </ul>
    </section>

    <section class="lots">
        <?php if(!$products): ?>
        <div class="lots__header">
            <h2>Скоро здесь будут новинки и крутые ништячки</h2>
        </div>

        <?php else: ?>
        <div class="lots__header">
            <h2>Открытые лоты</h2>
        </div>

        <ul class="lots__list">
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
                    <a class="text-link" href="lot.php?id=<?= html_sc($product["id"]);?>">
                    <?= html_sc($product["name"]);?>
                    </a>
                </h3>

                <div class="lot__state">
                    <div class="lot__rate">
                        <span class="lot__amount">Стартовая цена</span>
                        <span class="lot__cost">
                            <?= html_sc(showPrice($product["current_price"]))?>
                        </span>
                    </div>
                    <?php list($hours, $minutes) = countLeftTime($product["date_expire"]);?>
                    <div class="lot__timer timer<?php if (intval($hours) < 1):?> timer--finishing <?php endif; ?>";>
                        <?= html_sc($hours); ?>: <?= html_sc($minutes); ?>
                    </div>
                </div>
                </div>
            </li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>
    </section>
</main>
