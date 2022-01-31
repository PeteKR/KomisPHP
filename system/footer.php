<?php

echo "<table>";
echo "<tr>";

$page_name = getcwd();


if(basename($page_name)!="menu")
{
	echo "<td><a href='index.php'>Strona główna</td>";
	echo "<td>Komis samochodowy</td>";
	echo "<td><a href='menu.php'>Dla pracowników</td>";
}
else
{
	echo "<td><a href='../index.php'>Strona główna</td>";
	echo "<td>Komis samochodowy</td>";
	echo "<td><a href='../menu.php'>Dla pracowników</td>";
}
echo "</tr>";

echo "</table>";

?>