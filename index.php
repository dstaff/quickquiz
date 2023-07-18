<?php
header('Access-Control-Allow-Origin: *');
echo "x1";
require_once 'dbconfig.php';
echo "x2";
$f3->route('GET /quickquiz', 'getQuestions');
echo "x3";
function getQuestions()
{
    //$query = "SELECT MIN(id) AS minimo,MAX(id) AS maximo FROM questions";
    echo "x4";
    $query = "SELECT * FROM questions";
    echo "x5";
    // Prepare and execute the query
    $stmt = $pdo->prepare($query);
    echo "x6";
    $stmt->execute();
    echo "x7";
    // Fetch all books from the result set
    $questions = $stmt->fetchAll();
    echo "x8";
    // Return the books as JSON response
    echo json_encode($questions);
    echo "x9";
}