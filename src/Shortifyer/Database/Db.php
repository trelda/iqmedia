<?php

namespace Shortifyer\Database;

use Exception;

class Db {
    const HOST = '127.0.0.1';
    const USER = 'root';
    const PASS = '';
    const DATABASE = 'shortifyer';

    protected static $mysqli = null;

    private function __construct() {}

    public function __clone() {
        throw new Exception("Can't clone a singleton");
    }

    public function __wakeup() {}

    public static function getDb() {
        if (self::$mysqli === null) {
            self::$mysqli = mysqli_connect(self::HOST, self::USER, self::PASS, self::DATABASE);
            if (!self::$mysqli) {
                throw new Exception(mysqli_connect_error());
            }
            return self::$mysqli;
        } else {
            return self::$mysqli;
        }
    }

    public function query(string $query) {
        if (self::$mysqli === null) {
            self::$mysqli = mysqli_connect(self::HOST, self::USER, self::PASS, self::DATABASE);
        }
        $result = array();
        $query = mysqli_real_escape_string(self::$mysqli, $query);
        $result = self::$mysqli->query($query)->fetch_assoc();
        return $result;
    }
}

?>