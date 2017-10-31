<?php 
require 'config.php';

//update
// $sql = " update people  set name='Golam Sarwar' where id=3";
// $connection->query($sql);

//delete
$sql = "delete from people where id=3";
$connection->query($sql);

 ?>
