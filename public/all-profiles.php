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
              <th style="width: 15%;">Name</th>
              <th style="width: 10%;">Level</th>
          </tr>
      </thead>
      <tbody>
      <?php foreach ($result as $row) : ?>
          <tr>
              <td style="width: 15%;"><a href="profile-single.php?id=<?php echo escape($row["id"]); ?>"><?php echo escape($row["name"]); ?></a></td>
              <td style="width: 10%;"><?php echo escape($row["level"]); ?></td>
          </tr>
      <?php endforeach; ?>
      </tbody>
  </table>
</div>

<?php require "templates/footer.php"; ?>
