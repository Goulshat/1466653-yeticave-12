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

    <form class="form container <?php if (count($errors) > 0):?> form__item--invalid <?php endif; ?>" action="login.php" method="post">
        <h2><?= html_sc($page_name); ?></h2>
        <div class="form__item <?php if(isset($errors["login"])):?> form__item--invalid <?php endif; ?>">
            <label for="email">E-mail <sup>*</sup></label>
            <input id="email" type="text" name="email" placeholder="Введите e-mail"  value="<?= html_sc($_POST["email"] ?? "");?>">
            <span class="form__error"><?= html_sc($errors["login"] ?? ""); ?></span>
        </div>
        <div class="form__item form__item--last <?php if(isset($errors["password"])):?> form__item--invalid <?php endif; ?>">
            <label for="password">Пароль <sup>*</sup></label>
            <input id="password" type="password" name="password" placeholder="Введите пароль">
            <span class="form__error"><?= html_sc($errors["password"] ?? ""); ?></span>
        </div>
        <button type="submit" class="button">Войти</button>
    </form>

    <?php if(isset($errors["new-user"])):?>
        <div class="form__item">
            <a href="login.php">Зарегистрироваться</a>
        </div>
    <?php endif; ?>
</main>
