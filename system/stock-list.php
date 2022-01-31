<?php
require 'config/config.php'; 
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
          <li class="selected"><a href="stock.php">Nasza oferta</a></li>
		  <li><a href="auction-list.php">Aukcje</a></li>
          <li><a href="contact.php">Kontakt</a></li>
        </ul>
      </div>
    </div>
	
    <div id="site_content">
	</br>
		<?Php
		if(isset($_POST['prodId'])){
			if($_POST['prodId']=='0'){
				$cat=$_POST['cat'];
				$subcat=$_POST['subcat'];
				if(strlen($cat) <= 0 && strlen($subcat) <= 0)
				{
					echo "Wszystkie pojazdy z oferty.";}
				else
				{
				echo "Wyniki dla: $cat $subcat ";}
				echo "<br><br>";
				echo "<a href=stock.php>Wyszukaj ponownie</a>";

				if(strlen($cat) > 0 && strlen($subcat) > 0)
				{
					$result = $con->query("SELECT id, make, model, year, photo FROM stock WHERE make='$cat' AND model='$subcat'");	
				}
				else if(strlen($cat) > 0 && strlen($subcat) <= 0)
				{
					$result = $con->query("SELECT id, make, model, year, photo FROM stock WHERE make='$cat'");	
				}
				else if(strlen($cat) <= 0 && strlen($subcat) > 0)
				{
					$result = $con->query("SELECT id, make, model, year, photo FROM stock WHERE model='$subcat'");	
				}
				else
				{
					$result = $con->query("SELECT id, make, model, year, photo FROM stock");	
				}
			}
			elseif($_POST['prodId']=='1'){
				require_once 'config/stockDB.php';
				
				$result=Get_stock_result($_POST['rok1'],$_POST['rok2'],$_POST['moc1'],$_POST['moc2'],$_POST['litry1'],
											$_POST['litry2'],$_POST['cena1'],$_POST['cena2'],$_POST['pick_fuel'],$_POST['pick_trans']);
				$result = $con->query($result);	
				
			}
			else{	
				echo "Wszystkie pojazdy z oferty.";
				$result = $con->query("SELECT id, make, model, year, photo FROM stock");	
			}
		}
		else
		{
			echo "Wszystkie pojazdy z oferty.";
			$result = $con->query("SELECT id, make, model, year, photo FROM stock");
		}

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
			echo "<td width=20px><a href=stock-item.php?id=". $row['id'] .">" . $row['id'] . "</td>";
			if(strlen($row['photo'])>0 && is_file($row['photo'])){
				echo "<td><a href=stock-item.php?id=". $row['id'] ."><img src=".$row['photo']." width=130 height=80/></td>";
			}
			else{
				echo "<td><a href=stock-item.php?id=". $row['id'] ."><img src=Photos/Error.jpg width=130 height=80/></td>";
			}
			echo "<td><a href=stock-item.php?id=". $row['id'] .">" . $row['make'] . "</td>";
			echo "<td><a href=stock-item.php?id=". $row['id'] .">" . $row['model'] . "</td>";
			echo "<td><a href=stock-item.php?id=". $row['id'] .">" . $row['year'] . "</td>";
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
