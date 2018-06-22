<?php
include 'header.php';
include 'acces_db.php';
?>
<div class="pied_page"	
	<div id="infoFormation">
		<br /><br /><br /><br />
		<ul>
		<?php
		$connexion = new mysqli(HOST, USER, PWD, DB);
		$sql = $connexion->query("SELECT * FROM categories ORDER BY Pos ASC");
		$sql->data_seek(0);
		while ($row = $sql->fetch_assoc()) {
	    	echo "<li>" . $row['cat']." ".$row['Pos'] . "<li>";
		};
		?>
		</ul>
		<br /><br /><br /><br />
	<div/>
<?php
echo "<div/>";
include 'footer.php';
?>