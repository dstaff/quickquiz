<?php
header('Access-Control-Allow-Origin: *');

require_once 'dbconfig.php';

$f3->route('GET /', 'getQuestions');

function getQuestions()
{
    $pdo = $GLOBALS['pdo'];
    $query = "SELECT MIN(id) AS minimo,MAX(id) AS maximo FROM questions";
    // Prepare and execute the query
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    // Fetch all books from the result set
    $minmax = $stmt->fetch();

    $minimo = $minmax["minimo"];
    $maximo = $minmax["maximo"];

    $random_id = rand($minimo,$maximo);

    // Query to retrieve the book with the given ID
    $queryq = 'SELECT * FROM questions WHERE id = :id';

    // Prepare and execute the query with the ID as a parameter
    $stmtq = $pdo->prepare($queryq);
    $stmtq->bindValue(':id', $random_id, PDO::PARAM_INT);
    $stmtq->execute();

    // Fetch the book from the result set
    $question = $stmtq->fetch();

    // Return the books as JSON response
    echo json_encode($question);
}

$f3->run();