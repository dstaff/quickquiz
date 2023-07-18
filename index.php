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
    $questions = $stmt->fetch();

    echo $questions["maximo"]."\n";
    echo $questions["minimo"];
    // Return the books as JSON response
    //echo json_encode($questions);
}

$f3->run();