<div class="jumbotron mb-0">
    <h1 class="display-4">Привет, <?= $user['user_name'] ?>!</h1>
    <p class="lead">Добро пожаловать в личный кабинет.</p>
    <p>Можете начать делать покупки или проверить свою корзину.</p>
    <p class="lead">
        <a class="btn btn-primary btn-lg" href="/" role="button">Начать покупки !!!</a>
        <a class="btn btn-primary btn-lg" href="/cart.php" role="button">Посетить корзину !!!</a>
    </p>
    <hr class="my-4">
    <h5>Личные данные</h5>
    <?php if ($isAdmin) : ?><p class="lead"><strong>Администратор</strong></p> <?php endif; ?>
    <p class="lead">Имя : <strong><?= $user['user_name'] ?></strong></p>
    <p class="lead">Логин : <strong><?= $user['user_log'] ?></strong></p>
    <p class="lead">Email : <strong><?= $user['user_email'] ?></strong></p>
    <hr class="my-4">
    <h5>Смена пароля</h5>
    <form method="post">
        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="inputPassword">Старый пароль</label>
                <input name="oldPassword" type="password" class="form-control"
                       id="inputPassword"
                       placeholder="Старый пароль">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="inputNewPassword">Новый пароль</label>
                <input name="newPassword" type="password" class="form-control" id="inputNewPassword"
                       placeholder="Новый пароль">
            </div>
            <div class="form-group col-md-2">
                <label for="inputNewPassword2">Повторите новый пароль</label>
                <input name="newPasswordAgain" type="password" class="form-control" id="inputNewPassword2"
                       placeholder="Повторите новый пароль">
            </div>
        </div>
        <div class="form-row">
            <button type="submit" class="btn btn-primary mx-2">Сменить пароль</button>
            <?php if ($accountError) : ?>
                <div class="alert alert-danger mb-0" role="alert">
                    <?= $accountError ?>
                </div>
            <?php endif; ?>
            <?php if ($newPasswordSuccess) : ?>
                <div class="alert alert-success mb-0" role="alert">
                    <?= $newPasswordSuccess ?>
                </div>
            <?php endif; ?>
        </div>
    </form>
    <hr class="my-4">
    <h5>Удаление аккаунта</h5>
    <form method="post">
        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="inputDel">Если вы действительно хотите удалить аккаунт, введите "Удалить"</label>
                <input name="accountDel" type="text" class="form-control" id="inputDel" placeholder="Удалить">
            </div>
        </div>
        <div class="form-row">
            <button type="submit" class="btn btn-primary mx-2">Удалить аккаунт</button>
            <?php if ($delError) : ?>
                <div class="alert alert-danger mb-0" role="alert">
                    <?= $delError ?>
                </div>
            <?php endif; ?>
        </div>
    </form>

    <?php if ($isAdmin) : ?>
        <hr class="my-4">
        <h5>Администрирование</h5>
        <div>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">user ID</th>
                    <th scope="col">Имя</th>
                    <th scope="col">Логин</th>
                    <th scope="col">Хэш пароля</th>
                    <th scope="col">Email</th>
                    <th scope="col">?Админ?</th>
                    <th scope="col">Действия</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($employee as $elem) : ?>
                    <tr>
                        <th scope="row"><?= $elem['user_id'] ?></th>
                        <td><?= $elem['user_name'] ?></td>
                        <td><?= $elem['user_log'] ?></td>
                        <td><?= $elem['user_pass'] ?></td>
                        <td><?= $elem['user_email'] ?></td>
                        <td><?= $elem['user_admin'] ?></td>
                        <td>
                            <form method="post">
                                <button type="submit" name="accountDelAdmin" value="<?= $elem['user_id'] ?>"
                                        class="btn btn-danger">Удалить
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>