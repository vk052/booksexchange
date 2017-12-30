<html>
  <head>
    <title>Index</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

  </head>
  <body>
    <h1>Books</h1>

    <table class="table-striped table">
  <th>Autor</th>
  <th>Titel</th>
  <th>ISBN</th>
  <th>Preis</th>
  <th>Actions</th>
		
  <?php
    $link = mysqli_connect("db709858490.db.1and1.com", "dbo709858490", "Svoli1990", "db709858490");
	mysqli_query($link, "SET NAMES 'utf8'");
	
	if (isset($_GET['deleteID'])){
		$deleteID = $_GET['deleteID'];
	$sql = "DELETE FROM `db709858490`.`books` WHERE `books`. `id` = " . $deleteID;
	echo $sql;
	mysqli_query($link, $sql);
	}	
    
		
    $stmt = "SELECT * FROM `books`";
    $result = $link->query($stmt);
	
	
	

    if ($result->num_rows > 0){
      while ($row = mysqli_fetch_row($result)){
        echo "<tr>\n";
        echo "<td>" . $row[1] . "</td>\n";
        echo "<td>" . $row[2] . "</td>\n";
        echo "<td>" . $row[3] . "</td>\n";
        echo "<td>" . $row[4] . "</td>\n";
        echo "<td><a href='index.php?deleteID=" . $row[0] . "'>delete</a></td>\n";
		echo "<td><a href='edit_user.php?ID=" . $row[0]. "'>edit</a></td>\n";
		echo "</tr>";
      }
    }
    else {
        echo "<tr><td colspan='4'>No data found</td></tr>";
    }
  ?>
</table>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>

