<?Php
$dbhost_name = "localhost"; //  host  
$database = "bazakomis";       //  db name
$username = "root";            // login  
$password = "";            // password 

try {
$con = new PDO('mysql:host='.$dbhost_name.';dbname='.$database, $username, $password);
$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
print "Error!: " . $e->getMessage() . "<br/>";
die();
}
?> 

