
<?php foreach ($employee as $img) : ?>
    <img class="img" src="<?= $img['address_to_low'] ?>" alt="<?= $img['name'] ?>" width="24.8%"
         data-toggle="modal" data-target="#modal_<?= $img['id'] ?>">

    <!-- Modal -->
    <div class="modal fade" id="modal_<?= $img['id'] ?>" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Animals (view <?= $img['popularity'] ?>)</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <img src="<?= $img['address_to_full'] ?>" alt="<?= $img['name'] ?>" class="modal-body">
            </div>
        </div>
    </div>

<?php endforeach ?>

<div style="display: flex; flex-direction: column; align-items: center; margin: 100px;">
    <p>Запрос для обновления галереи</p>
    <form method="post">
        <input type="submit" name="btn"/>
    </form>
</div>

