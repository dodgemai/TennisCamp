<?php

require "../config.php";
require "../common.php";

if (isset($_POST['submit'])) {
  try  {
    $connection = new PDO($dsn, $username, $password, $options);
    $level = $_POST['level'];
    $sql = "SELECT * FROM persons WHERE level='level'";
    $statement = $connection->prepare($sql);
    $statement->bindParam(':level', $level, PDO::PARAM_STR);
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

<?php require "templates/footer.php"; ?>
