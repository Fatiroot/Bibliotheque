<?php
namespace App\Database;
use Dotenv\Dotenv;
 require_once __DIR__. '/../../vendor/autoload.php';


$dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

class Database {

private static $db;

public static function Connection()
{
    if (self::$db === null) {
        $servername = $_ENV['DB_HOST'];
        $username = $_ENV['DB_USER'];
        $password = $_ENV['DB_PASSWORD'];
        $dbname = $_ENV['DB_NAME'];

        self::$db = mysqli_connect($servername , $username, $password, $dbname);

        if (self::$db->connect_error) {
            die('Erreur de connexion : ' . self::$db->connect_error);
        }
    }

    return self::$db;
}
}
?>