1. Zainstalować pakiet XAMPP ze strony https://www.apachefriends.org/pl/index.html
2. Po instalacji wypakować zawartość całego folderu skompresowanego z systemem do `htdocs` w folderze XAMPP (C:\xampp\htdocs).
3. W wypakowanym folderze z systemem zmienić:
	a) dane do połączenia z bazą danych MySQL w pliku `system\config.php` lub zostawić jeżeli są domyślne
	b) dane w formularzu do wysłania maila `form.php` w polach: 
		$mail->Username = "twój_email";
		$mail->Password = 'hasło_do_tego_emaila';
		$mail->Host = 'adres_hosta'; (np. gmail: smtp.gmail.com) 					
		$mail->Port = numer_portu_usługi_pocztowej_hosta;  (np. gmail: 465)
		$mail->setFrom('twój_adres_email', $_POST['imie']);
		$mail->addAddress('twój_adres_email');
4. Uruchomić XAMPPa i następujące usługi: serwer Apache i MySQL.
5. Zaimportować bazę danych do MySQL:
	a) Wejść na stronę serwera bazy danych (w moim przypadku: http://localhost/phpmyadmin/)
	b) Nacisnąć zakładkę Import i wybrać załączony do systemu plik bazakomis.sql
	c) Nacisnąć OK.
6. Uruchomić stronę z systemem przez adres http://localhost/system jeżeli została poprawnie wypakowana w drugim punkcie instrukcji.
7. Hasło i login konta pracowniczego: admin admin
	