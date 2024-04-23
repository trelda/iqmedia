<?php
session_start();

use Shortifyer\Database\Db;

if ((isset($_SESSION['user_id'])) && (isset($_SESSION['login']))) {
    require __DIR__ . '/autoloader.php';
    $db = Db::getDb();
    $short_link = substr(md5($_POST['link'].$_SESSION['login']), 0, 10);
    $result = $db->query("insert into links (`link`, `short_link`, `user_id`) values ('".$_POST['link']."', '".$short_link."', '".$_SESSION['user_id']."')");
    if ($result) {
        $response = [
            'link' => $_POST['link'],
            'short_link' => $short_link,
            'counter' => 0,
        ];
        echo json_encode($response);
    }
}