# [:house: Feni Batch Home Page](http://poloey.github.io/feni)

# Class 22 

# CRUD in PHP MYSQL

Here is the basic tutorial how to do crud in mysqli and pdo.   

* first create a database name crud.
~~~sql
CREATE DATABASE crud;
~~~
* select crud database. 
~~~sql 
USE crud;
~~~

* Create a people table with name and email field

~~~sql
CREATE TABLE people (
    id INT(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL
);
~~~


## CRUD using Mysqli   

* Connect php with mysql through `mysqli_connect` function

~~~php
$host = 'localhost';
$dbname = 'crud';
$user = 'root';
$password = '';

$conn = mysqli_connect($host, $user, $password, $dbname);
~~~

* Check connection successful or not
~~~php
if ($conn->connect_errno) {
  echo 'not connected';
}else {
  echo 'connect successfully';  
}
~~~

* Insert a row in database (C)
~~~php
 $conn->query( "INSERT INTO people(name, email) VALUES ('polo', 'polo@gmail.com')" ) 
~~~

* Read from database (R)
~~~php
$results = $conn->query('SELECT * FROM people');
while($row = $results->fetch_assoc()) {
  echo $row['name'] . " " . $row['email'] . '<br/>';
}
~~~

* Update Database (U)
~~~php
 $conn->query( "UPDATE PEOPLE SET name='vasanth', email='vasanth@gmail.com' WHERE id=3" ) 
~~~

* Delete Database (D)
~~~php
 $conn->query( "DELETE FROM people WHERE id=3" ) 
~~~

## CRUD using PDO   
CRUD using PDO actully best practice for php crud. This is because PDO is database agnostic. I mean you can use any database whether its mysql, postgresql or oracle. 


* Connect php with mysql through pdo instantiation and check whether pdo connection successful or not using by writing pdo instantiation inside `try catch` block;

~~~php
$server = 'localhost';
$user = 'root';
$password = '';
$dbname = 'crud';
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_PERSISTENT => false,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
];

//connection 

try {
  $conn = new PDO("mysql:dbname=$dbname;host=$server", $user, $password, $options);
  echo 'connection successful';
} catch (PDOExceptions $e) {
  echo $e->getMessage();
}
~~~
here PDO took 4 arguments. dsn, username, password, options. dsn means data souce name. in our case dsn is

~~~php
"mysql:dbname=$dbname;host=$server"
~~~
In dsn first we mention which driver we will use. In our case we use `mysql`. then put a `:` and give `dbname` and `host` name. 


* Insert a row in database using direct sql query (C)
~~~php
$conn->query("INSERT INTO people (name, email) VALUES('polo', 'polo@gmail.com')");
~~~

* Insert a row using prepare method in database (C)
~~~php
$name = 'polo';
$email  = 'polo@gmail.com';
$statement = $conn->prepare("INSERT INTO people (name, email) VALUES(:name, :email)");
$statement->execute([':name' => $name, ':email' => $email]);
~~~
So from state above we understand we can insert data into  database using direct sql query or prepare statement. We always use prepare statement. Since its more flexible when we work with variable data. In real work we will insert data with variable data. Beside this we can sanitize data when execute function call.

* Read from database (R)
~~~php
$statement = $conn->prepare( "SELECT * FROM people" );
$statement->execute();
while($row = $statement->fetch()) {
  echo '<b>Name:</b>: ' . $row->name . " <b>Email:</b> " . $row->email . '<br/>';
  echo '<br/>';
}
~~~

* Update Database (U)
~~~php
$name = 'vasanth';
$email  = 'vasanth@gmail.com';
$id = 1;
$statement = $conn->prepare("UPDATE people SET name=:name, email=:email WHERE id=:id");
$statement->execute([':name' => $name, ':email' => $email, ':id' => $id]);
~~~

* Delete Database (D)
~~~php
$statement = $conn->prepare("DELETE FROM people WHERE id=:id");
$statement->execute([':id'=> 28]);
~~~

Thats all. Hope Now you will be able to do crud operation using `mysqli` or `PDO` in `php`.
