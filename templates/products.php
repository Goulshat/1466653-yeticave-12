<?php foreach($products as $id => $product):?>

<li class="lots__item lot">
    <div class="lot__image">
        <img src="<?= $product['url']?>" width="350" height="260" alt="<?= htmlspecialchars($product['name']);?>">
    </div>

    <div class="lot__info">
        <span class="lot__category"><?= htmlspecialchars($product['category']);?></span>

        <h3 class="lot__title"><a class="text-link" href="pages/lot.html"><?= htmlspecialchars($product['name']);?></a></h3>

        <div class="lot__state">
            <div class="lot__rate">
                <span class="lot__amount">Стартовая цена</span>
                <span class="lot__cost"><?= showPrice($product['price'])?></span>
            </div>

            <div class="lot__timer timer">
                12:23
            </div>
        </div>
    </div>
</li>

<?php endforeach; ?>
