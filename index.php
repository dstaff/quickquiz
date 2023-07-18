<?php

require_once 'dbconfig.php';

$f3->route('GET /', 'getQuestions');

function getQuestions()
{
    //$query = "SELECT MIN(id) AS minimo,MAX(id) AS maximo FROM questions";

    $query = "SELECT * FROM questions";

    // Prepare and execute the query
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    // Fetch all books from the result set
    $questions = $stmt->fetchAll();

    // Return the books as JSON response
    echo json_encode($questions);
}