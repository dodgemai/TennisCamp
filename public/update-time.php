<?php
require "../config.php";
require "../common.php";

if (isset($_POST['time'])) {
  if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();
  try {
    $connection = new PDO($dsn, $username, $password, $options);
    $user =[
      "id"    => $_GET['id'],
      "day"   => $_GET['day'],
      "time"  => TIME(LOCALTIMESTAMP())
    ];
    $sql = "UPDATE users
            SET  day = :time
            WHERE id = :id";
  $statement = $connection->prepare($sql);
  $statement->execute($user);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}
?>
