<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Регистрация</title>
</head>
<?PHP 
if (!isset($_GET['success'])) {$_GET['success'] = Null;}

?>

<body class="h-100" style="background:#111;">
    <div class="container h-100 ">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-10 col-md-8 col-lg-6 text-center login-form p-4">
               
                <form action="database.php" method="POST">
                    <input type='hidden' name='action' value='register'>
                    <h1 class="h3 mb-3 font-weight-normal">Регистрация</h1>
                     <?PHP if ($_GET['success']) {
                        print('<div class="alert alert-success" role="alert">Пользователь успешно создан</div>');
                    } elseif ($_GET['success'] != Null)  {
                        print('<div class="alert alert-danger" role="alert">Такой пользователь уже есть</div>');
                    } ?>
                    <input type="text" name="name" class="form-control mb-1 " placeholder="Имя" required autofocus>
                    <input type="text" name="login" class="form-control mb-1 " placeholder="Логин" required autofocus>
                    <input type="password" name="pass" id="inputPassword" class="form-control mb-1 " placeholder="Пароль" required>
                    <select class="form-control mb-1" name="role">
                        <option>Администратор</option>
                        <option>Работник</option>
                        <option>Менеджер</option>
                    </select>
                    <div class="checkbox mb-3">
                    </div>
                    <button class="btn btn-lg btn-dark btn-block" type="submit">Регистрация</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>