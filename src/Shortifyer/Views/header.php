<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="include/css/styles.css">
    <script type="text/javascript" src="include/js/main.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Shortifyer</title>
</head>
<body>
    <?php if (isset($_SESSION['login'])) { ?>
        <a href="/links">Ссылки</a>
    <?php } ?>
    <?php if (!isset($_SESSION['login'])) { ?>
        <a href="/">Вход</a>
    <a href="/register">Регистрация</a>
    <?php } ?>
    <?php if (isset($_SESSION['login'])) { ?>
        <a href="/logout">Выход</a>
    <?php } ?>
