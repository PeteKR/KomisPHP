<?php
session_start();
include "../config/config.php"; 
if(isset($_SESSION["username"]))  
{  
}  
else  
{  
	header("location:../login.php");  
}  
include "../config/validate.php";
$message = '';
if(isset($_POST["btnsubmit"])){

	if(Validate_DB2($_POST['rok'],$_POST['przebieg'],$_POST['paliwo'],$_POST['skrzynia'],$_POST['moc'],$_POST['litry'],$_POST['cena'])==false){
		$message='<h2>'.Validate_DB($_POST['rok'],$_POST['przebieg'],$_POST['paliwo'],$_POST['skrzynia'],$_POST['moc'],$_POST['litry'],$_POST['cena']).'</h2>';
	}
	else{
		try{
		$result=$con->prepare("INSERT INTO stock (make,model,year,mileage,fuel,transmission,power,liters,price,extra) 
							VALUES (:make,:model,:year,:mileage,:fuel,:transmission,:power,:liters,:price,:extra)");
		$result->execute(array('make' => $_POST["marka"],'model' => $_POST["model"],
							'year' => $_POST["rok"],'mileage' => $_POST["przebieg"],'fuel' => $_POST["paliwo"],
							'transmission' => $_POST["skrzynia"],'power' => $_POST["moc"],'liters' => $_POST["litry"],
							'price' => $_POST["cena"],'extra' => $_POST["extra"]));
		$last_id = $con->lastInsertId();
		 
		if (!file_exists('../Photos/'.$last_id)) {
			mkdir('../Photos/'.$last_id, 0777, true);
		}

		$countfiles = count($_FILES['file']['name']);
		for($i=0;$i<$countfiles;$i++){
		    $photo = $_FILES['file']['name'][$i];
		    move_uploaded_file($_FILES['file']['tmp_name'][$i],'../Photos/'.$last_id.'/'.$photo);
			if($i==0){
			$photo='Photos/'.$last_id.'/'.$photo;
			$query = $con->prepare('UPDATE `stock` SET `photo`=:photo WHERE id=:id;');
			$query->execute(array('photo' => $photo,'id' => $last_id));
			}
		}
		$message = '<h2>Pomyslnie dodano do bazy.</h2>';
		} 
		catch(PDOException $error)  
		{  
			//$message = $error->getMessage();  
			$message = "<h3>Błąd.</h3>";
		}  
	}
}
?>
<!DOCTYPE HTML>


<html>

<head>
<title>Dodaj pojazd</title>
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
		<form method="post" enctype="multipart/form-data">
		<fieldset class="pure-group">
			<table><h2>Dane pojazdu:</h2>
			
			<tr><td><label>    </label>
			<input name="marka" type="text" placeholder="Marka" required  /></td>
			
			<td><label>    </label>
			<input name="model" type="text" placeholder="Model" required /></td></tr>
			
			<tr><td><label>    </label>
			<input name="rok" type="number" placeholder="Rok produkcji" required /></td>
								
			<td><label>    </label>
			<input name="przebieg" type="number" placeholder="Przebieg" /></td></tr>
			
			<tr><td><label>    </label>
			<input name="paliwo" type="text" placeholder="Rodzaj paliwa"  required /></td>
			
			<td><label>    </label>
			<input name="skrzynia" type="text" placeholder="Skrzynia biegów" required /></td></tr>
			
			<tr><td><label>    </label>
			<input name="moc" type="number" placeholder="Moc silnika" /></td>
			
			<td><label>     </label>
			<input name="litry" type="number"  step="0.1" placeholder="Pojemność silnika" required /></tr></td></table>
			
			<label>    </label>
			<input name="cena" type="number" placeholder="Cena" required />
			
			<label for="extra">    </label>
			<textarea name="extra" rows="10"
			placeholder="Dodatkowe informacje, uszkodzania, uwagi"></textarea><br>
			
			<label><b>Dodaj zdjęcia auta</b></label>
			<input type="file" name="file[]" multiple="multiple" accept=".jpg,.jpeg, .gif, .png, .bmp" /></td>
			</fieldset>

			<input type="submit" name="btnsubmit" value="Dodaj do bazy";  />
			</form>

    </div>
    <div id="footer">
		<?php include '../footer.php';?>
    </div>
  </div>
</body>
</html>

