<?php

function Get_stock_result($year1,$year2,$power1,$power2,$liters1,$liters2,$price1,$price2,$fuel,$transmission){
	if($transmission=="Skrzynia biegów")
	{
		$transmission="";
	}
	if($fuel=="Rodzaj paliwa")
	{
		$fuel="";
	}
	
	$Select_String="SELECT id, make, model, year, photo FROM stock WHERE";
	if(strlen($year1)>0){
		if(strlen($year2)>0)
			if($year1<$year2)
				$Select_String=$Select_String.' year between '.$year1.' AND '.$year2.' AND';
			else
				$Select_String=$Select_String.' year between '.$year2.' AND '.$year1.' AND';
		else
			$Select_String=$Select_String.' year between '.$year1.' AND 2022 AND';
	}
	elseif(strlen($year2)>0){
			$Select_String=$Select_String.' year between 1970 AND '.$year2.' AND';
		}
		
	if(strlen($power1)>0){
		if(strlen($power2)>0)
			if($power1<$power2)
				$Select_String=$Select_String.' power between '.$power1.' AND '.$power2.' AND';
			else
				$Select_String=$Select_String.' power between '.$power2.' AND '.$power1.' AND';
		else
			$Select_String=$Select_String.' power between '.$power1.' AND 400 AND';
	}
	elseif(strlen($power2)>0){
			$Select_String=$Select_String.' power between 10 AND '.$power2.' AND';
		}
		
	if(strlen($liters1)>0){
		if(strlen($liters2)>0)
			if($liters1<$liters2)
				$Select_String=$Select_String.' liters between '.$liters1.' AND '.$liters2.' AND';
			else
				$Select_String=$Select_String.' liters between '.$liters2.' AND '.$liters1.' AND';
		else
			$Select_String=$Select_String.' liters between '.$liters1.' AND 8 AND';
	}
	elseif(strlen($liters2)>0){
			$Select_String=$Select_String.' liters between 0 AND '.$liters2.' AND';
		}
		
		
	if(strlen($price1)>0){
		if(strlen($price2)>0)
			if($price1<$price2)
				$Select_String=$Select_String.' price between '.$price1.' AND '.$price2.' AND';
			else
				$Select_String=$Select_String.' price between '.$price2.' AND '.$price1.' AND';
		else
			$Select_String=$Select_String.' price between '.$price1.' AND 8 AND';
	}
	elseif(strlen($price2)>0){
			$Select_String=$Select_String.' price between 0 AND '.$price2.' AND';
		}

		
	if(strlen($fuel)>0){
		$Select_String=$Select_String.' fuel="'.$fuel.'" AND';
	}
	
	if(strlen($transmission)>0){
		$Select_String=$Select_String.' transmission="'.$transmission.'" AND';
	}

	$Select_String=$Select_String.'AND';

	if(strpos($Select_String, 'ANDAND') !== false){
		
		$Select_String=str_replace(' ANDAND',';',$Select_String);
	}
	else{
		$Select_String=str_replace(' WHEREAND',';',$Select_String);
	}
	
	return $Select_String;
}
?>



