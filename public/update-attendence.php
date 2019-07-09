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
      "attendence" => $_POST['attendence']
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

<form method="post" class="edit-form">
  <div class="attendence">
    <div class="form-check form-check-inline">
      <label class="form-check-label" for="M">M</label>
      <input class="form-check-input" type="checkbox" id="M" value="Monday">
    </div>
    <div class="form-check form-check-inline">
      <label class="form-check-label" for="T">T</label>
      <input class="form-check-input" type="checkbox" id="T" value="Tuesday">
    </div>
    <div class="form-check form-check-inline">
      <label class="form-check-label" for="W">W</label>
      <input class="form-check-input" type="checkbox" id="W" value="Wednesday">
    </div>
    <div class="form-check form-check-inline">
      <label class="form-check-label" for="Th">Th</label>
      <input class="form-check-input" type="checkbox" id="Th" value="Thursday">
    </div>
    <div class="form-check form-check-inline">
      <label class="form-check-label" for="F">F</label>
      <input class="form-check-input" type="checkbox" id="F" value="Friday">
    </div>
  </div></td>
  <input type="submit" name="save" value="Save">
</form>

<?php require "templates/footer.php"; ?>
