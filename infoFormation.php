<?php
include 'header.php';
require 'acces_db.php';
?>
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
			<input type="submit" name="send" value="Enregistrer"/>
		</form>
	<div/>
<?php
echo "<div/>";
include 'footer.php';
?>
