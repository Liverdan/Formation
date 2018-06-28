<?php
include 'header.php';
require 'acces_db.php';
?>
<div class="formulaire">
    <?php
	//les inputs sont poussé dans $_GET ou POST puis récupérer dans l'array $data
	$data = $_POST;
	$firstname = '';
	$name = '';
	$mail = '';
	$niveau = 5;
	$txtBtn = 'Envoyer';
	$alerte = "Vous avez oubliez de remplir votre ";
	include 'acces_db.php';
	// test de l'existance de la variable dans l'array, si (?) vrai sinon (:)
	$name = isset($data['name']) ? $data['name'] : '';
	$firstname = isset($data['firstname']) ? $data['firstname'] : '';
	$mail = isset($data['mail']) ? $data['mail'] : '';
	$niveau = isset($data['niveau']) ? $data['niveau'] : 5;
	$connexion = new mysqli(HOST, USER, PWD, DB);
	//echo sprintf('<h3>Monsieur%s %s votre e-mail %s</h3>', $name, $firstname, $mail);
	if ($connexion -> error) {
		echo "Connection échoué";
		die('Error connecton base : ' . $connexion -> error);
	}
	if ($name && $firstname && $mail && $niveau) {
		echo sprintf('<h3> %2$s %1$s votre e-mail %3$s et vous estimez avoir un niveau de %4$s </h3>', $name, $firstname, $mail, $niveau);
		$txtBtn = "Corriger";
		$sql = "INSERT INTO users (name, firstname, mail, niveau) VALUES ('$name', '$firstname','$mail','$niveau1') ON DUPLICATE KEY UPDATE name='$name',firstname='$firstname',niveau='$niveau1'";
		if ($connexion -> query($sql)) {
			echo '<div id="dialog" title="Confirmation"><p>Merci pour votre participation</p></div>';
		} else {
			echo "<p>Requete planté</p>";
		}
	}
	$connexion -> close();
    ?>

    <p>
    	<form method="post">
		    <label>Votre nom : <input type="text" name="name" placeholder="Nom" value="<?php echo $name ?>"/></label>
		    <?php
			if (!$name && count($_POST)) {
				echo sprintf('<span>%s nom</span>', $alerte);
			}
		    ?><br />
		
		    <label>Votre pénom : <input type="text" name="firstname" placeholder="Prénom" value="<?php echo $firstname ?>"/></label>
		    <?php
			if (!$firstname && count($_POST)) {
				echo sprintf('<span>%s prénom</span>', $alerte);
			}
		    ?><br />
		    <label>Votre e-mail : <input type="email" name="mail" placeholder="e-mail" value="<?php echo $mail ?>"/></label>
		    <?php
			if (!$mail && count($_POST)) {
				echo sprintf('<span>%s mail</span>', $alerte);
			}
		    ?><br />
		
		    <label>Votre niveau : <input type="range" name="niveau" min="0" max="10" step="1" value="<?php echo $niveau ?>"/></label><br />
		    <!--p><input type="submit" value="<?php echo $txtBtn ?>"/></p> -- > ancien input-->
		    <div class="widget">
		    	<button id="opener" class="ui-button ui-widget ui-corner-all" type="submit"><?php echo $txtBtn ?></button>
			</div>
		</form>
	</p>
</div>
<?php 
$connexion = new mysqli(HOST, USER, PWD, DB);
	if(!empty($_POST)){
		if ($connexion->connect_error) {
	    die("Connection failed: " . $connexion->connect_error);
	}
	$cate=$_POST["Categorie"];
	foreach ($cate as $c){
		extract($c);
		$sql=("UPDATE categories SET cat='$cat', Pos=$Pos, level=$level WHERE id=$id");
		if ($connexion->query($sql)=== TRUE){
			$res ="ok";
		}else{
			$res= "Ko";
		}
	}
	$connexion->close();
	//print_r($res);
}
 ?>
<div class="pied_page"	
	<div id="infoFormation">
		<!--ul>
			<?php
			$connexion = new mysqli(HOST, USER, PWD, DB);
			$sql = $connexion->query("SELECT * FROM categories ORDER BY Pos DESC");
			$sql->data_seek(0);
			while ($row = $sql->fetch_assoc()) {
		    	echo "<li>" . $row['cat']." ".$row['Pos'] ." ".$row['level']. "<li>";
			};
			?>
		</ul-->
		<h2>Vos priorités et niveaux</h2>
		<p>Classer par ordre croissant, en déplacant les flèches suivantes <span class="ui-icon ui-icon-arrowthick-2-n-s"></span> votre choix de formation.</p>
		<p><i>(Le premier étant le plus important)</i></p>
		<form method="post" action="infoFormation.php">
			<ul id="sortable">
				<?php
				$i=0;
				$connexion = new mysqli(HOST, USER, PWD, DB);
				$sql = $connexion->query("SELECT * FROM categories ORDER BY Pos DESC");
				$sql->data_seek(0);
				while ($row = $sql->fetch_assoc()) {
					$i++;
				?>
				<li>
					<span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
			    	<input type="hidden" name="Categorie[<?php echo $i;?>][id]" value="<?php echo $row["id"];?>"/>
			    	<input type="text" name="Categorie[<?php echo $i;?>][cat]" value="<?php echo $row["cat"];?>"/> 
			    	<input type="hidden" class="positionInput" name="Categorie[<?php echo $i;?>][Pos]" value="<?php echo $row["Pos"];?>"/>
			    	<span>0</span>
			    	<input type="range" id="custom-handle" class="ui-slider-handle" name="Categorie[<?php echo $i;?>][level]" min="0" max="10" step="1" value="<?php echo $row["level"];?>"/>
			    	<span>10</span>
				</li>
				<?php
				}
				?>
			</ul> 
			<button class="ui-button ui-widget ui-corner-all" type="submit">Enregistrer</button>
		</form>
	<div/>
<?php
echo "<div/>";
include 'footer.php';
?>
