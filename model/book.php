<?php
class Book {
  private $id;
  private $titel;
  private $autor;
  private $ownerID;
  private $ISBN;
  private $price;
  protected static $db;
  public function __construct(){
    self::$db = new DBHelper();
  }
  public function setBook($id, $author, $title, $ownerID, $price){
    $this->id = $id;
    $this->title = $titel;
    $this->author = $autor;
    $this->ownerID = $ownerID;
    $this->ISBN = $ISBN;
	$this->price = $price;
  }
  public function create($author, $title, $ownerID, $price){
    $sql_query = "INSERT INTO `books`(`owner_id`, `autor`, `titel`, `ISBN`, `price`) ";
    $sql_query .= "VALUES('" . $ownerID ."','" . $autor . "','" . $titel . "','" . $ISBN . "','" . $price . "')";
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
  public function update($id, $autor, $titel, $ownerID, $ISBN, $price){
    $sql_query = "UPDATE `books` SET `title` = '" . $titel . "',
      `author` = '" . $autor . "',
      `owner_id` = '" . $ownerID . "',
	  `ISBN` = '" . $ISBN . "',
      `price` = '" . $price . "'
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
    $book->setBook($row['id'], $row['autor'], $row['titel'], $row['owner_id'], $row['ISBN'], $row['price']);
    return $book;
  }
  public static function getAllBooks(){
    $sql_query = "SELECT * FROM books";
    $result_set = self::$db->query($sql_query);
    $books = array();
    if(mysqli_num_rows($result_set) > 0) {
      while($row = mysqli_fetch_array($result_set)) {
        $book = new Book();
        $book->setBook($row['id'], $row['autor'], $row['titel'], $row['owner_id'], $row['ISBN'], $row['price']);
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
    return $this->title;
  }
  public function getAuthor(){
    return $this->author;
  }
	public function getISBN(){
    return $this->ISBN;
  }
  public function getPrice(){
    return $this->price;
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