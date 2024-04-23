<?php

namespace Shortifyer\Router;

use Shortifyer\Database\Db;

class Router {
    
    public static function login($params = false) {
        if (($params == false) && !isset($_SESSION['login'])) {
            require(__DIR__.'/../Views/Login.php');
        } else {
            if (!isset($_SESSION['login'])) {
                $db = Db::getDb();
                $loginPattern = '/^[A-Za-z0-9_-]+$/i';
	            $params['login'] = (preg_match($loginPattern, $params['login'])) ? $params['login'] : null ;
                $result = $db->query("select `id`, `login` from users where login='".$params['login']. "' and password='".md5($params['password'])."'");
                if ($result->num_rows) {
                    $_SESSION['user_id'] = $result->fetch_assoc()['id'];
                    $_SESSION['login'] = $params['login'];
                    header('Location: /links');
                } else {
                    require(__DIR__.'/../Views/Login.php');
                }               
            }
            
        }
    }

    public static function links($data = false) {
        $db = Db::getDb();
        if (!isset($_SESSION['login'])) {
            header('Location: /');
        } else {
            if (isset($data['link'])) {
                $short_link = substr(md5($data['link'].$_SESSION['login']), 0, 10);
                $db->query("insert into links (`link`, `short_link`, `user_id`) values ('".$data['link']."', '".$short_link."', '".$_SESSION['user_id']."')");
                header('Location: /links');
            } else {
                $links = $db->query("select l.link, l.short_link, l.counter, l.user_id from links as l
                left join users as u 
                on u.id = l.user_id
                where u.login = '".$_SESSION['login']."'");
                require(__DIR__.'/../Views/Links.php');
            }
        }
    }

    public static function register($params = false) {
        if (isset($_SESSION['login'])) {
            self::links();
        } else {
            if ($params == false) {
                require(__DIR__.'/../Views/Register.php');
            } else {
                if ($params['password'] !== $params['confirm_password']) {
                    require(__DIR__.'/../Views/Register.php');
                } else {
                    $loginPattern = '/^[A-Za-z0-9_-]+$/i';
	                $params['login'] = (preg_match($loginPattern, $params['login'])) ? $params['login'] : null ;
                    $db = Db::getDb();
                    $user = $db->query("select id from users where login='".$params['login']."'");
                    if (!$user->num_rows) {
                        $db->query("insert into users (`login`, `password`) values ('".$params['login']."', '".md5($params['password'])."')");
                        $_SESSION['login'] = $params['login'];
                        self::links();
                    } else {
                        self::register(false);
                    }
                }
            }
        }
    }

    public static function logout() {
        session_destroy();
        $_SESSION = array();
        header('Location: /');
    }

    public static function getLink($link) {
        $db = Db::getDb();
        $link = str_replace("/", "", $link);
        $result = $db->query("update links set `counter` = `counter` + 1 where short_link='".$link."'");
        if ($result) {
            $link = $db->query("select link from links where short_link='".$link."'");
            header('Location: '.$link->fetch_assoc()['link']);
        }
    }

    public static function route($url, ...$params) {
        match ($url) {
            '/' => self::login($params[0]),
            '/links' => self::links($params[0]),
            '/logout' => self::logout(),
            '/register' => self::register($params[0]),
            default => self::getLink($url),
        };
    }
}