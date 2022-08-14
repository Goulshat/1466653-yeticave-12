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

    <div class="container">
        <p>Вы успешно вышли из аккаунта</p>
        <p>
            <a href="signup.php">Зарегистрировать</a>
            новую учетную запись
        </p>
    </div>
</main>
