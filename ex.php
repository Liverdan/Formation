<!DOCTYPE html>
<html>
<body>

<h1>My first PHP page</h1>

<p><?php

echo "Hello World!";


?></p>

<p><?php

$num = 5;
$location = 'bananier';

$format = 'Il y a %d singes dans le %s';
echo sprintf($format, $num, $location);

?></p>

<p><?php

$pouet ="Pouet";

printf('Compteur : %1$s, taille : %2$d. ', $pouet, 4); // Compteur : 4, taille : 1.
?></p>


<p><?php
$tableau1=array('Bonjour','2',3);
var_dump($tableau1);
?>
</p>
<p><?php
$tableau2= ['Orange','Citron','Pomme'];
foreach ($tableau2 as $ligne) {
	echo $ligne."\n";
};
?>
</p>
<p>
	<?php
	$date = new DateTime();		
	echo $date->format('d-m');
	 ?>
</p>

</body>
</html>