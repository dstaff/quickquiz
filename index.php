<?php
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
    $row = $stmtq->fetch();

    $id = $row["id"];
    $question = $row['question'];
    $difficulty = $row['difficulty'];

    $answers = [
        'A' => $row['answer_a'],
        'B' => $row['answer_b'],
        'C' => $row['answer_c'],
        'D' => $row['answer_d']
    ];

    $response = [
        'id' => $id,
        'question' => $question,
        'difficulty' => $difficulty,
        'answers' => $answers
    ];

    //header('Content-Type: application/json');
    // Return the books as JSON response
    echo json_encode($response);
}

$f3->run();