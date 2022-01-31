<?php  
session_start();  
if(isset($_SESSION["username"])&&($_SESSION["username"]=="admin"))  
{  
	//echo '<h3>Zalogowano jako - '.$_SESSION["username"].'</h3>';  
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
<title>Menu pracownika</title>
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
		  <li><a href="auction-list.php">Aukcje</a></li>
          <li><a href="contact.php">Kontakt</a></li>
        </ul>
      </div>
    </div>
	
    <div id="site_content">
	  </br>
	  
		<a href="menu/add.php">Oferta - dodaj</a></br></br>
        <a href="menu/edit.php">Oferta - edytuj</a></br></br>
        <a href="menu/delete.php">Oferta - usuń</a></br></br>
		</br>
		<a href="menu/add_auction.php">Aukcje - dodaj</a></br></br>
        <a href="menu/edit_auction.php">Aukcje - edycja</a></br></br>
        <a href="menu/delete_auction.php">Aukcje - usuń</a></br></br>
		</br>
        <a href="menu/delete_user.php">Użytkownik - usuń</a></br></br>
		
		<form method='post' action="">
			<input type="submit" value="Wyloguj" name="but_logout">
        </form>

    </div>
    <div id="footer">
		<?php include 'footer.php';?>
    </div>
  </div>
</body>
</html>
