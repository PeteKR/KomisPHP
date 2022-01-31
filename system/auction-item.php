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
$message="";
$get_Id="";
$price="";
$time_remaining="";
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'){ 
	$url = "https://";}
else{
	$url = "http://";}
$url.= $_SERVER['HTTP_HOST'];   
$url.= $_SERVER['REQUEST_URI'];    
$get_Id = substr($url, strpos($url, "=") + 1);

if(isset($_POST["btnsubmit"])){
	if($_POST['cena']>$_POST['cena_hidden']){
		$result = $con->prepare("SELECT username FROM auctions WHERE id=:id");
		$result->execute(array('id'=>$get_Id));
		$row = $result->fetch(PDO::FETCH_ASSOC);
		$row=implode("",$row);
		$get_last_user = substr($row, strrpos($row, ';') + 1);
		if($get_last_user!=$_SESSION["username"]){
			$message="</br><h3>Twoja oferta jest pierwsza.</h3></br>";
			$new_Usr=$row.';'.$_SESSION["username"];
			$query = $con->prepare("UPDATE `auctions` SET `price`=:price,`username`=:username WHERE `id`=:id");
			$query->execute(array('price' => $_POST['cena'],'username'=>$new_Usr,'id'=>$get_Id));
		}
		else{
			$message="</br><h3>Nie możesz licytować samego siebie.</h3></br>";
		}
	}
	else{
		$message="</br><h3>Wprowadzaona wartość jest niższa niż obecna oferta.</h3></br>";
	}
}

?>
<!DOCTYPE HTML>
<html>

<head>
<title>Oferta</title>
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
	<?php echo $message; ?>
	  </br>
		<div id="photogallery">
			<?php  
			
			$result = $con->query("SELECT * FROM auctions WHERE id='$get_Id'");	

			while($row = $result->fetch())
			{
			echo "Numer oferty: " . $row['id'] . "</br>";
			echo "Marka: " . $row['make'] . "</br>";
			echo "Model: " . $row['model'] . "</br>";
			echo "Rok produkcji: " . $row['year'] . "</br>";
			echo "Przebieg w kilometrach: " . $row['mileage'] . "</br>";
			echo "Rodzaj paliwa: " . $row['fuel'] . "</br>";
			echo "Skrzynia biegów: " . $row['transmission'] . "</br>";
			echo "Moc [KM]: " . $row['power'] . "</br>";
			echo "Litry: " . $row['liters'] . "</br>";
			echo "Dodatkowe informacje: " . $row['extra'] . "</br></br>";
			$price=$row['price'];
			$time_remaining=$row['end_date'];
			}
			
			echo "</br>Dostępne zdjęcia pojazdu: </br>";
			$id_folderu=strval($get_Id);
			$folder_path = 'Photos/auctions/'.$id_folderu.'/';
			$num_files = glob($folder_path . "*.{JPG,jpg,gif,png,bmp}", GLOB_BRACE);
			$folder = opendir($folder_path);
			
			if($num_files > 0){
			while(false !== ($file = readdir($folder))) 
			{
				$file_path = $folder_path.$file;
				$extension = strtolower(pathinfo($file ,PATHINFO_EXTENSION));
				if($extension=='jpg' || $extension =='png' || $extension == 'gif' || $extension == 'bmp'){
					?><a href="<?php echo $file_path; ?>"><img src="<?php echo $file_path; ?>"  height="120"/></a><?php
				}
			}
		}
		closedir($folder);
		?>
		</div>
		</br>
		<form method="post" action="">
			<h3>Czas do zakończenia: 
			<?php 
			$now = new DateTime();
			$now=$now->format('Y-m-d H:i:s');
			$time = strtotime($time_remaining);
			$myFormatForView = date('Y-m-d H:i:s', $time);
			if($now<$time_remaining){
				$time_remaining = new DateTime($time_remaining);
				$time_remaining = $time_remaining->diff(new DateTime());
				echo $time_remaining->format("%a dni, %h godziny, %i minuty");
			}
			else{
				echo "Licytacja zakończona ".$time_remaining;
			}
			?></h3>
			<h3>Obecna cena w zł:</h3>
			<input name="cena_hidden" type="hidden" value="<?php echo $price;?>"></br>
			<input name="cena" id="cena_style" type="number" placeholder="Twoja oferta." required value="<?php echo $price;?>"></br>
			<input type="submit" 
			<?php $now = new DateTime();
				if($now>$time_remaining){echo "disabled";}?> name="btnsubmit" value="Licytuj";  />
		</form>
		
	  </br>
    </div>
    <div id="footer">
		<?php include 'footer.php';?>
    </div>
  </div>
</body>
</html>

