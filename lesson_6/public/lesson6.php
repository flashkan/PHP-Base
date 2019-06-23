<div class="container d-flex flex-column align-items-center">
    <form method="get" class="d-flex justify-content-center">
        <input type="number" name="first-number">
        <select name="operation">
            <option value="+">сложение</option>
            <option value="-">вычитание</option>
            <option value="*">умножение</option>
            <option value="/">деление</option>
        </select>
        <input type="number" name="second-number">
        <button type="submit">Посчитать</button>
    </form>
    <p>Результат : <?= $calcResult ?></p>
</div>

<div class="container d-flex flex-column align-items-center">
    <form method="get" class="d-flex justify-content-center">
        <input type="number" name="first-number">
        <input type="submit" name="operation" value="+">
        <input type="submit" name="operation" value="-">
        <input type="submit" name="operation" value="*">
        <input type="submit" name="operation" value="/">
        <input type="number" name="second-number">
    </form>
    <p>Результат : <?= $calcResult ?></p>
</div>

<div class="row" style="margin-bottom: 50px;">
    <?php foreach ($employee as $good) : ?>
        <div class="col-3 d-flex flex-column" data-toggle="modal" data-target="#modal_<?= $good['id_good'] ?>"
             style="outline: 1px solid #ccc">
            <img class="img" src="/public/img/low/<?= $good['good_name'] ?>.jpg" alt="<?= $good['good_name'] ?>"
                 >
            <p style="text-align: center;"><?= $good['good_name'] ?></p>
            <p style="text-align: center;"><?= $good['good_description'] ?></p>
            <p style="text-align: center;"><?= $good['good_price'] ?> руб</p>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modal_<?= $good['id_good'] ?>" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><?= $good['good_name'] ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <img src="/public/img/full/<?= $good['good_name'] ?>.jpg" alt="<?= $good['name'] ?>"
                         class="modal-body">
                    <p style="text-align: center;"><?= $good['good_name'] ?></p>
                    <p style="text-align: center;"><?= $good['good_description'] ?></p>
                    <p style="text-align: center;"><?= $good['good_price'] ?> руб</p>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>

<div>
    <form method="get" class="d-flex flex-column align-items-center" style="margin-bottom: 50px;">
        <label>
            Ваше имя :
            <input type="text" name="feedback_user">
        </label>
        <label>
            Ваш отзыв :
            <textarea name="feedback_body"></textarea>
        </label>
        <button type="submit">Отправить отзыв</button>
    </form>
    <?php foreach ($feedbacks as $feedback) : ?>
    <div style="border: 2px solid #aaa" >
        <p style="text-align: center">Пользователь : <?= $feedback['feedback_user'] ?></p>
        <p style="text-align: center"><?= $feedback['feedback_body'] ?></p>
    </div>

    <?php endforeach ?>
</div>