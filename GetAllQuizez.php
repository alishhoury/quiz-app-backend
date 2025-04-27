<?php

include("./connection.php");

try {
    
    $query = $connection->prepare("SELECT * FROM quizez");
    $query->execute();
    $quizez = $query->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($quizez);

}catch (\Throwable $e) {

    echo $e;
}