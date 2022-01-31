<?php
function Validate_DB($year,$mileage,$fuel,$trans,$power,$liters,$price){
	if($year>=1950 && $year<=2022){
		if($mileage>0 && $mileage<=999999){
			if($fuel=="Benzyna" ||  $fuel=="LPG" || $fuel=="Diesel" || $fuel=="Elektryczny"){
				if($trans=="Automatyczna" ||  $trans=="Manualna"){
					if($power>0 && $power<=500){
						if($liters>0 && $liters<=8){
							if($price>0 && $price<=500000){
							}else
								return "Bład przy wprowadzaniu ceny.";
						}else
							return "Bład przy wpisywaniu litrów.";
					}else
						return "Bład przy wprowadzaniu mocy.";
				}else
					return "Bład przy wpisywaniu rodzaju skrzyni biegów.";
			}else
				return "Bład przy wpisywaniu rodzaju paliwa.";
		}else
			return "Bład przy wprowadzaniu przebiegu.";
	}else
		return "Bład przy wprowadzaniu roku produkcji.";
}

function Validate_DB2($year,$mileage,$fuel,$trans,$power,$liters,$price){
	if($year>=1950 && $year<=2022){
		if($mileage>0 && $mileage<=999999){
			if($fuel=="Benzyna" ||  $fuel=="LPG" || $fuel=="Diesel" || $fuel=="Elektryczny"){
				if($trans=="Automatyczna" ||  $trans=="Manualna"){
					if($power>0 && $power<=500){
						if($liters>0 && $liters<=8){
							if($price>0 && $price<=500000){
								return true;
							}else
								return false;
						}else
							return false;
					}else
						return false;
				}else
					return false;
			}else
				return false;
		}else
			return false;
	}else{
		return false;}
}
?>



