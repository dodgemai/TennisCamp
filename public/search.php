<?php

require "../config.php";
require "../common.php";

if (isset($_POST['submit'])) {
  if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();
  try  {
    $connection = new PDO($dsn, $username, $password, $options);
    $name = $_POST['name'];
    $sql = "SELECT * FROM users
            WHERE name LIKE '%$name%'";
    $statement = $connection->prepare($sql);
    $statement->bindParam(':name', $name, PDO::PARAM_STR);
    $statement->execute();
    $result = $statement->fetchAll();
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}
?>
<?php require "templates/header.php"; ?>

<?php
if (isset($_POST['submit'])) {
  if ($result && $statement->rowCount() > 0) { ?>
    <h2>Results</h2>

    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Level</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($result as $row) : ?>
        <tr>
          <td><?php echo escape($row["id"]); ?></td>
          <td><?php echo escape($row["name"]); ?></td>
          <td><?php echo escape($row["level"]); ?></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
    <?php } else { ?>
      <blockquote>No results found for <?php echo escape($_POST['name']); ?>.</blockquote>
    <?php }
} ?>

<!-- <form method="post">
  <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
  <label for="name">Name</label>
  <input type="text" id="name" name="name">
  <input type="submit" name="submit" value="View Results">
</form> -->

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>
