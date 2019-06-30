<?php if ($emptyOrders) : ?>
    <div class="alert alert-danger d-flex justify-content-center" role="alert">
        <p class="mt-2 mb-0 mr-2"><?= $emptyOrders ?></p>
        <a class='btn btn-outline-success ' href='/'>Хотите приступить к покупкам?</a>
        <p class="mt-2 mb-0 mx-2">или</p>
        <a class='btn btn-outline-success ' href='/cart.php'>Проверить корзину?</a>
    </div>
<?php endif; ?>
<?php if ($employee) : ?>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th class="text-center" scope="col">id заказа</th>
            <th class="text-center" scope="col">Логин</th>
            <th class="text-center" scope="col">Стоимость заказа (руб)</th>
            <th class="text-center" scope="col">Дата заказа</th>
            <th class="text-center" scope="col">Статус заказа</th>
            <th class="text-center" scope="col">Действия</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($employee as $order) : ?>
            <tr data-toggle="collapse" data-target="#collapseExample<?= $order['id_order'] ?>">
                <th class="text-center" scope="row"><?= $order['id_order'] ?></th>
                <td class="text-center"><?= $order['user_log_order'] ?></td>
                <td class="text-center"><?= $order['total_price_order'] ?></td>
                <td class="text-center"><?= $order['data_order'] ?></td>
                <td class="text-center">
                    <?= $order['status_order'] ?>
                    <?php if ($_SESSION['isAdmin']) : ?>
                        <form method="post" class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Изменить статус
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <button name="processing" value="<?= $order['id_order'] ?>" class="dropdown-item">
                                    Обработка
                                </button>
                                <button name="delivery" value="<?= $order['id_order'] ?>" class="dropdown-item">
                                    Доставляется
                                </button>
                                <button name="arrived" value="<?= $order['id_order'] ?>" class="dropdown-item">
                                    Доставлено
                                </button>
                                <button name="closed" value="<?= $order['id_order'] ?>" class="dropdown-item">Закрыт
                                </button>
                            </div>
                        </form>
                    <?php endif; ?>
                </td>

                <td>
                    <form method="post" class="d-flex justify-content-center mt-2">
                        <button name="delOrder" value="<?= $order['id_order'] ?>" class="btn btn-danger">Отменить
                            заказ
                        </button>
                    </form>
                </td>

            </tr>
            <tr>
                <td colspan="6" class="collapse" id="collapseExample<?= $order['id_order'] ?>">


                    <table class="table table-hover table-dark">
                        <thead>
                        <tr>
                            <th class="text-center" scope="col">Изображение</th>
                            <th class="text-center" scope="col">id товара</th>
                            <th class="text-center" scope="col">Название товара</th>
                            <th class="text-center" scope="col">Описание</th>
                            <th class="text-center" scope="col">Цена</th>
                            <th class="text-center" scope="col">Колличество</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach (json_decode($order['json_order'], true) as $key => $item) : ?>
                            <?php $good = mysqli_fetch_assoc(mysqli_query(myDB_connect(), "SELECT * FROM `goods` 
                            WHERE `id_good` = $key")) ?>
                            <tr>
                                <td class="d-flex justify-content-center"><img src="/public/img/low/<?= $good['good_name'] ?>.jpg" alt="<?= $good['name'] ?>">
                                </td>
                                <td class="text-center">"<?= $good['id_good'] ?>"</td>
                                <td class="text-center"><?= $good['good_name'] ?></td>
                                <td class="text-center"><?= $good['good_description'] ?></td>
                                <td class="text-center"><?= $good['good_price'] ?> руб</td>
                                <td class="text-center"><?= $item ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </td>
            </tr>

        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

