<?php
/**
 * Use an HTML form to edit an entry in the
 * users table.
 *
 */
require "../config.php";
require "../common.php";
if (isset($_POST['save'])) {
  if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();
  try {
    $connection = new PDO($dsn, $username, $password, $options);
    $user =[
      "id"    => $_POST['id'],
      "monday" => $_POST['monday'],
      "tuesday" => $_POST['tuesday'],
      "wednesday" => $_POST['wednesday'],
      "thursday" => $_POST['thursday'],
      "friday" => $_POST['friday']
    ];
    $sql = "UPDATE users
            SET monday = :monday,
                tuesday = :tuesday,
                wednesday = :wednesday,
                thursday = :thursday,
                friday = :friday
            WHERE id = :id";

  $statement = $connection->prepare($sql);
  $statement->execute($user);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}

// if (isset($_GET['id'])) {
//   try {
//     $connection = new PDO($dsn, $username, $password, $options);
//     $id = $_GET['id'];
//     $sql = "SELECT * FROM users WHERE id = :id";
//     $statement = $connection->prepare($sql);
//     $statement->bindValue(':id', $id);
//     $statement->execute();
//
//     $user = $statement->fetch(PDO::FETCH_ASSOC);
//   } catch(PDOException $error) {
//       echo $sql . "<br>" . $error->getMessage();
//   }
// } else {
//     echo "Something went wrong!";
//     exit;
// }
?>

<?php require "templates/header.php"; ?>

<form method="post" class="attendence-form">
  <div class="attendence">
    <div class="form-check form-check-inline">
      <label class="form-check-label" for="monday">M</label>
      <input class="form-check-input" type="checkbox" id="monday" value="<?php echo escape($user["monday"]); ?>">
    </div>
    <div class="form-check form-check-inline">
      <label class="form-check-label" for="T">T</label>
      <input class="form-check-input" type="checkbox" id="T" value="<?php echo escape($user["tuesday"]); ?>">
    </div>
    <div class="form-check form-check-inline">
      <label class="form-check-label" for="W">W</label>
      <input class="form-check-input" type="checkbox" id="W" value="<?php echo escape($user["wednesday"]); ?>">
    </div>
    <div class="form-check form-check-inline">
      <label class="form-check-label" for="Th">Th</label>
      <input class="form-check-input" type="checkbox" id="Th" value="<?php echo escape($user["thursday"]); ?>">
    </div>
    <div class="form-check form-check-inline">
      <label class="form-check-label" for="F">F</label>
      <input class="form-check-input" type="checkbox" id="F" value="<?php echo escape($user["friday"]); ?>">
    </div>
  </div></td>
  <input type="submit" name="save" value="Save">
</form>

<?php require "templates/footer.php"; ?>
