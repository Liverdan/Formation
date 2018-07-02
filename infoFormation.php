<?php
include 'header.php';
include 'acces_db.php';
?>
<div class="formulaire pied_page">
    <?php
	//les inputs sont poussé dans $_GET ou $_POST puis récupérer dans l'array $data
	$data = $_POST;
	$firstname = '';
	$name = '';
	$mail = '';
	$niveau = 5;
	$txtBtn = 'Envoyer';
	$alerte = "Vous devez compléter votre ";
	// test de l'existance de la variable dans l'array $data, si (?) vrai sinon (:)
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
	if ($name && $firstname && $mail) {
		echo sprintf('<h3>Bonjour %2$s %1$s votre e-mail %3$s</h3>', $name, $firstname, $mail);
		// Affiche les données présentes dans la table categories
		$sqlaf = $connexion->query("SELECT * FROM categories ORDER BY Pos DESC");
			$sqlaf->data_seek(0);
			while ($row = $sqlaf->fetch_assoc()) {
				$nChoix= "choix".$row['Pos'];
				$nLevel="niveau".$row['Pos'];
		    	echo "<li>".$nChoix." ".$row['id'] ." ". $row['cat']." ".$nLevel." ".$row['level']. "<li>";
			};
		$txtBtn = "Corriger";
		$sqlins = "INSERT INTO users (name, firstname, mail) VALUES ('$name', '$firstname','$mail') ON DUPLICATE KEY UPDATE name='$name',firstname='$firstname'";
		if ($connexion -> query($sqlins)) {
			//echo "<div id='dialog' title='Confirmation'><p>Merci pour votre participation</p></div>";
		} else {
			echo "<p>Requete planté</p>";
		}
	}
	//$connexion -> close();
    ?>
    <?php 
//Update de la liste catégorie dans la table categories
//$connexion = new mysqli(HOST, USER, PWD, DB);
	if(!empty($_POST)){
		if ($connexion->connect_error) {
	    die("Connection failed: " . $connexion->connect_error);
	}
	$cate=$_POST["Categorie"];
	foreach ($cate as $c){
		extract($c);
		$sqlcat=("UPDATE categories SET cat='$cat', Pos=$Pos, level=$level WHERE id=$id");
		if ($connexion->query($sqlcat)=== TRUE){
			$res ="Requete Ok";
		}else{
			$res= "Requete Ko";
		}
	}
	//$connexion->close();
	print_r($res);
}
 ?>
<!--formulaire civilité--> 
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
		        
			<h2>Vos priorités et niveaux</h2>
			<p>Classer par ordre croissant, en déplacant les flèches suivantes <span class="ui-icon ui-icon-arrowthick-2-n-s"></span> votre choix de formation.</p>
			<p><i>(Le premier étant le plus important)</i></p>
			<!--formulaire priorités et niveaux-->
			<ul id="sortable">
				<?php
				$i=0;
				//$connexion = new mysqli(HOST, USER, PWD, DB);
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
			</ul>&nbsp;
			<div class="widget">
		    	<button id="opener" class="ui-button ui-widget ui-corner-all" type="submit"><?php echo $txtBtn ?></button>
			</div>
		</form>
</div>

 *************************************************
 <?php 
//$connexion = new mysqli(HOST, USER, PWD, DB);
	if(!empty($_POST)){
		if ($connexion->connect_error) {
	    die("Connection failed: " . $connexion->connect_error);
	}
	//$connexion = new mysqli(HOST, USER, PWD, DB);
			$sqlw = $connexion->query("SELECT * FROM categories ORDER BY Pos DESC");
			$sqlw->data_seek(0);
			while ($row = $sqlw->fetch_assoc()) {
				$nChoix= "choix".$row['Pos'];
				$nLevel="niveau".$row['Pos'];
		    	$cate=$_POST["Categorie"];
	foreach ($cate as $c){
		extract($c);
		$sqlu=("UPDATE users SET Choix-1=$id WHERE name='$name'");
		if ($connexion->query($sqlu)=== TRUE){
			$res ="ok";
		}else{
			$res= "Ko";
		}
		}
		};
	
	$connexion->close();
	print_r($res);
}
 ?>
 <!--*************************************************-->
<!--div class="pied_page"	
	<div id="infoFormation">
		<ul>
			<?php
			$connexion = new mysqli(HOST, USER, PWD, DB);
			$sqlaf = $connexion->query("SELECT * FROM categories ORDER BY Pos DESC");
			$sqlaf->data_seek(0);
			while ($row = $sqlaf->fetch_assoc()) {
				$nChoix= "choix".$row['Pos'];
				$nLevel="niveau".$row['Pos'];
		    	echo "<li>".$nChoix." ".$row['id'] ." ". $row['cat']." ".$nLevel." ".$row['level']. "<li>";
			};
			?>
		</ul>
		&nbsp;
		
		<!--form method="post" action="infoFormation.php">
			<h2>Vos priorités et niveaux</h2>
			<p>Classer par ordre croissant, en déplacant les flèches suivantes <span class="ui-icon ui-icon-arrowthick-2-n-s"></span> votre choix de formation.</p>
			<p><i>(Le premier étant le plus important)</i></p>
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
	<div/-->
<?php
echo "<div/>";
include 'footer.php';
?>
