<?php
header('Access-Control-Allow-Origin: *');

require '../f3/vendor/autoload.php';

$config = parse_ini_file('config.ini', true);

$f3 = Base::instance();

$dbConfig = [
    'host' => $config['database']['host'],
    'database' => $config['database']['dbname'],
    'username' => $config['database']['username'],
    'password' => $config['database']['password'],
    'charset' => 'utf8mb4',
];

$dsn = 'mysql:host=' . $dbConfig['host'] . ';dbname=' . $dbConfig['database'] . ';charset=' . $dbConfig['charset'];

$options = [
	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
	PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	PDO::ATTR_EMULATE_PREPARES => false,
];

try {
	$pdo = new PDO($dsn, $dbConfig['username'], $dbConfig['password'], $options);
	//return $pdo;
	//echo 'Everything its ok!';
} catch (PDOException $e) {
	exit('Database connection failed: ' . $e->getMessage());
}
