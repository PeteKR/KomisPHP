 
<?php  
require_once 'config/config.php';
session_start();  
try  
{  
	if(isset($_POST["btn_login"]))  
	{  
		if(empty($_POST["username"]) || empty($_POST["password"]))  
		{  
			$message = 'Błąd. Wypełnił obydwa pola.';  
		}  
		else  
		{  
			$query = "SELECT * FROM users WHERE username = :username AND password = :password";  
			$result = $con->prepare($query);  
			$result->execute(array('username'=>$_POST["username"],'password'=>$_POST["password"]));  
			$count = $result->rowCount();  
			if($count > 0)  
			{  
				$_SESSION["username"] = $_POST["username"];  
				if($_SESSION["username"]!="admin"){
					header("location:index.php");  
				}else{
					header("location:menu.php");}
			}  
			else  
			{  
				$message = 'Podane dane są nieprawidłowe.';  
			}  
		}  
	}  
}  
catch(PDOException $error)  
{  
    $message = $error->getMessage();  
}  
 ?> 
<!DOCTYPE HTML>
<html>

<head>
<title>Logowanie</title>
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
	
    <div id="site_content" class="login">
	  </br>
		<?php if(isset($message)){echo '<h3>'.$message.'</h3>';}  ?>  
		<form method="post">  
			<h1>Logowanie</h1>
			<input type="text" name="username" placeholder="Nazwa użytkownika" />  </br>
			<input type="password" name="password" placeholder="Hasło"/> </br>
			<input type="submit" name="btn_login" value="Zaloguj" />  
		</form>  
		</br>
		Nie masz konta? <a href="register.php">Zarejestruj się</a>
    </div>
    <div id="footer">
		<?php include 'footer.php';?>
    </div>
  </div>
</body>
</html>


