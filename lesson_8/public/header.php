<!doctype html>
<html lang="en" style="height: 100%">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--    <link rel="stylesheet" href="style/login.css" crossorigin="anonymous">-->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Home</title>
</head>
<body style="height: 100%">
<div class="false-container d-flex flex-column justify-content-between" style="min-height: 100%">
    <div class="container col-12 p-0">
        <?php if ($_SESSION['isAuth']) : ?>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <a class="navbar-brand"
                   href="<?php if ($_SERVER['REQUEST_URI'] !== '/') : ?> / <?php else: ?>#<?php endif; ?>">
                    <i class="fas fa-crown"></i></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item <?php if ($_SERVER['REQUEST_URI'] === '/') : ?> active <?php endif; ?>">
                            <a class="nav-link"
                               href="<?php if ($_SERVER['REQUEST_URI'] !== '/') : ?> / <?php else: ?>#<?php endif; ?>">
                                Главная</span></a>
                        </li>
                        <li class="nav-item

<?php if ($_SERVER['REQUEST_URI'] === '/personal-account.php') : ?> active <?php endif; ?>">
                            <a class="nav-link <?php if ($_SESSION['once']) : ?> disabled <?php endif; ?>"
                               href="<?php if ($_SERVER['REQUEST_URI'] !== '/personal-account.php') : ?>
                               /personal-account.php<?php else: ?>#<?php endif; ?>">Личный кабинет</a>
                        </li>
                        <li class="nav-item <?php if ($_SERVER['REQUEST_URI'] === '/cart.php') : ?> active <?php endif; ?>">
                            <a class="nav-link" href="<?php if ($_SERVER['REQUEST_URI'] !== '/cart.php') : ?> /cart.php
                       <?php else: ?>#<?php endif; ?>">Корзина</a>
                        </li>
                        <li class="nav-item <?php if ($_SERVER['REQUEST_URI'] === '/orders.php') : ?> active <?php endif; ?>">
                            <a class="nav-link" href="<?php if ($_SERVER['REQUEST_URI'] !== '/orders.php') : ?> /orders.php
                       <?php else: ?>#<?php endif; ?>">Заказы</a>
                        </li>
                    </ul>
                    <p class="form-inline my-2 mr-2 my-lg-0 text-light">Вы вошли как&ensp;<strong
                                class="text-success"> <?= $_SESSION['userLog'] ?> </strong></p>
                    <form method="post">
                        <button class="btn btn-outline-danger m-2 my-sm-0" name="logout">Выход</button>
                    </form>
                    <?php if ($isAdmin) : ?>
                        <a href="reg.php" class="btn btn-outline-danger m-2 my-sm-0">
                            Регистрация
                        </a>
                    <?php endif; ?>
                </div>
            </nav>
        <?php else: ?>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand"
               href="<?php if ($_SERVER['REQUEST_URI'] !== '/') : ?> / <?php else: ?>#<?php endif; ?>">
                <i class="fas fa-crown"></i></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item <?php if ($_SERVER['REQUEST_URI'] === '/') : ?> active <?php endif; ?>">
                        <a class="nav-link"
                           href="<?php if ($_SERVER['REQUEST_URI'] !== '/') : ?> / <?php else: ?>#<?php endif; ?>">
                            Главная</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#">Личный кабинет</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link disabled" href="#">Корзина</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#">Заказы</a>
                    </li>
                </ul>
                <?php if ($mainError) : ?>
                    <div class="alert alert-danger mb-0 mr-5 p-2" role="alert">
                        <p class="mb-0"><?= $mainError ?></p>
                    </div>
                <?php endif; ?>
                <form method="post" class="form-inline my-2 my-lg-0">
                    <input name="login" class="form-control mr-sm-2" type="text" placeholder="Логин"
                           aria-label="Search">
                    <input name="password" class="form-control mr-sm-2" type="password" placeholder="Пароль"
                           aria-label="Search">
                    <label class="mr-2 btn btn-outline-success">
                        Запомнить
                        <input class="ml-2" name="rememberMe" type="checkbox">
                    </label>
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Войти</button>
                </form>
                <a href="reg.php" class="btn btn-outline-danger m-2 my-sm-0">
                    Регистрация
                </a>
            </div>
        </nav>
<?php endif; ?>