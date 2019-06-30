<div class="d-flex flex-wrap mb-5 p-1 justify-content-center">
    <?php foreach ($employee as $good) : ?>
        <div class="card col-2 m-4 shadow-lg p-3 mb-5 rounded btn-light" data-toggle="modal"
             data-target="#modal_<?= $good['id_good'] ?>">
            <img class="img" src="/public/img/low/<?= $good['good_name'] ?>.jpg" alt="<?= $good['good_name'] ?>">
            <div class="card-body">
                <h5 class="card-title"><?= $good['good_name'] ?></h5>
                <p class="card-text"><?= $good['good_description'] ?></p>
                <p class="card-text">Цена : <?= $good['good_price'] ?> руб</p>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modal_<?= $good['id_good'] ?>" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <img src="/public/img/full/<?= $good['good_name'] ?>.jpg" alt="<?= $good['name'] ?>"
                         class="modal-body">
                    <p class="text-center"><?= $good['good_name'] ?></p>
                    <p class="text-center"><?= $good['good_description'] ?></p>
                    <p class="text-center">Цена : <?= $good['good_price'] ?> руб</p>
                    <form method="post" class="d-flex justify-content-center p-2">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button class="btn btn-primary" name="addToCart" value="<?= $good['id_good'] ?>">Добавить в
                                корзину<iclass="fas fa-plus"></i></button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">&times;
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>

