<?php
/**
 * List all users with a link to edit
 */
require "../config.php";
require "../common.php";

try {
  $connection = new PDO($dsn, $username, $password, $options);
  $sql = "SELECT * FROM users";
  $statement = $connection->prepare($sql);
  $statement->execute();
  $result = $statement->fetchAll();
} catch(PDOException $error) {
  echo $sql . "<br>" . $error->getMessage();
}
?>
<?php require "templates/header.php"; ?>

<!-- <form action="search.php" method="post">
  Search: <input type="text" name="search" placeholder=" Search here ... "/>
<input type="submit" name="submit" value="Submit" /> -->
<!-- <div class="search">
  <form method="post" action="search.php">
    <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
    <input type="text" id="name" name="name">
    <input type="submit" name="submit" value="View Results">
  </form>
</div> -->

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

<?php require "templates/footer.php"; ?>
