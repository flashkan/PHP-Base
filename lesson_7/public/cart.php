<div>
    <?php if ($emptyCart) : ?>
        <div class="alert alert-danger d-flex justify-content-center" role="alert">
            <p class="mt-2 mb-0 mr-2"><?= $emptyCart ?></p>
            <a class='btn btn-outline-success ' href='/'>Хотите приступить к покупкам?</a>
        </div>
    <?php endif; ?>
    <?php foreach ($employee as $good) : ?>
        <div class="border rounded p-3 m-5 row align-items-center btn-light">
            <img class="img col-2" src="/public/img/low/<?= $good['good_name'] ?>.jpg"
                 alt="<?= $good['good_name'] ?>">
            <div class="col-1"></div>
            <p class="col-1"><?= $good['good_name'] ?></p>
            <p class="col-2"><?= $good['good_description'] ?></p>
            <p class="col-1">Цена : <?= $good['good_price'] ?> руб</p>
            <p class="col-1">Количесто : <?= $good['good_quantity'] ?></p>
            <div class="col-1"></div>
            <form method="post" class="col-1 btn-group">
                <button type="submit" name="goodUp" value="<?= $good['id_good'] ?>" class="btn btn-success">+1
                </button>
                <button type="submit" name="goodDown" value="<?= $good['id_good'] ?>" class="btn btn-danger">-1
                </button>
            </form>
            <form method="post" class="col-2 d-flex justify-content-between">
                <button type="submit" name="goodDel" value="<?= $good['id_good'] ?>"
                        class="btn btn-secondary float-right">Убрать товар
                </button>
                <?php if ($_SESSION['isAdmin']) : ?>
                    <strong><?= $good['user_log'] ?></strong>
                <?php endif; ?>
            </form>
        </div>
    <?php endforeach ?>
    <?php if ($employee) : ?>
    <div class="ml-5 mb-5">
        <h3 class="mb-4">Оформить заказ</h3>
        <h5>Стоимость заказа : <?= $totalPrice ?> руб</h5>
        <form method="post">
            <button type="submit" name="newOrder" class="btn btn-success">Оформить заказ</button>
        </form>
    </div>
    <?php endif; ?>
</div>