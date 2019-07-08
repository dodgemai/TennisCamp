<?php
/**
 * Use an HTML form to edit an entry in the
 * users table.
 *
 */
require "../config.php";
require "../common.php";

if (isset($_POST['submit'])) {
  if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();
  try {
    $connection = new PDO($dsn, $username, $password, $options);
    $user =[
      "id"        => $_POST['id'],
      "name" => $_POST['name'],
      "level" => $_POST['level'],
      "age" => $_POST['age'],
      "tshirt" => $_POST['tshirt'],
      "docName" => $_POST['docName'],
      "docPhone" => $_POST['docPhone'],
      "medInfo" => $_POST['medInfo'],
      "water" => $_POST['water'],
      "walkRide" => $_POST['walkRide'],
      "parentFirst" => $_POST['parentFirst'],
      "parentLast" => $_POST['parentLast'],
      "primaryEmail" => $_POST['primaryEmail'],
      "primaryPhone" => $_POST['primaryPhone'],
      "otherParentFirst" => $_POST['otherParentFirst'],
      "otherParentLast" => $_POST['otherParentLast'],
      "otherEmail" => $_POST['otherEmail'],
      "otherPhone" => $_POST['otherPhone'],
      "emergencyFirst" => $_POST['emergencyFirst'],
      "emergencyLast" => $_POST['emergencyLast'],
      "emergencyPhone" => $_POST['emergencyPhone'],
      "address" => $_POST['address'],
      "city" => $_POST['city'],
      "state" => $_POST['state'],
      "zipcode" => $_POST['zipcode'],
      "resident" => $_POST['resident'],
      "motherPickUp" => $_POST['motherPickUp'],
      "fatherPickUp" => $_POST['fatherPickUp'],
      "pickUpList" => $_POST['pickUpList']
    ];
    $sql = "UPDATE users
            SET id = :id,
              name = :name
            WHERE id = :id";

  $statement = $connection->prepare($sql);
  $statement->execute($user);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}

if (isset($_GET['id'])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id = :id";
    $statement = $connection->prepare($sql);
    $statement->bindValue(':id', $id);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
} else {
    echo "Something went wrong!";
    exit;
}
?>

<?php require "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) : ?>
	<blockquote><?php echo escape($_POST['name']); ?> successfully updated.</blockquote>
<?php endif; ?>

<h2>Edit</h2>

<form method="post">
    <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
    <?php foreach ($user as $key => $value) : ?>
      <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?> </label>
	    <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'id' ? 'readonly' : null); ?>> <br />
    <?php endforeach; ?>
    <input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>
