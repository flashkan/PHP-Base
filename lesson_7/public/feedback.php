<div>
    <?php if ($_SESSION['isAuth']) : ?>
    <form method="get" class="input-group justify-content-center mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text">Ваш отзыв :</span>
        </div>
        <textarea name="feedback_body" class="form-control col-4" aria-label="With textarea"></textarea>
        <button class="btn btn-success" type="submit">Отправить отзыв</button>
    </form>
    <?php endif; ?>

    <?php if ($feedbackError) : ?>
    <div class="alert alert-danger d-flex justify-content-center mb-3" role="alert">
        <p class="col-4">Коментарий отзыва должен состоять как минимум из десяти символов!</p>
    </div>
    <?php endif; ?>

    <?php foreach ($feedbacks as $feedback) : ?>
    <div class="border d-flex flex-column align-items-center p-3">
        <p class="text-center">Пользователь : <?= $feedback['feedback_user'] ?></p>
        <p class="text-center"><?= $feedback['feedback_body'] ?></p>
        <?php if ($_SESSION['isAdmin']) : ?>
            <form method="post">
                <button name="delFeedback" value="<?= $feedback['id_feedback'] ?>" class="btn btn-danger">Удалить</button>
            </form>
        <?php endif; ?>
    </div>
    <?php endforeach ?>
</div>
