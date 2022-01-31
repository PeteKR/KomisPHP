<?php

use PHPMailer\PHPMailer\PHPMailer;
$message = '';

if(isset($_POST["submit"])){
	require_once "PHPMailer/PHPMailer.php";
    require_once "PHPMailer/SMTP.php";
    require_once "PHPMailer/Exception.php";

	$message = '
		<h3 align="center">Zgłoszenie auta</h3>
		<table border="1" width="100%" cellpadding="5" cellspacing="5">
			<tr>
				<td width="30%">Imię</td>
				<td width="70%">'.$_POST["imie"].'</td>
			</tr>
			<tr>
				<td width="30%">Adres</td>
				<td width="70%">'.$_POST["adres"].'</td>
			</tr>
			<tr>
				<td width="30%">Telefon</td>
				<td width="70%">'.$_POST["telefon"].'</td>
			</tr>
			<tr>
				<td width="30%">Email</td>
				<td width="70%">'.$_POST["email"].'</td>
			</tr>
			<tr>
				<td width="30%">Marka</td>
				<td width="70%">'.$_POST["marka"].'</td>
			</tr>
			<tr>
				<td width="30%">Model</td>
				<td width="70%">'.$_POST["model"].'</td>
			</tr>
			<tr>
				<td width="30%">Rok</td>
				<td width="70%">'.$_POST["rok"].'</td>
			</tr>
			<tr>
				<td width="30%">Przebieg</td>
				<td width="70%">'.$_POST["przebieg"].'</td>
			</tr>
			<tr>
				<td width="30%">Paliwo</td>
				<td width="70%">'.$_POST["paliwo"].'</td>
			</tr>
			<tr>
				<td width="30%">Skrzynia</td>
				<td width="70%">'.$_POST["skrzynia"].'</td>
			</tr>
						<tr>
				<td width="30%">Moc</td>
				<td width="70%">'.$_POST["moc"].'</td>
			</tr>
			<tr>
				<td width="30%">Litry</td>
				<td width="70%">'.$_POST["litry"].'</td>
			</tr>
			<tr>
				<td width="30%">Proponowana cena</td>
				<td width="70%">'.$_POST["cena"].'</td>
			</tr>
			<tr>
				<td width="30%">Dodatkowe informacje</td>
				<td width="70%">'.$_POST["extra"].'</td>
			</tr>
		</table>
	';
	
$mail = new PHPMailer();
try{
    //Server settings
	$mail->setLanguage('pl', 'src/');
    $mail->SMTPDebug = 0;                                
    $mail->isSMTP();                                   
    $mail->CharSet = 'UTF-8';								
    $mail->Host = 'host';  					
    $mail->SMTPAuth = true;                        
    $mail->Username = "email";
    $mail->Password = 'hasło';
    $mail->SMTPSecure = "ssl";
    $mail->Port = port;                                  

	$mail->addReplyTo($_POST['email'], $_POST['imie']);
    $mail->setFrom('adres', $_POST['imie']);
    $mail->addAddress('adres');

    $mail->isHTML(true);                                  
    $mail->Subject = 'Wiadomosć z formularza kontaktowego';
	$mail->Body = $message;		

    foreach ($_FILES["resume"]["name"] as $k => $v) {
        $mail->AddAttachment( $_FILES["resume"]["tmp_name"][$k], $_FILES["resume"]["name"][$k] ); }

	$message='';
	$mail->send();
		$message = '<h2>Formularz został wysłany.</h2>';
	} catch (Exception $e) {
		$message = '<h2>Błąd przy wysyłaniu.</h2>';
	}
}


?>
<!DOCTYPE HTML>
<html>

<head>
  <title>Formularz Sprzedaży</title>
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
          <li class="selected"><a href="form.php">Formularz sprzedaży</a></li>
          <li><a href="stock.php">Nasza oferta</a></li>
		  <li><a href="auction-list.php">Aukcje</a></li>
          <li><a href="contact.php">Kontakt</a></li>
        </ul>
      </div>
    </div>
		<div id="site_content">
        <h1><b>Formularz sprzedaży pojazdu</b></h1>
        <h4>* = pole wymagane do wysłania formularza</h4>
		<?php print_r($message); ?>
		<form method="post" enctype="multipart/form-data">
		<div class="form-elements">
		<fieldset class="pure-group">
		<table><h2>1.Dane kontaktowe:</h2>
			
			<tr><td><label>  </label>
			<input name="imie" placeholder="* Imię i nazwisko" required /></td>
			
			<td><label></label>
			<input name="adres" placeholder="* Adres" required /></td></tr>
			
			<tr><td><label></label>
			<input name="telefon" placeholder="* Numer kontaktowy" required /></td>
			
			<td><label for="email"></label>
			<input name="email" type="email" placeholder="* Adres@email" required /></td></tr>
			</table><br></fieldset>
			
			<fieldset class="pure-group">
			<table><h2>2.Dane o samochodzie:</h2>
			
			<tr><td><label>    </label>
			<input name="marka" type="text" placeholder="* Marka" required  /></td>
			
			<td><label>    </label>
			<input name="model" type="text" placeholder="* Model"required  /></td></tr>
			
			<tr><td><label>    </label>
			<input name="rok" type="number" placeholder="Rok produkcji" /></td>
					
			<td><label>    </label>
			<input name="przebieg" type="number" placeholder="Przebieg" /></td></tr>
			
			<tr><td><label>    </label>
			<input name="paliwo" type="text" placeholder="Rodzaj paliwa"   /></td>
			
			<td><label>    </label>
			<input name="skrzynia" type="text" placeholder="Skrzynia biegów"  /></td></tr>
			
			<tr><td><label>    </label>
			<input name="moc" type="number" placeholder="Moc silnika" /></td>
			
			<td><label>     </label>
			<input name="litry" type="number"  step="0.1" placeholder="Pojemność silnika"  /></tr></td></table>
			
			<label>    </label>
			<input name="cena" type="number" placeholder="Oczekiwana cena w złotówkach" required />
			
			<label for="extra">    </label>
			<textarea name="extra" rows="10"
			placeholder="Dodatkowe informacje, uszkodzania, uwagi"></textarea><br>
			
			<label><b>Dodaj zdjęcia auta (kilka plików na raz, tylko zdjęcia)</b></label>
			<input type="file" name="resume[]" multiple="multiple" accept=".jpg,.jpeg, .gif, .png, .bmp" /></td>
			</fieldset>
			
			<input type="submit" name="submit" value="Wyślij formularz" class="button-success pure-button button-xlarge" />
			</div>
									
    </div>
    <div id="footer">
        <?php include 'footer.php';?>
    </div>
  </div>
</body>
</html>