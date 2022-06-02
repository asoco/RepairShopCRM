<!DOCTYPE html>
<html lang="ru">
<?php if (empty($_COOKIE['login']) || empty($_COOKIE['role'])) {
    header('Location: login.php');
} 
$login = $_COOKIE['login'];
include_once('database.php');
$result = $mysql->query("SELECT * FROM `users` WHERE `login`='$login'");
$user = $result->fetch_assoc();
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Панель управления</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/sidebar-themes.css">
    <link rel="shortcut icon" type="image/png" href="img/favicon.png" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.maskedinput.min.js"></script>
</head>

<body>
    <style>
    .dark-mode {
        background: #222 !important;
        color: #DDD !important;
        border-color: #777 !important;
        /*transition: .3s ease-in-out;*/
    }
    .navbar,input,textarea,select,.navbar-brand ,.nav-link, .card ,.input-group-prepend,.btn,.input-group-text,th, td, hr, .darktheme{
         transition: .3s ease-in-out;
    }
    </style>
    <div class="darktheme">
        <?php include 'header.php';?>
        <?php 
            
            if (!isset($_GET['page'])){
            include('php/main.php');
            }else{
                if (file_exists('php/'.$_GET['page'].'.php')) {
                include('php/'.$_GET['page'].'.php');
                } else {
                    include('php/404.php');
                }
            }            
        ?>
    </div>
    <script>
     $(function() {
         $("#toggle-dark").click(function() {
             $('.navbar,input,textarea,select,.navbar-brand ,.nav-link, .card ,.input-group-prepend,.btn,.input-group-text,th, td, hr, .darktheme').toggleClass("dark-mode");
         });
     });
    </script>
</body>

</html>