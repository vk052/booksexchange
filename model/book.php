<?php
class Book {
  private $id;
  private $titel;
  private $autor;
  private $ownerID;
  private $ISBN;
  private $preis;
  protected static $db;
  public function __construct(){
    self::$db = new DBHelper();
  }
  public function setBook($id, $autor, $titel, $ownerID, $preis){
    $this->id = $id;
    $this->titel = $titel;
    $this->autor = $autor;
    $this->ownerID = $ownerID;
    $this->ISBN = $ISBN;
	$this->preis = $preis;
  }
  public function create($autor, $titel, $ownerID, $preis){
    $sql_query = "INSERT INTO `books`(`owner_id`, `autor`, `titel`, `ISBN`, `preis`) ";
    $sql_query .= "VALUES('" . $ownerID ."','" . $autor . "','" . $titel . "','" . $ISBN . "','" . $preis . "')";
    // run query
    $result = self::$db->query($sql_query);
    $errorText = mysqli_error(self::$db->conn);
    // returns an array. First argument: true/false indicates if update was
    // successful. Second argument is a message to the user.
    $returnArray = array();
    $returnArray[0] = true;
    $returnArray[1] = "Inserted book " . $titel;
    $returnArray[2] = mysqli_insert_id(self::$db->conn);
    if (!empty($errorText)){
      $returnArray[0] = false;
      $returnArray[1] = $errorText;
      $returnArray[2] = null;
    }
    return $returnArray;
  }
  public function update($id, $autor, $titel, $ownerID, $ISBN, $preis){
    $sql_query = "UPDATE `books` SET `titel` = '" . $titel . "',
      `autor` = '" . $autor . "',
      `owner_id` = '" . $ownerID . "',
	  `ISBN` = '" . $ISBN . "',
      `preis` = '" . $preis . "'
      WHERE `id` = " . $id;
    // run query
    $result = self::$db->query($sql_query);
    $errorText = mysqli_error(self::$db->conn);
    // returns an array. First argument: true/false indicates if update was
    // successful. Second argument is a message to the user.
    $returnArray = array();
    $returnArray[0] = true;
    $returnArray[1] = "Updated book " . $titel;
    if (!empty($errorText)){
      $returnArray[0] = false;
      $returnArray[1] = $errorText;
    }
    return $returnArray;
  }
  public function delete($id){
    $sql_query="DELETE FROM `books` WHERE `id` = " . $id;
    $result = self::$db->query($sql_query);
    $errorText = mysqli_error(self::$db->conn);
    $returnArray = array();
    $returnArray[0] = true;
    $returnArray[1] = "Deleted book " . $id;
    if (!empty($errorText)){
      $returnArray[0] = false;
      $returnArray[1] = $errorText;
    }
    return $returnArray;
  }
  public static function getBook($id){
    $book = new Book();
    $sql_query = "SELECT * FROM `books` WHERE `id` = " . $id;
    $result = self::$db->query($sql_query);
    $row = mysqli_fetch_array($result);
    $book->setBook($row['id'], $row['autor'], $row['titel'], $row['owner_id'], $row['ISBN'], $row['preis']);
    return $book;
  }
  public static function getAllBooks(){
    $sql_query = "SELECT * FROM books";
    $result_set = self::$db->query($sql_query);
    $books = array();
    if(mysqli_num_rows($result_set) > 0) {
      while($row = mysqli_fetch_array($result_set)) {
        $book = new Book();
        $book->setBook($row['id'], $row['autor'], $row['titel'], $row['owner_id'], $row['ISBN'], $row['preis']);
        $books[] = $book;
      }
    }
    return $books;
  }
  public function getID(){
    return $this->id;
  }
  public function getOwnerID(){
    return $this->ownerID;
  }
  public function getTitle(){
    return $this->titel;
  }
  public function getAuthor(){
    return $this->autor;
  }
	public function getISBN(){
    return $this->ISBN;
  }
  public function getPrice(){
    return $this->preis;
  }
  public function isMine($user){
    if ($user->getID() == $this->ownerID){
      return true;
    }
    else {
      return false;
    }
  }
}
?>