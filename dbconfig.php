<?php
// * wont work in FF w/ Allow-Credentials
//if you dont need Allow-Credentials, * seems to work
header('Access-Control-Allow-Origin: https://dstaff.github.io');
//if you need cookies or login etc
//header('Access-Control-Allow-Credentials: true');

header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Max-Age: 604800');
//if you need special headers
header('Access-Control-Allow-Headers: x-requested-with');
//exit(0);


require '../f3/vendor/autoload.php';

$f3 = Base::instance();
//$f3->copy('HEADERS.Origin','*');

$config = parse_ini_file('config.ini', true);

//header('Access-Control-Allow-Origin: *');
//header("Access-Control-Allow-Headers: *");
//header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');

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
