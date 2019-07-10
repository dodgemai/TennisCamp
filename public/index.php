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
              <th style="width: 30%;">Early In/Late Out</th>
              <th style="width: 20%;">Subs</th>
              <th style="width: 10%;">T-Shirts</th>
              <th></th>
              <th></th>
          </tr>
      </thead>
      <tbody>
      <?php foreach ($result as $row) : ?>
          <tr>
              <td style="width: 15%;"><a href="profile-single.php?id=<?php echo escape($row["id"]); ?>"><?php echo escape($row["name"]); ?></a></td>
              <td style="width: 10%;"><?php echo escape($row["level"]); ?></td>
              <td style="width: 30%;">
                <form class="attendence" action="update-attendence.php?id=<?php echo escape($row["id"]); ?>" method="get">
                  <div class="form-check form-check-inline">
                    <label class="form-check-label" for="monday">M</label>
                    <input class="form-check-input" type="checkbox" id="monday" value="<?php echo escape($user["monday"]); ?>">
                    <input class="form-check-input" type="checkbox" id="monday" value="<?php echo escape($user["monday"]); ?>">
                  </div>
                  <div class="form-check form-check-inline">
                    <label class="form-check-label" for="T">T</label>
                    <input class="form-check-input" type="checkbox" id="T" value="<?php echo escape($user["tuesday"]); ?>">
                    <input class="form-check-input" type="checkbox" id="monday" value="<?php echo escape($user["monday"]); ?>">
                  </div>
                  <div class="form-check form-check-inline">
                    <label class="form-check-label" for="W">W</label>
                    <input class="form-check-input" type="checkbox" id="W" value="<?php echo escape($user["wednesday"]); ?>">
                    <input class="form-check-input" type="checkbox" id="monday" value="<?php echo escape($user["monday"]); ?>">
                  </div>
                  <div class="form-check form-check-inline">
                    <label class="form-check-label" for="Th">Th</label>
                    <input class="form-check-input" type="checkbox" id="Th" value="<?php echo escape($user["thursday"]); ?>">
                    <input class="form-check-input" type="checkbox" id="monday" value="<?php echo escape($user["monday"]); ?>">
                  </div>
                  <div class="form-check form-check-inline">
                    <label class="form-check-label" for="F">F</label>
                    <input class="form-check-input" type="checkbox" id="F" value="<?php echo escape($user["friday"]); ?>">
                    <input class="form-check-input" type="checkbox" id="monday" value="<?php echo escape($user["monday"]); ?>">
                  </div>
                  <!-- <button type="submit" class="btn btn-link" name="save" value="save">Save</button> -->
                </form>
              </td>
              <td style="width: 20%;">
                <form class="subs" action="update-subs.php?id=<?php echo escape($row["id"]); ?>" method="get">
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
                  <!-- <button type="submit" class="btn btn-link" name="save" value="save">Save</button> -->
                </form>
              </td>
              <td style="width: 10%;">
                <form class="tshirt-qty" action="update-tshirts.php?id=<?php echo escape($row["id"]); ?>" method="get">
                    <input class="form-control" type="number" value="<?php echo escape($user["tshirt-qty"]); ?>">
                </form>
              </td>
              <td style="width: 5%; padding: 5px;"><a class="btn btn-link" href="update-single.php?id=<?php echo escape($row["id"]); ?>">Edit</a></td>
              <td style="width: 5%; padding: 5px"><a class="btn btn-link" href="delete-single.php?id=<?php echo escape($row["id"]); ?>" onclick="return confirm('Are you sure?')">Delete</a></td>
          </tr>
      <?php endforeach; ?>
      </tbody>
  </table>
</div>

<?php require "templates/footer.php"; ?>
