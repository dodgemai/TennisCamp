<?php
/**
 * List all users with a link to edit
 */
require "../config.php";
require "../common.php";

try {
  $connection = new PDO($dsn, $username, $password, $options);
  $sql = "SELECT * FROM weekly";
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

<!-- updates attendence after pressing save -->
<?php
  if(isset($_POST['save'])){
    // foreach($_POST['attendence'] as $selected){
    //     echo $selected."</br>";
    //   }
      try {
        $connection = new PDO($dsn, $username, $password, $options);
        $user =[
          "id"    => $_GET['id'],
          "attendence" => implode(",", $_POST['attendence']),
          "lateOut" => implode(",", $_POST['lateOut']),
          "subs" => implode(",", $_POST['subs']),
          "tshirtQty" => $_POST['tshirtQty']
        ];
        $sql = "UPDATE weekly
                SET attendence = :attendence,
                    lateOut = :lateOut,
                    subs = :subs,
                    tshirtQty = :tshirtQty
                WHERE id = :id";

      $statement = $connection->prepare($sql);
      $statement->execute($user);
      } catch(PDOException $error) {
          echo $sql . "<br>" . $error->getMessage();
      }
    }
?>

<!-- goes back to index.php with updates -->
<?php
  if (isset($_GET['id'])) {
    try {
      $connection = new PDO($dsn, $username, $password, $options);
      $sql = "SELECT * FROM weekly";
      $statement = $connection->prepare($sql);
      $statement->execute();
      $result = $statement->fetchAll();
    } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
    }
  }
?>

<div class="table table-striped">
  <table>
      <thead>
          <tr>
              <th>Name</th>
              <th>Level</th>
              <th>Monday</th>
              <th>Tuesday</th>
              <th>Wednesday</th>
              <th>Thursday</th>
              <th>Friday</th>
              <th>Subs</th>
              <th>T-Shirts</th>
              <th></th>
              <th></th>
          </tr>
      </thead>
      <tbody>
      <?php foreach ($result as $row) : ?>
          <tr>
              <td><a href="profile-single.php?id=<?php echo escape($row["id"]); ?>"><?php echo escape($row["name"]); ?></a></td>
              <td><?php echo escape($row["level"]); ?></td>
              <form action="index.php?id=<?php echo escape($row["id"]); ?>" method="post">

                <td style="text-align: center">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="attendence[]" id="attendence" value="Monday" <?php if(in_array("Monday", explode(",", $row["attendence"]))) echo 'checked="checked"'; ?>>
                    </div> <br />
                    <div class="form-check form-check-inline">
                      <!-- <input class="form-check-input" type="checkbox" name="earlyDropOff[]" id="earlyDropOff" value="Monday"> -->
                      <input class="form-check-input" type="checkbox" name="lateOut[]" id="lateOut" value="Monday" <?php if(in_array("Monday", explode(",", $row["lateOut"]))) echo 'checked="checked"'; ?>>
                    </div>
                </td>
                <td style="text-align: center">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="attendence[]" id="attendence" value="Tuesday" <?php if(in_array("Tuesday", explode(",", $row["attendence"]))) echo 'checked="checked"'; ?>>
                  </div> <br />
                  <div class="form-check form-check-inline">
                    <!-- <input class="form-check-input" type="checkbox" name="earlyin[]" id="earlyin" value="Tuesday"> -->
                    <input class="form-check-input" type="checkbox" name="lateOut[]" id="lateOut" value="Tuesday" <?php if(in_array("Tuesday", explode(",", $row["lateOut"]))) echo 'checked="checked"'; ?>>
                  </div>
                </td>
                <td style="text-align: center">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="attendence[]" id="attendence" value="Wednesday" <?php if(in_array("Wednesday", explode(",", $row["attendence"]))) echo 'checked="checked"'; ?>>
                  </div> <br />
                  <div class="form-check form-check-inline">
                    <!-- <input class="form-check-input" type="checkbox" name="earlyin[]" id="earlyin" value="Wednesday"> -->
                    <input class="form-check-input" type="checkbox" name="lateOut[]" id="lateOut" value="Wednesday" <?php if(in_array("Wednesday", explode(",", $row["lateOut"]))) echo 'checked="checked"'; ?>>
                  </div>
                </td>
                <td style="text-align: center">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="attendence[]" id="attendence" value="Thursday" <?php if(in_array("Thursday", explode(",", $row["attendence"]))) echo 'checked="checked"'; ?>>
                  </div> <br />
                  <div class="form-check form-check-inline">
                    <!-- <input class="form-check-input" type="checkbox" name="earlyin[]" id="earlyin" value="Thursday"> -->
                    <input class="form-check-input" type="checkbox" name="lateout[]" id="lateout" value="Thursday" <?php if(in_array("Thursday", explode(",", $row["lateOut"]))) echo 'checked="checked"'; ?>>
                  </div>
                </td>
                <td style="text-align: center">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="attendence[]" id="attendence" value="Friday" <?php if(in_array("Friday", explode(",", $row["attendence"]))) echo 'checked="checked"'; ?>>
                  </div> <br />
                  <div class="form-check form-check-inline">
                    <!-- <input class="form-check-input" type="checkbox" name="earlyin[]" id="earlyin" value="Friday"> -->
                    <input class="form-check-input" type="checkbox" name="lateOut[]" id="lateOut" value="Friday" <?php if(in_array("Friday", explode(",", $row["lateOut"]))) echo 'checked="checked"'; ?>>
                  </div>
                </td>

                <!-- SUBS -->
                <td>
                  <div class="form-check form-check-inline">
                    <label class="form-check-label" for="Monday">M</label>
                    <input class="form-check-input" type="checkbox" name="subs[]" id="subs" value="Monday" <?php if(in_array("Monday", explode(",", $row["subs"]))) echo 'checked="checked"'; ?>>
                  </div>
                  <div class="form-check form-check-inline">
                    <label class="form-check-label" for="Tuesday">T</label>
                    <input class="form-check-input" type="checkbox" name="subs[]" id="subs" value="Tuesday" <?php if(in_array("Tuesday", explode(",", $row["subs"]))) echo 'checked="checked"'; ?>>
                  </div>
                  <div class="form-check form-check-inline">
                    <label class="form-check-label" for="Wednesday">W</label>
                    <input class="form-check-input" type="checkbox" name="subs[]" id="subs" value="Wednesday" <?php if(in_array("Wednesday", explode(",", $row["subs"]))) echo 'checked="checked"'; ?>>
                  </div>
                  <div class="form-check form-check-inline">
                    <label class="form-check-label" for="Thursday">Th</label>
                    <input class="form-check-input" type="checkbox" name="subs[]" id="subs" value="Thursday" <?php if(in_array("Thursday", explode(",", $row["subs"]))) echo 'checked="checked"'; ?>>
                  </div>
                  <div class="form-check form-check-inline">
                    <label class="form-check-label" for="Friday">F</label>
                    <input class="form-check-input" type="checkbox" name="subs[]" id="subs" value="Friday" <?php if(in_array("Friday", explode(",", $row["subs"]))) echo 'checked="checked"'; ?>>
                  </div>
                </td>

                <!-- TSHIRT QUANTIT -->
                <td>
                  <div class="form-group">
                    <input class="form-group-tshirt" type="number" name="tshirtQty" id="tshirtQty" value="<?php echo escape($row["tshirtQty"]); ?>">
                  </div>
                </td>

                <td>
                  <input type="submit" name="save" value="Save"/>
                </td>
              </form>
              <td>
                <div class="row delete"><a href="delete-weekly.php?id=<?php echo escape($row["id"]); ?>" onclick="return confirm('You are deleting the user from the weekly repor. Are you sure?')">Delete</a></div>
              </td>
          </tr>
      <?php endforeach; ?>
      </tbody>
  </table>
</div>

<?php require "templates/footer.php"; ?>
