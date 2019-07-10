<div class="d-flex justify-content-center align-items-center flex-column">
    <div class="border rounded m-5">
        <div class="modal-header">
            <h5>Регистрация</h5>
        </div>
        <div class="modal-body">
            <form method="post">
                <div class="d-flex align-items-end">
                    <div class="form-group">
                        <label for="inputLogin">Логин</label>
                        <input name="regLogin" type="text" class="form-control" id="inputLogin"
                               placeholder="Логин">
                    </div>
                    <label class="btn btn-outline-success mb-3 ml-5">
                        Запомнить
                        <input class="" name="rememberMe" type="checkbox">
                    </label>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputPassword">Пароль</label>
                        <input name="regPassword" type="password" class="form-control"
                               id="inputPassword"
                               placeholder="Пароль">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword2">Повторите пароль</label>
                        <input name="regPasswordAgain" type="password" class="form-control" id="inputPassword2"
                               placeholder="Повторите пароль">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputName">Имя</label>
                        <input name="regName" type="text" class="form-control" id="inputName"
                               placeholder="Имя">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputEmail">Email</label>
                        <input name="regEmail" type="email" class="form-control" id="inputEmail"
                               placeholder="Email">
                    </div>
                </div>
                <div class="d-flex">
                    <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
                    <?php if ($isAdmin): ?>
                        <label class="btn btn-outline-success mt-1 ml-1">
                            Дать права администратора
                            <input class="" name="getAdmin" type="checkbox">
                        </label>
                    <?php endif; ?>
                </div>

            </form>
        </div>
    </div>
    <?php if ($regError) : ?>
    <div class="alert alert-danger" role="alert">
        <?= $regError ?>
    </div>
    <?php endif; ?>
</div>
