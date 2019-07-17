<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>

<head>
	<title>View Records</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>

	<h1>View Records</h1>

	<?php
                        // connect to the database
                        include('connect-db.php');
                        //results per page
		       $per_page = 3;
		       //how many records are in the DB?
		       if($result = $mysqli->query("SELECT * FROM players ORDER BY id")) {
				if($result->num_rows != 0) {
					//There are results
					$total_results = $result->num_rows; //number of rows in DB
					$total_pages = ceil($total_results/$per_page); //number of pages needed

					if(isset($_GET['page']) && is_numeric($_GET['page'])) {
						//If page is in the URL - grab the data
						$show_page = $_GET['page'];

						if ($show_page > 0 && $show_page <= $total_pages) {
							$start = ($show_page - 1) * $per_page;
							$end = $start + $per_page;
						} else {
							$start = 0;
							$end = $per_page;
						}
					} else {
						//If the page is not in the URL, default to showing records 0 - 2 (3 records per page)
						$start = 0;
						$end = $per_page;
					}

					//display pagination
					echo "<p><a href='view.php'>View All</a> | <b> View Page: </b>";
					for($i = 1; $i <= $total_pages; $i++) {
						if(isset($_GET['page']) && $_GET['page'] == $i ) {
							echo $i . " ";
						} else {
							echo "<a href='view-paginated.php?page=$i'>" . $i . "</a> ";
						}
					}
					echo "</p>";

					//Display the records
					echo "<table border='1' cellpadding='10'>";
					echo "<tr><th>ID</th><th>First Name</th><th>Last Name</th><th></th><th></th></tr>";
					for($i = $start; $i < $end; $i++) {
						if($i == $total_results) { break;} 
							$result->data_seek($i);
							$row = $result->fetch_row();
							// print_r($row);
							echo "<tr>";
							echo "<td>" . $row[0] . "</td>";
							echo "<td>" . $row[1] . "</td>";
							echo "<td>" . $row[2] . "</td>";
							echo "<td><a href='records.php?id='" . $row[0] . ">Edit</a></td>";
							echo "<td><a href='delete.php?id='" . $row[0] . ">Delete</a></td>";
							echo "</tr>";
					}
					echo "</table>";
				} else {
					echo "No Results to display";
				}
		       } else {
			       echo "Error: " . $mysqli->error;
		       }
                                                
                        // close database connection
                        $mysqli->close();
                
                ?>

	<a href="records.php">Add New Record</a>
</body>

</html>