<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
        <head>  
                <title>View Records</title>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        </head>
        <body>
                
                <h1>View Records</h1>
             <p><b>View All</b> | <a href="view-paginated.php">View Paginated</a></p>

                <?php include('connect-db.php'); 
                
                if ($result = $mysqli->query("SELECT * from players ORDER BY id")) {

                        //CHECK IF THE DB HAS ROWS and DISPLAY THEM
                        if($result->num_rows > 0) {
                                echo "<table border='1' cellpadding='10'> 
                                <tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Edit</th><th>Delete</th></tr>";
                                while($row = $result->fetch_object()){  //EACH LOOP IN THIS WHILE REPRESENTS 1 ROW IN DB
                                        echo "<tr>";
                                        echo "<td>" . $row->id . "</td>";
                                        echo "<td>" . $row->firstname . "</td>";
                                        echo "<td>" . $row->lastname . "</td>";
                                        echo "<td><a href='records.php?id=" . $row->id . "'>Edit</a></td>";
                                        echo "<td><a href='delete.php?id=" . $row->id . "'>Delete</a></td>";
                                        echo "</tr>";
                                }

                               echo "</table>";
                        } else {
                                echo "No results to display";  //IF THERE ARE NO ROWS IN THE DB 
                        } 
                        //END BLOCK
                } else {
                         echo "Errors: " . $mysqli->error;
                        
                }

          
                $mysqli->close();
                
                
                ?>
                <a href="records.php">Add a new record</a>

                
        </body>
</html>