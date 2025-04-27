<?php

try{
    $host = "localhost";
    $port = 3306;
    $dbname = "quizapp";
    $username = "root";
    $password = "ali123";

    $connection = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);

}catch (\Throwable $e) {

    echo $e;
}

