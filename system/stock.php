<?php
require 'config/config.php'; 

?>
<!DOCTYPE HTML>

<html>

<head>
	<title>Oferta komisu</title>
	<meta name="keywords" content="website keywords, website keywords" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" type="text/css" href="style/style.css" title="style" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<SCRIPT language=JavaScript>
function reload(form)
{
var val=form.cat.options[form.cat.options.selectedIndex].text;
self.location='stock.php?cat=' + val ;
}

$(document).ready(function(){
    $('input[type="radio"]').click(function(){
        var inputValue = $(this).attr("value");
        var targetBox = $("." + inputValue);
        $(".box").not(targetBox).hide();
        $(targetBox).show();
    });
});

$(document).ready(function() {
    $("input[name$='filters']").click(function() {
        var test = $(this).val();

        $("div.desc").hide();
        $("#Filters" + test).show();
    });
});
</script>
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
	  </br>
	  

		<div id="radiobuttons">
			<input type="radio" name="filters" checked="checked" value="2"  />Wyszukaj po marce/modelu
			&nbsp;&nbsp;&nbsp;
			<input type="radio" name="filters" value="3" />Wyszukiwanie zaawansowane
		</div>

	  <div id="Filters2" class="desc">
		
	  </br>
		<?Php

		@$cat=$_GET['cat']; 
		$query2="SELECT make FROM stock group by make"; 

		if(isset($cat) and strlen($cat) > 0){
			$query="SELECT model FROM stock WHERE make='$cat' group by model";
		}
		else{
			$query="SELECT model FROM stock group by model"; 
		} 
		echo "<form method=post action='stock-list.php'>";
		echo "<select name='cat' onchange=\"reload(this.form)\"><option value=''>Wszystkie marki</option>";
		foreach ($con->query($query2) as $carMake) {
		if($carMake['make']==@$cat)
		{
			echo "<option selected value='$carMake[make]'>$carMake[make]</option>"."<BR>";
		}
		else
		{
			echo  "<option value='$carMake[cat_id]'>$carMake[make]</option>";}
		}
		
		echo "</select>";
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select name='subcat'><option value=''>Wybierz dostępny model</option>";
		foreach ($con->query($query) as $carMod) 
		{
		echo  "<option value='$carMod[model]'>$carMod[model]</option>";}
		echo "</select>";
		?>
		<input id="prodId" name="prodId" type="hidden" value="0">
		<br></br><input type=submit value='Szukaj pojazdów'>
		</form>
		</div>
		
		<div id="Filters3" class="desc" style="display: none;">
			</br>
			<form method=post action='stock-list.php'>
			<input type="number" style="width:30%" name="rok1" placeholder="Rok produkcji od: " min="1970" max="2020">
			<input type="number" style="width:30%" name="rok2" placeholder="Rok produkcji do: " min="1970" max="2021">
			</br>
			<input type="number" style="width:30%" name="moc1" placeholder="Moc od: " min="10" max="400">
			<input type="number" style="width:30%" name="moc2" placeholder="Moc do: " min="10" max="400">
			</br>
			<input type="number" style="width:30%" name="litry1" step="0.1" placeholder="Litry od: " min="0" max="8">
			<input type="number" style="width:30%" name="litry2" step="0.1" placeholder="Litry do: " min="0" max="8">
			</br>
			<input type="number" style="width:30%" name="cena1" placeholder="Cena od: " min="10" max="500000">
			<input type="number" style="width:30%" name="cena2" placeholder="Cena do: " min="10" max="500000">
			<p></p>
			<select name="pick_fuel">
			<option hidden>Rodzaj paliwa</option>
            <?php 
			$query = "SELECT  * FROM `stock` GROUP BY fuel";
			foreach ($con->query($query) as $get_fuel) {
			echo "<option value='$get_fuel[fuel]'>$get_fuel[fuel]</option>"."<BR>";}?>
			</select>
			<select name="pick_trans">
			<option hidden>Skrzynia biegów</option>
            <?php 
			$query = "SELECT  * FROM `stock` GROUP BY transmission";
			foreach ($con->query($query) as $get_trans) {
			echo "<option value='$get_trans[transmission]'>$get_trans[transmission]</option>"."<BR>";}?>
			</select>
			<input id="prodId" name="prodId" type="hidden" value="1">
			<br></br><input type=submit value='Szukaj pojazdów'>
			</form>
			
		</div>

    </div>
    <div id="footer">
		<?php include 'footer.php';?>
    </div>
  </div>
</body>
</html>