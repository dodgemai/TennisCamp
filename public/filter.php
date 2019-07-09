<?php

require "../config.php";
require "../common.php";

if (isset($_POST['submit'])) {
  try  {
    $connection = new PDO($dsn, $username, $password, $options);
    $level = $_POST['level'];
    $sql = "SELECT * FROM users
            WHERE level LIKE '%$level%'";
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
    <h2>Results for <?php echo escape($_POST['level']); ?></h2>

    <div class="table table-striped">
      <table>
          <thead>
              <tr>
                  <th>Name</th>
                  <th>Level</th>
              </tr>
          </thead>
          <tbody>
          <?php foreach ($result as $row) : ?>
              <tr>
                  <td><a href="profile-single.php?id=<?php echo escape($row["id"]); ?>"><?php echo escape($row["name"]); ?></a></td>
                  <td><?php echo escape($row["level"]); ?></td>
                  <td><a href="update-single.php?id=<?php echo escape($row["id"]); ?>">Edit</a></td>
                  <td><a href="delete-single.php?id=<?php echo escape($row["id"]); ?>" onclick="return confirm('Are you sure?')">Delete</a></td>
              </tr>
          <?php endforeach; ?>
          </tbody>
      </table>
    </div>

  <?php } else { ?>
    <blockquote>No results found for level <?php echo escape($_POST['level']); ?>.</blockquote>
  <?php }
} ?>

<?php require "templates/footer.php"; ?>
