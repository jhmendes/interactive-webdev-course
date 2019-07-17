<?php

include('connect-db.php');

if(isset($_GET['id']) && is_numeric($_GET['id'])) {
	$id = $_GET['id'];  //set an id value if the id is valid
		if($stmt = $mysqli->prepare("DELETE FROM players WHERE id = ? LIMIT 1")) {
			$stmt->bind_param("i", $id);
			$stmt->execute();
			$stmt->close();
		}
			else {
				echo "<h2> ERROR!</h2>";
		}
		
		$mysqli->close();
		header("Location: view.php");
		
} else {
	header("Location: view.php");
}

?>