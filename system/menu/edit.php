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

$make="";
$model="";
$year="";
$mileage="";
$fuel="";
$transmission="";
$power="";
$liters="";
$price="";
$extra="";
$photo="";

if(isset($_POST["btnsubmit"])){
if(Validate_DB2($_POST['rok'],$_POST['przebieg'],$_POST['paliwo'],$_POST['skrzynia'],$_POST['moc'],$_POST['litry'],$_POST['cena'])==false){
	$message='<h2>'.Validate_DB($_POST['rok'],$_POST['przebieg'],$_POST['paliwo'],$_POST['skrzynia'],$_POST['moc'],$_POST['litry'],$_POST['cena']).'</h2>';
}
else{
	try{
		$query = $con->prepare("UPDATE `stock` SET `make`=:make,`model`=:model,`year`=:year
			,`mileage`=:mileage,`fuel`=:fuel,`transmission`=:transmission,`power`=:power
			,`liters`=:liters,`price`=:price,`extra`=:extra,`photo`=:photo WHERE `id`=:id");
		$query->execute(array('make' => $_POST['marka'],'model' => $_POST['model'],'year' => $_POST['rok'],
							'mileage' => $_POST['przebieg'],'fuel' => $_POST['paliwo'],'transmission' => $_POST['skrzynia'],
								'power' => $_POST['moc'],'liters' => $_POST['litry'],'price' => $_POST['cena'],
									'extra' => $_POST['extra'],'photo' => $_POST['fotka'],'id'=>$_POST['id_num']));
		$message = '<h2>Pomyslnie edytowano rekord.</h2>';
	} 
	catch(PDOException $error)  
		{  
			//$message = $error->getMessage();  
			$message = "<h3>Błąd.</h3>";
		}  
}
}
$result = $con->query("SELECT  * FROM `stock` ORDER BY id asc");//pdo

?>
<!DOCTYPE HTML>


<html>

<head>
<title>Edytuj pojazd</title>
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
		<form method="post" action="">
			Numer oferty:
			<select name="taskOption" onchange="this.form.submit()">
			<option value="" disabled selected>Wybierz auto do edycji</option>
            <?php while($row1 = $result->fetch()):;?>
            <option value="<?php echo $row1[0];?>"><?php echo $row1[0].". ".$row1[1]." ".$row1[2];?></option>
            <?php endwhile;?>

        </select>
		</br>
		</br>
			
		</form>
		
		<?php
		   if(isset($_POST["taskOption"])){
				$selectOption = $_POST['taskOption'];
				$result = $con->query("SELECT * FROM `stock` WHERE id='$selectOption'");//pdo
				//$query="SELECT * FROM `stock` WHERE id='$selectOption'";
				//$result=mysqli_query($con, $query);
				while ($row = $result->fetch()) {
                    $make=$row['make'];
                    $model=$row['model'];
                    $year=$row['year'];
                    $mileage=$row['mileage'];
                    $fuel=$row['fuel'];
                    $transmission=$row['transmission'];
                    $power=$row['power'];
                    $liters=$row['liters'];
                    $price=$row['price'];
                    $extra=$row['extra'];
                    $photo=$row['photo'];
                }
			}
		?>
		
		<form method="post" action="">
		<fieldset class="pure-group">
		<table><h2>Dane pojazdu:</h2>
			
			<input type="hidden" name="id_num" value="<?php echo $selectOption; ?>">
			<tr><td><label>    </label>
			<input name="marka" type="text" placeholder="Marka" required value="<?php echo $make;?>"></td>
			
			<td><label>    </label>
			<input name="model" type="text" placeholder="Model" required value="<?php echo $model;?>"></td></tr>
			
			<tr><td><label>    </label>
			<input name="rok" type="number" placeholder="Rok produkcji" required value="<?php echo $year;?>"></td>
			
			<td><label>    </label>
			<input name="przebieg" type="number" placeholder="Przebieg" value="<?php echo $mileage;?>"></td></tr>
			
			<tr><td><label>    </label>
			<input name="paliwo" type="text" placeholder="Rodzaj paliwa" required value="<?php echo $fuel;?>"></td>
			
			<td><label>    </label>
			<input name="skrzynia" type="text" placeholder="Skrzynia biegów" required value="<?php echo $transmission;?>"></td></tr>
			
			<tr><td><label>    </label>
			<input name="moc" type="number" placeholder="Moc silnika" value="<?php echo $power;?>"></td>
			
			<td><label>     </label>
			<input name="litry" type="number" step="0.1" placeholder="Pojemność silnika" required value="<?php echo $liters;?>"></tr></td></table>
			
			<label>    </label>
			<input name="cena" type="number" placeholder="Cena w złotówkach" required value="<?php echo $price;?>">
			
			<label for="extra">    </label>
			<textarea name="extra" rows="10"
			placeholder="Dodatkowe informacje, uszkodzania, uwagi"><?php echo $extra ?></textarea><br>
			</fieldset>
			<td><input name="fotka" type="text" placeholder="Zmień ścieżkę wyświetlanego zdjęcia" required value="<?php echo $photo;?>"></td>
			
			<input type="submit" name="btnsubmit" value="Zapisz";  />
			</form>
			
    </div>
    <div id="footer">
		<?php include '../footer.php';?>
    </div>
  </div>
</body>
</html>
