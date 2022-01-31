<?php
require 'config/config.php'; 
session_start();
if(isset($_SESSION["username"]))  
{  
}  
else  
{  
	header("location:login.php");  
} 


if(isset($_POST['but_logout'])){
    session_destroy();
    header('Location: index.php');
}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Lista pojazdów</title>
	<meta name="keywords" content="website keywords, website keywords" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" type="text/css" href="style/style.css" title="style" />
</head>

<body>

<div id="main">
    <div id="header">
      <div id="logo">
		<a href="index.php"><img src="logox.gif"></a>
        <div id="logo_text">
        </div>
      </div>
      <div id="menubar">
        <ul id="menu">
          <li><a href="index.php">O firmie</a></li>
          <li><a href="form.php">Formularz sprzedaży</a></li>
          <li><a href="stock.php">Nasza oferta</a></li>
          <li class="selected"><a href="auction-list.php">Aukcje</a></li>
          <li><a href="contact.php">Kontakt</a></li>
        </ul>
      </div>
    </div>
	
    <div id="site_content">
	<form method='post' action="">
			<input type="submit" value="Wyloguj" name="but_logout">
        </form>
		</br>
		<?Php
			echo "Wszystkie aukcje.";
			$result = $con->query("SELECT id, make, model, year, photo FROM auctions");	

			echo "<table id='tableA' border='1'>
			<tr>
			<th>Numer oferty</th>
			<th>Zdjęcie</th>
			<th>Marka</th>
			<th>Model</th>
			<th>Rok produkcji</th>
			</tr>";

			while ($row = $result->fetch()) //PDO
			{
			echo "<tr>";
			echo "<td width=20px><a href=auction-item.php?id=". $row['id'] .">" . $row['id'] . "</td>";
			if(strlen($row['photo'])>0 && is_file($row['photo'])){
				echo "<td><a href=auction-item.php?id=". $row['id'] ."><img src=".$row['photo']." width=130 height=80/></td>";
			}
			else{
				echo "<td><a href=auction-item.php?id=". $row['id'] ."><img src=Photos/Error.jpg width=130 height=80/></td>";
			}
			echo "<td><a href=auction-item.php?id=". $row['id'] .">" . $row['make'] . "</td>";
			echo "<td><a href=auction-item.php?id=". $row['id'] .">" . $row['model'] . "</td>";
			echo "<td><a href=auction-item.php?id=". $row['id'] .">" . $row['year'] . "</td>";
			echo "</tr>";
			}
			echo "</table>";

		?>
    </div>
    <div id="footer">
		<?php include 'footer.php';?>
    </div>
  </div>
</body>
</html>
