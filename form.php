<hr />
<div class="formulaire">
<?php
//les inputs sont poussé dans $_GET ou POST puis récupérer dans l'array $data
	$data = $_POST;
	$firstname='';
	$name='';
	$mail='';
	$niveau=5;
	$txtBtn='Envoyer';
	$alerte="Vous avez oubliez de remplir votre ";
	include 'acces_db.php';
	// test de l'existance de la variable dans l'array, si (?) vrai sinon (:)
	$name=isset($data['name'])? $data['name']:'';
	$firstname=isset($data['firstname'])? $data['firstname']:'';
	$mail=isset($data['mail'])? $data['mail']:'';
	$niveau=isset($data['niveau'])? $data['niveau']:5;
	$connexion = new mysqli(HOST,USER,PWD,DB);
	//echo sprintf('<h3>Monsieur%s %s votre e-mail %s</h3>', $name, $firstname, $mail);
		if ($connexion->error){
			echo "Connection échoué";
			die ('Error connecton base : '.$connexion->error);
		}
		if ($name && $firstname && $mail && $niveau) {
			echo sprintf('<h3> %2$s %1$s votre e-mail %3$s et vous estimez avoir un niveau de %4$s </h3>', $name, $firstname, $mail, $niveau);
			$txtBtn="Corriger";
			$sql = "INSERT INTO users (name, firstname, mail, niveau) VALUES ('$name', '$firstname','$mail','$niveau') ON DUPLICATE KEY UPDATE name='$name',firstname='$firstname',niveau='$niveau'";
				if ($connexion->query($sql)){
					echo '<div id="dialog" title="Confirmation"<p>Merci pour votre participation</p></div>';
				}else {
					echo "<p>Requete planté</p>";
				}		
		}
		$connexion->close();
?>

<p><form method="post">
	<label>Votre nom : <input type="text" name="name" placeholder="Nom" value="<?php echo $name ?>"/></label>
	<?php
		if (!$name && count($_POST)){
			echo sprintf('<span>%s nom</span>',$alerte);
		}
	?><br />
			
	<label>Votre pénom : <input type="text" name="firstname" placeholder="Prénom" value="<?php echo $firstname ?>"/></label>
	<?php
		if (!$firstname && count($_POST)){
			echo sprintf('<span>%s prénom</span>',$alerte);
		}
	?><br />
	<label>Votre e-mail : <input type="email" name="mail" placeholder="e-mail" value="<?php echo $mail ?>"/></label>
	<?php
		if (!$mail && count($_POST)){
			echo sprintf('<span>%s mail</span>',$alerte);
		}
	?><br />
	
	<label>Votre niveau : <input type="range" name="niveau" min="0" max="10" step="1" value="<?php echo $niveau ?>"/></label><br />
	
	<!--p><input type="submit" value="<?php echo $txtBtn ?>"/></p> -- > ancien input-->
	
	<div class="widget">		
  		<button id="opener" class="ui-button ui-widget ui-corner-all" type="submit"><?php echo $txtBtn ?></button>
	</div>
</form></p>
</div>
<hr />