<?php
/**
 * Use an HTML form to edit an entry in the
 * users table.
 *
 */
require "../config.php";
require "../common.php";
$success = null;

if (isset($_GET['id'])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);
    $id = $_GET['id'];
    $sql = "DELETE FROM users WHERE id = :id";
    $statement = $connection->prepare($sql);
    $statement->bindValue(':id', $id);
    $statement->execute();
    $success = "User successfully deleted";
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
} else {
    echo "Something went wrong!";
    exit;
}
?>

<?php require "templates/header.php"; ?>

<?php if ($success) echo $success; ?>


<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>
