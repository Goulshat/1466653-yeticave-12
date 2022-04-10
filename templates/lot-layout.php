<?php
function getProductCategoryTitle (string $product_category_name, array $categories) {
    foreach ($categories as $category => $value) {
        if ($value["name"] === $product_category_name) {
            return $value["title"];
        }
    };
}

// function getProductBids ($product_id, array $bids) {
//     $product_bids = [];
//     foreach ($bids as $id => $bid) {
//         if ($bid["bid_lot_id"] == $product_id) {
//             $product_bids [] = $bid;
//         }
//     };

//     return $product_bids;
// }


$product_id = $_GET["id"];
$product_category_name = $products[$_GET["id"]]["category"];
$product_category_title = getProductCategoryTitle($product_category_name, $categories);
$product_description = $products[$_GET["id"]]["description"];
$current_price = $products[$_GET["id"]]["current_price"];
$bid_step = $products[$_GET["id"]]["bid_step"];
list($hours, $minutes) = countLeftTime($products[$_GET["id"]]["date_expire"]);
//$current_product_bids = getProductBids($product_id, $bids);
?>
<pre>
<?=
var_dump($products);
var_dump("Символьный код категории текущего товара -  " . $product_category_name);
var_dump("Категория текущего товара -  " . $product_category_title);
var_dump($products[$_GET["id"]]);
var_dump($bids);
var_dump($product_id);
var_dump($current_product_bids);
var_dump($page_name);

?>
</pre>
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
        <h2><?= html_sc($products[$_GET["id"]]["name"]); ?></h2>
        <div class="lot-item__content">
            <div class="lot-item__left">
                <div class="lot-item__image">
                    <img src="<?= html_sc($products[$_GET["id"]]["url"]); ?>" width="730" height="548" alt="<?= html_sc($products[$_GET["id"]]["name"]); ?>">
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
                        Мин. ставка <span><?= html_sc($current_price + $bid_step); ?></span>
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
                <h3>История ставок (<span>10</span>)</h3>
                <table class="history__list">
                    <?php
                    $sql = "
                    SELECT bid.amount, date_register
                    FROM bid WHERE lot_id=3 ORDER BY date_register DESC;

                    SELECT bid.amount, bid.date_register, users.name AS `bid_user_name`
                    FROM bid
                    JOIN users ON bid.user_id=users.id
                    WHERE bid.lot_id=?
                    ORDER BY date_register DESC;
                    ";

                    $sql_var = html_sc($product_id);

                    $stmt = $db->prepare($sql); // Подготовка запроса
                    $stmt->bind_param("i", $sql_var); // Связываю с переменными
                    $stmt->execute(); // Выполняю запрос
                    $result = $stmt->get_result();

                    $bids = []; // инициализировать пустой массив перед циклом
                    while ($row = $result->fetch_assoc()) {
                        $bids[] = $row;
                    }
                    ?>
                    <?php foreach($bids as $id => $bid): ?>
                        <tr class="history__item">
                            <td class="history__name">Иван</td>
                            <td class="history__price">10 999 р</td>
                            <td class="history__time">5 минут назад</td>
                        </tr>
                    <?php endforeach; ?>
                <tr class="history__item">
                    <td class="history__name">Константин</td>
                    <td class="history__price">10 999 р</td>
                    <td class="history__time">20 минут назад</td>
                </tr>
                <tr class="history__item">
                    <td class="history__name">Евгений</td>
                    <td class="history__price">10 999 р</td>
                    <td class="history__time">Час назад</td>
                </tr>
                <tr class="history__item">
                    <td class="history__name">Игорь</td>
                    <td class="history__price">10 999 р</td>
                    <td class="history__time">19.03.17 в 08:21</td>
                </tr>
                <tr class="history__item">
                    <td class="history__name">Енакентий</td>
                    <td class="history__price">10 999 р</td>
                    <td class="history__time">19.03.17 в 13:20</td>
                </tr>

                </table>
            </div>
            </div>
        </div>
    </section>
</main>
