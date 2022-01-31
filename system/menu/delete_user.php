<?php

session_start();

include "../config/config.php";
include "../config/validate.php";
$message = '';  
if(isset($_SESSION["username"])&&($_SESSION["username"]=="admin"))  
{  
}  
else  
{  
	header("location:../login.php");  
}  

if(isset($_POST["btnsubmit"])){
	$selectOption = $_POST['taskOption'];
	try{
		$query = $con->prepare("DELETE FROM `users` WHERE id=:id");
		$query->execute(array('id'=>$selectOption));
		$message = '<h2>Pomyslnie usunięto rekord.</h2>';
	} 
	catch (Exception $e) {
		$message = '<h2>Błąd.</h2>';
	}
}


$result1 = $con->query("SELECT id,username FROM `users` where id between 2 AND 9999999 ORDER BY id asc");//pdo
?>
<!DOCTYPE HTML>
<html>

<head>
<title>Usuń pojazd</title>
	<meta name="keywords" content="website keywords, website keywords" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" type="text/css" href="../style/style.css" title="style" />
</head>

<body>

<div id="main">
    <div id="header">
      <div id="logo">
		<a href="../index.php"><img src="../logox.gif"></a>
        <div id="logo_text">
        </div>
      </div>
      <div id="menubar">
        <ul id="menu">
          <li><a href="../index.php">O firmie</a></li>
          <li><a href="../form.php">Formularz sprzedaży</a></li>
          <li><a href="../stock.php">Nasza oferta</a></li>
		  <li><a href="../auction-list.php">Aukcje</a></li>
          <li><a href="../contact.php">Kontakt</a></li>
        </ul>
      </div>
    </div>
	
    <div id="site_content">
		</br>
	    <?php print_r($message); ?>
	    <form method="post">
			ID użytkownika:
			<select name="taskOption">
            <?php while($row1 = $result1->fetch()){
				echo "<option value=".$row1[0].">$row1[0]. $row1[1]</option>";
			};?>
        </select>
		</br>
		</br>
			<input type="submit" name="btnsubmit" value="Usuń wybranego użytkownika.">
		</form>
    </div>

    <div id="footer">
		
		<?php include '../footer.php';?>
    </div>
  </div>
</body>
</html>
