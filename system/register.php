 
<?php  
require_once 'config/config.php';
session_start();  
if(!isset($_SESSION["username"]))  
{  
	try  
	{  
		if(isset($_POST["btn_login"]))  
		{  
			if(empty($_POST["username"]) || empty($_POST["password"]) || empty($_POST["email"]))  
			{  
				$message = 'Błąd. Wypełnił wsszystkie pola.';  
			}  
			else if(strlen($_POST["password"])<8 || strlen($_POST["username"])<3)
			{
				$message = 'Błąd. Hasło lub nazwa użytkownika za krótkie. Min. 3 znaków - nazwa użytkownika. Min. 8 znaków - hasło.';  
			}
			else  
			{  
				$Register=0;
				$result = $con->query("SELECT username,email FROM users");	//pdo
				while ($row = $result->fetch()) //PDO
				{
					if(($_POST["username"])=="admin"){
						$message = 'Niedozwolona nazwa użytkownika.';  
						$Register=1;
					}
					elseif(($row['username'])==($_POST["username"])){
						$message = 'Błąd. Wybierz inną nazwę użytkownika.';  
						$Register=1;
					}
					elseif(($row['email'])==($_POST["email"])){
						$message = 'Błąd. Wprowadź inny adres email.';  
						$Register=1;
					}
				}
				if($Register==0){
					$result = $con->prepare('INSERT INTO `users`(`username`, `password`,`email`,`role`) VALUES (:username, :password, :email,"Klient")');
					$result->execute(array('username' => $_POST["username"],'password' => $_POST["password"],'email' => $_POST["email"]));
					$message = 'Zarejestrowano. Można się zalogować.';  
				}
			}  
		}  
	}  
	catch(PDOException $error)  
	{  
		$message = $error->getMessage();  
	}  
}  
else  
{  
	header("location:index.php");  
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
			<h1>Rejestracja</h1>
			<input type="text" name="username" placeholder="Nazwa użytkownika" />  </br>
			<input type="password" name="password" placeholder="Hasło"/> </br>
			<input type="email" name="email" placeholder="Email"/> </br>
			<input type="submit" name="btn_login" value="Zarejestruj" />  
		</form>  
		</br>
    </div>
    <div id="footer">
		<?php include 'footer.php';?>
    </div>
  </div>
</body>
</html>


