<?php
$dsn = "mysql:host=localhost;dbname=company";
$user = 'root';
$password = '';
$options = [
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
];
$connection = new PDO($dsn, $user, $password, $options);

$sql = 'select * from people';
$dbresult = $connection->query($sql);
//var_dump($result->fetch(PDO::FETCH_OBJ));
//var_dump($result->fetchAll(PDO::FETCH_OBJ));
$results = $dbresult->fetchAll();

$sql = "INSERT INTO people (name, email) VALUES ('Golam sarwar', 'sarwar@gmail.com')";
$connection->query($sql);

