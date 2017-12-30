<?php

    $link = mysqli_connect("db709858490.db.1and1.com", "dbo709858490", "Svoli1990", "db709858490");
	mysqli_query($link, "SET NAMES 'utf8'");
    $stmt = "SELECT * FROM `books`";
    $result = $link->query($stmt);



$status = "";

          if (! empty($_GET['ID'])){
                       $ID = $_GET['ID'];
          }

          else if (! empty($_POST['ID']))
	
	

if(isset($_POST['autor'])){
  $autor = $_POST['autor'];
	if(empty($autor)) {
  echo 'Autor darf nicht leer sein';
		die;
}
  $titel = $_POST['titel'];
	if(empty($titel)) {
  echo 'Titel darf nicht leer sein';
		die;
}
  $ISBN = $_POST['ISBN'];
	if(empty($ISBN)) {
  echo 'ISBN darf nicht leer sein';
		die;
}
  $preis = $_POST['preis'];
	if(empty($preis)) {
  echo 'Preis darf nicht leer sein';
		die;
}
	$ID = $_POST['ID'];
	if(empty($ID)) {
  echo 'ID darf nicht leer sein';
		die;
}
	
	
  $stmt = "UPDATE `books` SET `autor` = '" . $autor . "', `titel` = '" . $titel . "', `ISBN` = '" . $ISBN ."', `preis` = '" . $preis ."' WHERE `books`.`id` = " . $ID ."";
	
  $result = $link->query($stmt);

  $status = ">> Book edited";
}
else {
  $status = ">> nothing edited yet";
}
  


$stmt = "SELECT * FROM `books` WHERE `ID`= $ID";
    $result = $link->query($stmt);

if ($result->num_rows > 0){
	 while ($row = mysqli_fetch_row($result)){
        $autor = $row[1];
		$titel = $row[2];
		$ISBN = $row[3];
		$preis = $row[4];
      }
}
else {
	die("User mit ID " . $ID . " not found");
}


?>
<!doctype html>
<html lang="de">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">


</head>
<body>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
            <h1>Edit Books</h1>
			<h2><?php echo $status ?></h2>
		      
			  
			  <input type="hidden" class="form-control" id="ID" name="ID" value ="<?php echo $ID ?>">
				
            <div class="form-group">
              <label for="autor">Autor:</label>
              <input type="text" class="form-control" id="autor" name="autor" value="<?php echo $autor ?>">
            </div>
            <div class="form-group">
              <label for="titel">Titel:</label>
              <input type="text" class="form-control" id="titel" name="titel" value="<?php echo $titel ?>">
            </div>
            <div class="form-group">
              <label for="ISBN">ISBN:</label>
              <input type="text" class="form-control" id="ISBN" name="ISBN" value="<?php echo $ISBN ?>">
            </div>
			  <div class="form-group">
              <label for="preis">Preis:</label>
              <input type="text" class="form-control" id="preis" name="preis" value="<?php echo $preis ?>">
            </div>
            <button type="submit" class="btn btn-default" name="btn-save">Edit book</button>

          </form>

          </div>
        </div>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
   </body>
</html>
