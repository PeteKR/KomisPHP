<?php
require 'config/config.php'; 
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
          <li class="selected"><a href="stock.php">Nasza oferta</a></li>
		  <li><a href="auction-list.php">Aukcje</a></li>
          <li><a href="contact.php">Kontakt</a></li>
        </ul>
      </div>
    </div>
	
    <div id="site_content">
	  </br>
		<div id="photogallery">
			<?php  
			if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'){ 
				$url = "https://";}
			else{
				$url = "http://";}
			$url.= $_SERVER['HTTP_HOST'];   
			$url.= $_SERVER['REQUEST_URI'];    

			$get_Id = substr($url, strpos($url, "=") + 1);    
			$result = $con->query("SELECT * FROM stock WHERE id='$get_Id'");	

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
			echo "<b>Cena w złotówkach: " . $row['price'] . "<b></br>";
			}
			
			echo "</br>Dostępne zdjęcia pojazdu: </br>";
			$id_folderu=strval($get_Id);
			$folder_path = 'Photos/'.$id_folderu.'/';
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
    </div>
    <div id="footer">
		<?php include 'footer.php';?>
    </div>
  </div>
</body>
</html>

